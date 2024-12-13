<?php

namespace App\Livewire;

use App\Models\CerberusSavedTemplate;
use Livewire\Component;

class CerberusTemplates extends Component
{
    public function mount()
    {
        // Asegurarse de que existe la plantilla por defecto
        $defaultTemplate = CerberusSavedTemplate::where('name', 'Default Template')->first();
        if (!$defaultTemplate) {
            $defaultTemplate = CerberusSavedTemplate::create([
                'name' => 'Default Template',
                'description' => 'Plantilla por defecto del sistema',
                'blocks' => [
                    'settings' => [
                        'content' => [
                            'background_color' => '#ebebeb',
                            'preheader' => 'Newsletter preview text',
                            'padding' => '0',
                            'alignment' => 'center'
                        ]
                    ],
                    'block_1' => [
                        'type' => 'header',
                        'content' => [
                            'title' => 'Bienvenido a nuestra newsletter',
                            'subtitle' => 'Las últimas novedades directamente en tu bandeja de entrada'
                        ],
                        'order' => 0
                    ],
                    'block_2' => [
                        'type' => 'text',
                        'content' => [
                            'text' => 'Este es un ejemplo de contenido para tu newsletter. Personalízalo según tus necesidades.'
                        ],
                        'order' => 1
                    ],
                    'block_3' => [
                        'type' => 'button',
                        'content' => [
                            'text' => 'Saber más',
                            'url' => '#',
                            'align' => 'center'
                        ],
                        'order' => 2
                    ]
                ],
                'is_default' => true
            ]);
        }
    }

    public function render()
    {
        $templates = collect([
            // Plantilla en blanco
            [
                'id' => null,
                'name' => 'Nueva Plantilla',
                'description' => 'Comenzar con una plantilla en blanco',
                'thumbnail' => asset('img/cerberus/blank-template.jpg'),
                'is_default' => false
            ]
        ]);

        // Obtener la plantilla por defecto
        $defaultTemplate = CerberusSavedTemplate::where('name', 'Default Template')->first();
        if ($defaultTemplate) {
            $templates->push([
                'id' => $defaultTemplate->id,
                'name' => $defaultTemplate->name,
                'description' => $defaultTemplate->description ?? 'Plantilla por defecto del sistema',
                'thumbnail' => $defaultTemplate->thumbnail ?? asset('img/cerberus/default-template.jpg'),
                'is_default' => true
            ]);
        }

        // Obtener las plantillas del usuario
        $userTemplates = CerberusSavedTemplate::where('name', '!=', 'Default Template')
            ->get()
            ->map(function($template) {
                return [
                    'id' => $template->id,
                    'name' => $template->name,
                    'description' => $template->description ?? 'Plantilla personalizada',
                    'thumbnail' => $template->thumbnail ?? asset('img/cerberus/custom-template.jpg'),
                    'is_default' => false
                ];
            });

        $templates = $templates->concat($userTemplates);

        return view('livewire.cerberus-templates', [
            'templates' => $templates
        ]);
    }

    public function selectTemplate($templateId = null)
    {
        return redirect()->route('cerberus.editor', ['template' => $templateId]);
    }

    public function confirmDelete($templateId)
    {
        $this->js("
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción no se puede deshacer',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    \$wire.deleteTemplate($templateId)
                }
            })
        ");
    }

    public function deleteTemplate($templateId)
    {
        try {
            $template = CerberusSavedTemplate::find($templateId);
            
            // Verificar que no sea la plantilla en blanco o por defecto
            if (!$template || $template->id <= 2) {
                $this->js("
                    Swal.fire({
                        icon: 'error',
                        title: 'No se puede eliminar esta plantilla',
                        timer: 1500
                    });
                ");
                return;
            }
            
            $template->delete();
            $this->js("
                Swal.fire({
                    icon: 'success',
                    title: 'Plantilla eliminada',
                    position: 'top-end',
                    timer: 1500,
                    showConfirmButton: false,
                });
            ");
            
        } catch (\Exception $e) {
            $this->js("
                Swal.fire({
                    icon: 'error',
                    title: 'Error al eliminar la plantilla',
                    text: '{$e->getMessage()}',
                    timer: 1500
                });
            ");
        }
    }
}
