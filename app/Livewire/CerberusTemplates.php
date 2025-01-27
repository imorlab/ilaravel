<?php

namespace App\Livewire;

use App\Models\CerberusSavedTemplate;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CerberusTemplates extends Component
{
    public $newTemplateName = '';
    public $newTemplateDescription = '';
    public $defaultTemplateId = null;
    public $showNewTemplateModal = false;

    protected $rules = [
        'newTemplateName' => 'required|min:3|max:255',
        'newTemplateDescription' => 'nullable|max:1000'
    ];

    protected $messages = [
        'newTemplateName.required' => 'El nombre de la plantilla es obligatorio',
        'newTemplateName.min' => 'El nombre debe tener al menos 3 caracteres',
        'newTemplateName.max' => 'El nombre no puede exceder los 255 caracteres',
        'newTemplateDescription.max' => 'La descripción no puede tener más de 1000 caracteres'
    ];

    public function mount()
    {
        // Asegurarse de que existe la plantilla por defecto
        // $defaultTemplate = CerberusSavedTemplate::where('name', 'Default Template')->first();
        // if (!$defaultTemplate) {
        //     $defaultTemplate = CerberusSavedTemplate::create([
        //         'name' => 'Default Template',
        //         'description' => 'Plantilla por defecto del sistema',
        //         'blocks' => [
        //             'settings' => [
        //                 'content' => [
        //                     'background_color' => '#ebebeb',
        //                     'preheader' => 'Newsletter preview text',
        //                     'padding' => '0',
        //                     'alignment' => 'center'
        //                 ]
        //             ],
        //             'block_1' => [
        //                 'type' => 'header',
        //                 'content' => [
        //                     'title' => 'Bienvenido a nuestra newsletter',
        //                     'subtitle' => 'Las últimas novedades directamente en tu bandeja de entrada'
        //                 ],
        //                 'order' => 0
        //             ],
        //             'block_2' => [
        //                 'type' => 'text',
        //                 'content' => [
        //                     'text' => 'Este es un ejemplo de contenido para tu newsletter. Personalízalo según tus necesidades.'
        //                 ],
        //                 'order' => 1
        //             ],
        //             'block_3' => [
        //                 'type' => 'button',
        //                 'content' => [
        //                     'text' => 'Saber más',
        //                     'url' => '#',
        //                     'align' => 'center'
        //                 ],
        //                 'order' => 2
        //             ]
        //         ],
        //         'is_default' => true
        //     ]);
        // }
    }

    public function showNewTemplateModal()
    {
        $this->dispatch('showModal');
    }

    public function hideNewTemplateModal()
    {
        $this->dispatch('hideModal');
        $this->reset(['newTemplateName', 'newTemplateDescription', 'defaultTemplateId']);
    }

    public function setDefaultAsBase($templateId)
    {
        $this->defaultTemplateId = $templateId;
        $this->showNewTemplateModal();
    }

    #[On('modalClosed')]
    public function handleModalClosed()
    {
        $this->reset(['newTemplateName', 'newTemplateDescription', 'defaultTemplateId']);
    }

    public function createTemplate()
    {
        if (!auth()->check()) {
            session()->flash('error', 'Debes iniciar sesión para crear una plantilla');
            $this->dispatch('closeModal', ['modal' => 'newTemplateModal']);
            return redirect()->route('login');
        }

        $this->validate([
            'newTemplateName' => 'required|min:3|max:255'
        ], [
            'newTemplateName.required' => 'El nombre es requerido',
            'newTemplateName.min' => 'El nombre debe tener al menos 3 caracteres',
            'newTemplateName.max' => 'El nombre no puede exceder los 255 caracteres'
        ]);
        
        try {
            DB::beginTransaction();
            
            if ($this->defaultTemplateId) {
                // Copiar plantilla por defecto
                $defaultTemplate = CerberusSavedTemplate::findOrFail($this->defaultTemplateId);
                $template = $defaultTemplate->replicate();
                $template->name = $this->newTemplateName;
                $template->description = $this->newTemplateDescription;
                $template->user_id = auth()->id();
                $template->is_default = false;
                $template->save();
            } else {
                // Crear plantilla en blanco con bloques predefinidos desactivados
                $template = CerberusSavedTemplate::create([
                    'name' => $this->newTemplateName,
                    'description' => $this->newTemplateDescription,
                    'user_id' => auth()->id(),
                    'is_default' => false,
                    'blocks' => [
                        'settings' => [
                            'type' => 'settings',
                            'content' => [
                                'background_color' => '#ebebeb',
                                'preheader' => 'Newsletter preview text'
                                ]
                            ],
                            'header' => [
                                'active' => false,
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
                                    'active' => false,
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
                                        'active' => false,
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
                                            'active' => false,
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
                                            'button' => [
                                                'active' => false,
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
                                        'two-columns-right' => [
                                            'active' => false,
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
                                                'active' => false,
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
                                            'active' => false,
                                            'type' => 'footer',
                                            'content' => [
                                                'company' => 'Your Company Name',
                                                'address' => '123 Street Name, City, Country',
                                                'phone' => '+1 234 567 890',
                                                'background_color' => '#fafafa'
                                                ]
                                            ]
                        ]
                    ]);
                }
                            
            DB::commit();
            
            // Limpiar el formulario
            $this->reset(['newTemplateName', 'newTemplateDescription', 'defaultTemplateId']);
            
            // Cerrar el modal y redirigir
            $this->dispatch('closeModal', ['modal' => 'newTemplateModal']);
            
            // Redirigir al editor
            return redirect()->to("/cerberus/editor/{$template->id}");

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error al crear la plantilla: ' . $e->getMessage());
        }
    }

    public function editTemplate($templateId)
    {
        return redirect()->route('cerberus.editor', ['template' => $templateId]);
    }

    public function render()
    {
        // Obtener la plantilla por defecto
        $defaultTemplate = CerberusSavedTemplate::where('is_default', true)->first();

        // Obtener las plantillas del usuario
        $userTemplates = CerberusSavedTemplate::where('is_default', false)
            ->where('user_id', auth()->id())
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

        // Agregar la plantilla por defecto al inicio
        $templates = collect();
        if ($defaultTemplate) {
            $templates->push([
                'id' => $defaultTemplate->id,
                'name' => $defaultTemplate->name,
                'description' => $defaultTemplate->description ?? 'Plantilla por defecto del sistema',
                'thumbnail' => $defaultTemplate->thumbnail ?? asset('img/cerberus/default-template.jpg'),
                'is_default' => true
            ]);
        }

        // Agregar las plantillas del usuario
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
