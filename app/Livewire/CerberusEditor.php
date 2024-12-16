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

    public function mount($templateId = null)
    {
        // Si se proporciona un ID de plantilla, cargar esa plantilla
        if ($templateId) {
            $template = CerberusSavedTemplate::findOrFail($templateId);
            $this->templateId = $template->id;
            $this->templateName = $template->name;
            $this->blocks = $template->blocks;

            // Asegurarse de que cada bloque tenga un orden
            $this->blocks = collect($this->blocks)->map(function ($block, $key) {
                if (!isset($block['order'])) {
                    $block['order'] = PHP_INT_MAX;
                }
                return $block;
            })->toArray();
        } else {
            // Inicializar con los bloques por defecto
            $this->blocks = [
                'settings' => [
                    'type' => 'settings',
                    'content' => [
                        'background_color' => '#ebebeb',
                        'preheader' => 'Newsletter preview text'
                    ]
                ]
            ];

            // Agregar todos los tipos de bloques disponibles
            $blockTypes = [
                'header' => [
                    'title' => 'Header Title',
                    'subtitle' => 'Header Subtitle',
                    'alignment' => 'left'
                ],
                'hero' => [
                    'title' => 'Hero Title',
                    'subtitle' => 'Hero Subtitle',
                    'image' => '',
                    'alignment' => 'left'
                ],
                'content' => [
                    'title' => 'Content Title',
                    'content' => 'Content text goes here',
                    'alignment' => 'left'
                ],
                'button' => [
                    'text' => 'Click me',
                    'url' => '#',
                    'alignment' => 'left',
                    'background_color' => '#007bff',
                    'text_color' => '#ffffff'
                ],
                'footer' => [
                    'content' => 'Footer content',
                    'alignment' => 'center'
                ],
                'two-columns-left' => [
                    'left' => [
                        'title' => 'Left Column Title',
                        'content' => 'Left column content goes here',
                        'button_text' => 'Learn More',
                        'button_url' => '#',
                        'button_alignment' => 'center'
                    ],
                    'right' => [
                        'image' => 'https://via.placeholder.com/280x200',
                        'alt' => 'Right column image',
                        'width' => '280'
                    ],
                    'alignment' => 'left'
                ],
                'two-columns-right' => [
                    'left' => [
                        'image' => 'https://via.placeholder.com/280x200',
                        'alt' => 'Left column image',
                        'width' => '280'
                    ],
                    'right' => [
                        'title' => 'Right Column Title',
                        'content' => 'Right column content goes here',
                        'button_text' => 'Learn More',
                        'button_url' => '#',
                        'button_alignment' => 'center'
                    ],
                    'alignment' => 'left'
                ]
            ];

            foreach ($blockTypes as $type => $defaultContent) {
                $this->blocks[$type] = [
                    'active' => false,
                    'type' => $type,
                    'content' => $defaultContent
                ];
            }

            $this->templateName = 'Nueva Plantilla';
        }

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
        // Cargar todos los bloques guardados, sin filtrar por is_active
        $this->savedBlocks = CerberusSavedBlock::all();
        $this->savedBlocksCount = $this->savedBlocks->count();
        
        // Agregar los bloques guardados al array $blocks con el prefijo 'saved_'
        foreach ($this->savedBlocks as $index => $savedBlock) {
            $key = 'saved_' . $savedBlock->id;
            $this->blocks[$key] = [
                'active' => (bool) $savedBlock->is_active,
                'type' => $savedBlock->type, // Tipo original del bloque (header, content, etc.)
                'original_type' => $savedBlock->type, // Guardamos el tipo original para la vista
                'content' => $savedBlock->content,
                'name' => $savedBlock->name,
                'category' => $savedBlock->category,
                'is_saved_block' => true
            ];
        }
    }

    public function updatedBlocks($value, $key)
    {
        // Si el cambio es en un bloque guardado y es el campo 'active'
        if (str_starts_with($key, 'saved_') && str_ends_with($key, '.active')) {
            // Extraer el ID del bloque guardado
            $blockKey = explode('.', $key)[0];
            $savedBlockId = $this->blocks[$blockKey]['saved_block_id'] ?? null;
            
            if ($savedBlockId) {
                try {
                    // Actualizar el estado en la base de datos
                    CerberusSavedBlock::where('id', $savedBlockId)
                        ->update(['is_active' => $value]);

                    $this->dispatch('notify', [
                        'type' => 'success',
                        'message' => 'Estado del bloque actualizado correctamente'
                    ]);
                } catch (\Exception $e) {
                    $this->dispatch('notify', [
                        'type' => 'error',
                        'message' => 'Error al actualizar el estado del bloque'
                    ]);
                }
            }
        }
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
                    // Solo filtrar por active si existe la clave
                    return !array_key_exists('active', $block) || $block['active'];
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
