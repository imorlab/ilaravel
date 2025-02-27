<?php

namespace Database\Seeders;

use App\Models\CerberusSavedBlock;
use App\Models\CerberusSavedTemplate;
use Illuminate\Database\Seeder;

class CerberusBlocksSeeder extends Seeder
{
    public function run(): void
    {
        // Crear la plantilla predefinida
        $defaultBlocks = [
            'header' => [
                'active' => true,
                'type' => 'header',
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
                'type' => 'hero',
                'content' => [
                    'image' => 'https://picsum.photos/600/300.webp?random=2',
                    'alt' => 'Hero image',
                    'background_color' => '#fafafa',
                    'width' => '600',
                    'alignment' => 'center'
                ]
            ],
            'content' => [
                'active' => true,
                'type' => 'content',
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
            'two-columns-left' => [
                'active' => true,
                'type' => 'two-columns-left',
                'content' => [
                    'left' => [
                        'icon' => 'https://picsum.photos/270/270.webp?random=3',
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
                        'image' => 'https://picsum.photos/270/270.webp?random=4',
                    ],
                    'background_color' => '#fafafa'
                ]
            ],
            'two-columns-right' => [
                'active' => true,
                'type' => 'two-columns-right',
                'content' => [
                    'left' => [
                        'image' => 'https://picsum.photos/270/270.webp?random=4',
                    ],
                    'right' => [
                        'icon' => 'https://picsum.photos/270/270.webp?random=3',
                        'label' => 'Left Column',
                        'title' => 'Left Column Title',
                        'text' => 'Left column content',
                        'button_text' => 'Read More',
                        'button_url' => '#',
                        'button_background' => '#007bff',
                        'button_text_color' => '#fafafa',
                        'button_alignment' => 'left',
                    ],
                    'background_color' => '#fafafa'
                ]
            ],
            'button' => [
                'active' => true,
                'type' => 'button',
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
                'type' => 'footer',
                'content' => [
                    'company' => 'Your Company Name',
                    'address' => '123 Street Name, City, Country',
                    'phone' => '+1 234 567 890',
                    'background_color' => '#fafafa'
                ]
            ]
        ];

        // Crear la plantilla predefinida
        // CerberusSavedTemplate::create([
        //     'name' => 'Default Template',
        //     'description' => 'Plantilla predefinida del sistema',
        //     'blocks' => $defaultBlocks,
        //     'is_active' => true,
        //     'user_id' => 1 // Asumiendo que el admin tiene ID 1
        // ]);

        // Crear los bloques individuales
        foreach ($defaultBlocks as $key => $block) {
            CerberusSavedBlock::create([
                'name' => $block['type'],
                'category' => $block['type'],
                'type' => $block['type'],
                'content' => $block['content'],
                'user_id' => 1, // Asumiendo que el admin tiene ID 1
                'thumbnail' => 'https://picsum.photos/300/200.webp?random=' . rand(1, 100)
            ]);
        }
    }
}
