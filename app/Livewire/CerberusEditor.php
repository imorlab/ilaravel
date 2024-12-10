<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CerberusTemplate;

class CerberusEditor extends Component
{
    public $blocks = [];
    public $previewHtml = '';
    public $templateId;
    public $templateName = 'Default Template';

    public function mount()
    {
        $template = CerberusTemplate::where('is_active', true)->first();
        
        if ($template) {
            $defaultBlocks = $this->getDefaultBlocks();
            $this->blocks = $template->blocks;

            // Asegurarse de que todos los bloques necesarios existen
            foreach ($defaultBlocks as $key => $defaultBlock) {
                if (!isset($this->blocks[$key])) {
                    $this->blocks[$key] = $defaultBlock;
                } else {
                    // Asegurarse de que todos los campos necesarios existen
                    $this->blocks[$key]['content'] = array_merge(
                        $defaultBlock['content'],
                        $this->blocks[$key]['content'] ?? []
                    );
                }
            }
        } else {
            $this->blocks = $this->getDefaultBlocks();
        }
        
        $this->templateId = $template->id ?? null;
        $this->updatePreview();
    }

    protected function getDefaultBlocks()
    {
        return [
            'settings' => [
                'active' => true,
                'content' => [
                    'background_color' => '#ffffff',
                    'container_background' => '#f8f8f8'
                ]
            ],
            'header' => [
                'active' => true,
                'content' => [
                    'logo' => 'https://via.placeholder.com/200x50',
                    'alt' => 'Logo',
                    'width' => '600',
                    'alignment' => 'center',
                    'background_color' => '#f8f8f8'
                ]
            ],
            'hero' => [
                'active' => true,
                'content' => [
                    'image' => 'https://via.placeholder.com/600x300',
                    'alt' => 'Hero image',
                    'background_color' => '#ffffff',
                    'width' => '600',
                    'alignment' => 'center'
                ]
            ],
            'content' => [
                'active' => true,
                'content' => [
                    'title' => 'Welcome to our newsletter',
                    'text' => 'This is a sample text content.',
                    'button' => [
                        'text' => 'Read More',
                        'url' => '#'
                    ],
                    'background_color' => '#f8f8f8'
                ]
            ],
            'two_columns' => [
                'active' => true,
                'content' => [
                    'left' => [
                        'image' => 'https://via.placeholder.com/270x270',
                        'text' => 'Left column content'
                    ],
                    'right' => [
                        'image' => 'https://via.placeholder.com/270x270',
                        'text' => 'Right column content'
                    ],
                    'background_color' => '#f8f8f8'
                ]
            ],
            'button' => [
                'active' => true,
                'content' => [
                    'text' => 'ACCEDE',
                    'url' => '#',
                    'width' => '100',
                    'height' => '34',
                    'alignment' => 'left',
                    'background_color' => '#ffffff',
                    'button_background_color' => '#FFD102',
                    'text_color' => '#000000',
                    'font_size' => '12',
                    'font_weight' => 'bold',
                    'border_radius' => '32',
                    'padding_top' => '25',
                    'padding_bottom' => '30',
                    'container_width' => '250'
                ]
            ],
            'footer' => [
                'active' => true,
                'content' => [
                    'company' => 'Your Company Name',
                    'address' => '123 Street Name, City, Country',
                    'phone' => '+1 234 567 890',
                    'background_color' => '#f8f8f8'
                ]
            ]
        ];
    }

    public function updated($name, $value)
    {
        $this->saveTemplate();
        $this->updatePreview();
    }

    public function saveTemplate()
    {
        if ($this->templateId) {
            CerberusTemplate::where('id', $this->templateId)->update([
                'blocks' => $this->blocks
            ]);
        }
    }

    public function toggleBlock($blockKey)
    {
        $this->blocks[$blockKey]['active'] = !$this->blocks[$blockKey]['active'];
        $this->saveTemplate();
        $this->updatePreview();
    }

    public function updateBlockContent($blockKey, $content)
    {
        $this->blocks[$blockKey]['content'] = array_merge(
            $this->blocks[$blockKey]['content'],
            $content
        );
        $this->saveTemplate();
        $this->updatePreview();
    }

    public function updatePreview()
    {
        $this->previewHtml = view('emails.template', ['blocks' => $this->blocks])->render();
    }

    public function downloadTemplate()
    {
        return response()->streamDownload(function() {
            echo view('emails.template', ['blocks' => $this->blocks])->render();
        }, 'newsletter.html');
    }

    public function render()
    {
        return view('livewire.cerberus-editor');
    }
}
