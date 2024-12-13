<?php

namespace App\Livewire;

use App\Models\CerberusSavedBlock;
use App\Models\CerberusSavedTemplate;
use Livewire\Component;
use Illuminate\Support\Facades\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Component as ComponentAttribute;
use Illuminate\Support\Facades\Log;

#[Layout('layouts.app')]
#[ComponentAttribute('cerberus-editor')]
class CerberusEditor extends Component
{
    public $blocks = [];
    public $templateId;
    public $templateName = 'Default Template';
    public $savedBlocks = [];
    public $savedBlocksCount = 0;

    // Variables para guardar bloques
    public $blockName = '';
    public $blockCategory = 'content';

    // Variables para guardar plantillas
    public $templateNameSave = '';
    public $templateDescription = '';
    public $templateIdSave = null;
    public $overwriteTemplate = false;

    protected $defaultSettings = [
        'settings' => [
            'content' => [
                'background_color' => '#ebebeb',
                'preheader' => 'Newsletter preview text',
                'padding' => '0',
                'alignment' => 'center'
            ]
        ]
    ];

    public function mount($template = null)
    {
        // Inicializar con la configuración por defecto
        $this->blocks = [
            'settings' => [
                'content' => [
                    'background_color' => '#ebebeb',
                    'preheader' => 'Newsletter preview text',
                    'title' => 'Newsletter Template',
                    'padding' => '0',
                    'alignment' => 'center',
                    'dark_mode' => false
                ]
            ]
        ];

        if ($template) {
            // Cargar la plantilla especificada
            $selectedTemplate = CerberusSavedTemplate::find($template);
            if ($selectedTemplate) {
                $this->templateId = $selectedTemplate->id;
                $this->templateName = $selectedTemplate->name;
                
                // Asegurarse de que los settings existan
                $templateBlocks = $selectedTemplate->blocks;
                if (!isset($templateBlocks['settings'])) {
                    $templateBlocks['settings'] = $this->blocks['settings'];
                } else {
                    // Merge settings para asegurar que todos los campos existan
                    $templateBlocks['settings'] = array_merge_recursive(
                        $this->blocks['settings'],
                        $templateBlocks['settings']
                    );
                }
                
                $this->blocks = $templateBlocks;
            }
        } else {
            // Si no se especifica template, cargar la plantilla por defecto
            $defaultTemplate = CerberusSavedTemplate::where('name', 'Default Template')->first();
            if ($defaultTemplate) {
                $this->templateId = $defaultTemplate->id;
                $this->templateName = $defaultTemplate->name;
                $this->blocks = $defaultTemplate->blocks;
            }
        }

        // Asegurarse de que cada bloque tenga un orden
        $order = 0;
        foreach ($this->blocks as $key => &$block) {
            if (!isset($block['order']) && $key !== 'settings') {
                $block['order'] = $order++;
            }
        }
        unset($block);

        // Cargar bloques guardados
        $this->loadSavedBlocks();
    }

    public function render()
    {
        return view('livewire.cerberus-editor');
    }

    public function saveTemplate()
    {
        try {
            if (empty($this->templateNameSave)) {
                $this->dispatch('error', ['message' => 'El nombre de la plantilla es requerido']);
                return;
            }

            if ($this->templateId && $this->overwriteTemplate) {
                // Actualizar plantilla existente
                $template = CerberusSavedTemplate::find($this->templateId);
                if (!$template) {
                    throw new \Exception('No se encontró la plantilla');
                }
                $template->update([
                    'name' => $this->templateNameSave,
                    'description' => $this->templateDescription,
                    'blocks' => $this->blocks,
                ]);
                $message = 'Plantilla actualizada correctamente';
            } else {
                // Crear nueva plantilla
                CerberusSavedTemplate::create([
                    'name' => $this->templateNameSave,
                    'description' => $this->templateDescription,
                    'blocks' => $this->blocks,
                    'user_id' => auth()->id(),
                ]);
                $message = 'Plantilla guardada correctamente';
            }

            // Limpiar los campos del formulario
            $this->reset(['templateNameSave', 'templateDescription', 'overwriteTemplate']);
            
            // Disparar evento para cerrar el modal
            $this->dispatch('closeModal', ['modal' => 'saveTemplateModal']);
            
            // Mostrar mensaje de éxito y redireccionar
            $this->dispatch('success', ['message' => $message]);
            return redirect()->route('cerberus.editor', ['template' => $this->templateId]);

        } catch (\Exception $e) {
            $this->dispatch('error', ['message' => 'Error al guardar la plantilla: ' . $e->getMessage()]);
        }
    }

    protected function loadSavedBlocks()
    {
        $this->savedBlocks = CerberusSavedBlock::all();
        $this->savedBlocksCount = $this->savedBlocks->count();
    }

    public function updateBlockOrder($orderedBlocks)
    {
        // Actualizar el orden de los bloques
        foreach ($orderedBlocks as $index => $block) {
            if (isset($this->blocks[$block['value']])) {
                $this->blocks[$block['value']]['order'] = $index;
            }
        }
    }

    public function downloadTemplate()
    {
        try {
            // Ordenar los bloques manteniendo 'settings' fuera del ordenamiento
            $settings = $this->blocks['settings'] ?? [];
            
            // Filtrar y ordenar los bloques
            $blocksToOrder = collect($this->blocks)
                ->except('settings')
                ->filter(function ($block) {
                    return !isset($block['active']) || $block['active'];
                })
                ->sortBy(fn($block) => $block['order'] ?? PHP_INT_MAX)
                ->all();

            $orderedBlocks = array_merge(['settings' => $settings], $blocksToOrder);

            return response()->streamDownload(function() use ($orderedBlocks, $settings) {
                echo View::make('emails.template', [
                    'blocks' => $orderedBlocks,
                    'settings' => $settings
                ])->render();
            }, 'template.html');

        } catch (\Exception $e) {
            session()->flash('error', 'Error al descargar la plantilla: ' . $e->getMessage());
            return null;
        }
    }
}
