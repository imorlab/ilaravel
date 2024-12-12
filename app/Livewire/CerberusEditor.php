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

    public function mount()
    {
        // Cargar la plantilla activa
        $activeTemplate = CerberusSavedTemplate::where('is_active', true)->first();
        Log::info('Active template loaded:', ['template' => $activeTemplate]);

        if ($activeTemplate) {
            $this->templateId = $activeTemplate->id;
            $this->templateName = $activeTemplate->name;
            $this->blocks = $activeTemplate->blocks;

            // Asegurarse de que cada bloque tenga un orden
            $order = 0;
            foreach ($this->blocks as $key => &$block) {
                if (!isset($block['order'])) {
                    $block['order'] = $order++;
                }
            }
            unset($block);
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
        if (!$this->templateIdSave) {
            $this->showNotification('Por favor, selecciona una plantilla para guardar', 'error');
            return;
        }

        $template = CerberusSavedTemplate::find($this->templateIdSave);
        if ($template) {
            $template->update([
                'name' => $this->templateNameSave,
                'description' => $this->templateDescription,
                'blocks' => $this->blocks
            ]);

            $this->showNotification('Plantilla actualizada correctamente');
        }
    }

    public function saveAsNewTemplate()
    {
        if (empty($this->templateNameSave)) {
            $this->showNotification('Por favor, ingresa un nombre para la plantilla', 'error');
            return;
        }

        // Desactivar todas las plantillas existentes
        CerberusSavedTemplate::where('is_active', true)->update(['is_active' => false]);

        // Crear la nueva plantilla
        CerberusSavedTemplate::create([
            'name' => $this->templateNameSave,
            'description' => $this->templateDescription,
            'blocks' => $this->blocks,
            'is_active' => true
        ]);

        $this->showNotification('Nueva plantilla guardada correctamente');
    }

    public function addBlock($blockKey)
    {
        if (isset($this->blocks[$blockKey])) {
            $this->blocks[$blockKey]['active'] = true;
            $this->saveTemplate();
            $this->showNotification('Bloque añadido correctamente');
        }
    }

    public function toggleBlock($blockKey)
    {
        if (isset($this->blocks[$blockKey])) {
            $this->blocks[$blockKey]['active'] = !($this->blocks[$blockKey]['active'] ?? false);
            $this->saveTemplate();
        }
    }

    public function updateBlockContent($blockKey, $content)
    {
        if (isset($this->blocks[$blockKey])) {
            $this->blocks[$blockKey]['content'] = $content;
            
            // Si es un bloque guardado, actualizar en la base de datos
            if (isset($this->blocks[$blockKey]['saved_block_id'])) {
                $savedBlock = CerberusSavedBlock::find($this->blocks[$blockKey]['saved_block_id']);
                if ($savedBlock) {
                    $savedBlock->update(['content' => $content]);
                }
            }
            
            $this->showNotification('Contenido actualizado correctamente');
        }
    }

    public function updateBlockOrder($orderedBlocks)
    {
        Log::info('Updating block order:', ['orderedBlocks' => $orderedBlocks]);
        
        $newOrder = 0;
        foreach ($orderedBlocks as $blockKey) {
            if (isset($this->blocks[$blockKey])) {
                $this->blocks[$blockKey]['order'] = $newOrder++;
            }
        }
    }

    public function downloadTemplate()
    {
        // Ordenar los bloques antes de pasarlos a la vista
        $orderedBlocks = collect($this->blocks)
            ->sortBy(fn($block) => $block['order'] ?? PHP_INT_MAX)
            ->all();

        return response()->streamDownload(function() use ($orderedBlocks) {
            echo View::make('emails.template', ['blocks' => $orderedBlocks])->render();
        }, 'template.html');
    }

    public function duplicateBlock($blockKey)
    {
        if (!auth()->check()) {
            $this->showAuthAlert();
            return;
        }

        $block = $this->blocks[$blockKey];
        
        // Determinar la categoría basada en el tipo de bloque
        $category = $block['type'];
        
        // Guardar en la base de datos
        $savedBlock = CerberusSavedBlock::create([
            'user_id' => auth()->id(),
            'name' => $blockKey . ' ' . now()->format('Y-m-d H:i:s'),
            'type' => $block['type'],
            'category' => $category,
            'content' => $block['content'],
            'is_active' => true,
        ]);

        // Agregar a la colección de bloques
        $newKey = 'saved_' . $savedBlock->id;
        $this->blocks[$newKey] = [
            'active' => true,
            'type' => $block['type'],
            'content' => $block['content'],
            'saved_block_id' => $savedBlock->id
        ];

        $this->savedBlocksCount++;
        $this->showNotification('Bloque duplicado correctamente');
    }

    public function editSavedBlock($blockId)
    {
        $savedBlock = CerberusSavedBlock::find($blockId);
        if ($savedBlock) {
            // Redirigir a la página de edición del bloque
            return redirect()->route('cerberus.edit-block', ['id' => $blockId]);
        }
    }

    public function deleteSavedBlock($blockKey)
    {
        if (!auth()->check()) {
            $this->showAuthAlert();
            return;
        }

        // Extraer el ID del bloque del blockKey (saved_X)
        $blockId = str_replace('saved_', '', $blockKey);
        
        // Marcar como inactivo en la base de datos
        $block = CerberusSavedBlock::find($blockId);
        if ($block) {
            $block->update(['is_active' => false]);
            
            // Eliminar de la colección de bloques
            unset($this->blocks[$blockKey]);
            $this->savedBlocksCount--;
            
            $this->showNotification('Bloque eliminado correctamente');
        }
    }

    protected function loadSavedBlocks()
    {
        $savedBlocks = CerberusSavedBlock::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        // Convertir los bloques guardados al formato necesario
        foreach ($savedBlocks as $savedBlock) {
            $blockKey = 'saved_' . $savedBlock->id;
            $this->blocks[$blockKey] = [
                'type' => $savedBlock->type,
                'content' => $savedBlock->content,
                'active' => false,
                'saved_block_id' => $savedBlock->id,
                'order' => null
            ];
        }

        $this->savedBlocksCount = $savedBlocks->count();
    }

    protected function showNotification($message, $type = 'success')
    {
        $this->dispatch('showToast', [
            'title' => ucfirst($type),
            'text' => $message,
            'icon' => $type,
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);
    }

    protected function showAuthAlert()
    {
        $this->dispatch('showAuthAlert', [
            'title' => '¡Necesitas iniciar sesión!',
            'text' => 'Para guardar y personalizar bloques, necesitas tener una cuenta.',
            'icon' => 'info',
            'showCancelButton' => true,
            'confirmButtonText' => 'Ir a registro',
            'cancelButtonText' => 'Cancelar',
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
        ]);
    }
}
