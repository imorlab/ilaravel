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
                    'background_color' => '#f9f0ff',
                    'container_background' => '#fafafa'
                ]
            ],
            'header' => [
                'active' => true,
                'content' => [
                    'image' => 'https://picsum.photos/200/50.webp?random=1',
                    'alt' => 'Logo',
                    'width' => '200',
                    'padding' => '20',
                    'alignment' => 'center',
                    'background_color' => '#fafafa'
                ]
            ],
            'hero' => [
                'active' => true,
                'content' => [
                    'image' => 'https://picsum.photos/600/300.webp?random=1',
                    'alt' => 'Hero image',
                    'background_color' => '#fafafa',
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
                    'background_color' => '#fafafa'
                ]
            ],
            'two_columns' => [
                'active' => true,
                'content' => [
                    'left' => [
                        'icon' => 'https://picsum.photos/270/270.webp?random=1',
                        'label' => 'Left Column',
                        'title' => 'Left Column Title',
                        'text' => 'Left column content',
                        'button_text' => 'Read More',
                        'button_url' => '#',
                        'button_background' => '#007bff',
                        'button_text_color' => '#fafafa',
                        'button_alignment' => 'left',
                    ],
                    'right' => [
                        'image' => 'https://picsum.photos/270/270.webp?random=1',
                    ],
                    'background_color' => '#fafafa'
                ]
            ],
            'button' => [
                'active' => true,
                'content' => [
                    'text' => 'ACCEDE',
                    'url' => '#',
                    'width' => '100',
                    'height' => '34',
                    'alignment' => 'center',
                    'background_color' => '#fafafa',
                    'button_background_color' => '#007bff',
                    'text_color' => '#fafafa',
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
                    'background_color' => '#fafafa'
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
