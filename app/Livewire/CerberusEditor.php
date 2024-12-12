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
            Log::info('Template blocks loaded:', ['blocks' => $this->blocks]);
        } else {
            Log::warning('No active template found');
        }

        // Cargar bloques guardados
        $this->savedBlocks = CerberusSavedBlock::where('user_id', auth()->id())->get();
        $this->savedBlocksCount = $this->savedBlocks->count();
        Log::info('Saved blocks loaded:', ['count' => $this->savedBlocksCount]);
    }

    public function render()
    {
        return view('livewire.cerberus-editor');
    }

    public function saveTemplate()
    {
        if ($this->templateId) {
            CerberusSavedTemplate::find($this->templateId)->update([
                'blocks' => $this->blocks
            ]);
        }
    }

    public function toggleBlock($blockKey)
    {
        $this->blocks[$blockKey]['active'] = !$this->blocks[$blockKey]['active'];
        $this->saveTemplate();
    }

    public function updateBlockContent($blockKey, $content)
    {
        $this->blocks[$blockKey]['content'] = array_merge(
            $this->blocks[$blockKey]['content'] ?? [],
            $content
        );
        $this->saveTemplate();
    }

    public function downloadTemplate()
    {
        return response()->streamDownload(function() {
            echo View::make('emails.template', ['blocks' => $this->blocks])->render();
        }, 'template.html');
    }
}
