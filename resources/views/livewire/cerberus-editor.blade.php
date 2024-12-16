<div>
    <style>
        .nav-tabs-custom {
            /* border-bottom: 2px solid #dee2e6; */
        }

        .nav-tabs-custom .nav-item-custom {
            margin-bottom: 1rem;
        }

        .nav-tabs-custom .nav-link-custom {
            border: none;
            border-bottom: 2px solid transparent;
            color: #6c757d;
            text-decoration: none;
            font-weight: 500;
            padding: 0.7rem;
            transition: all 0.2s ease-in-out;
        }

        .nav-tabs-custom .nav-link-custom:hover {
            border-color: transparent;
            color: #495057;
        }

        .nav-tabs-custom .nav-link-custom.active {
            color: #6366f1;
            border-bottom: 2px solid #6366f1;
            background-color: transparent;
        }

        .tab-content-custom {
            padding-top: 1.5rem;
        }

        /* Estilos para drag & drop */
        .draggable-block {
            cursor: move;
            transition: all 0.3s ease;
        }

        .draggable-block:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .draggable-block.dragging {
            opacity: 0.5;
            transform: scale(0.95);
        }

        .preview-container {
            min-height: 200px;
        }

        .email-preview {
            /* background-color: #f8f9fa; */
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
        }

        .email-container {
            background-color: #ffffff;
        }

        .email-block-wrapper {
            position: relative;
        }

        .email-block-content {
            position: relative;
        }

        .email-block-wrapper:hover .block-controls {
            opacity: 1 !important;
        }

        .block-controls {
            z-index: 1000;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 0.375rem;
            padding: 0.25rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: opacity 0.2s ease;
        }

        .cursor-move {
            cursor: move;
        }

        /* Estilos para el arrastre */
        .sortable-ghost {
            opacity: 0.5;
        }

        .sortable-chosen {
            position: relative;
        }

        .sortable-chosen::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(99, 102, 241, 0.1);
            pointer-events: none;
        }
    </style>
    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-md-4 bg-light p-4 rounded-3 shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4>Bloques de Contenido</h4>
                    
                </div>

                <div class="accordion" id="blocksAccordion">
                    <!-- Bloques del Sistema -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#systemBlocks">
                            <i class="fa-solid fa-briefcase me-2"></i> Bloques Disponibles
                            </button>
                        </h2>
                        <div id="systemBlocks" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                                <div>
                                    <ul class="nav nav-tabs-custom mb-3">
                                        <li class="nav-item-custom">
                                            <a class="nav-link-custom active" data-bs-toggle="tab" href="#headers" wire:ignore.self>Imagen</a>
                                        </li>
                                        <li class="nav-item-custom">
                                            <a class="nav-link-custom" data-bs-toggle="tab" href="#content" wire:ignore.self>Contenido</a>
                                        </li>
                                        <li class="nav-item-custom">
                                            <a class="nav-link-custom" data-bs-toggle="tab" href="#column" wire:ignore.self>Columnas</a>
                                        </li>
                                        <li class="nav-item-custom">
                                            <a class="nav-link-custom" data-bs-toggle="tab" href="#button" wire:ignore.self>Botones</a>
                                        </li>
                                        <li class="nav-item-custom">
                                            <a class="nav-link-custom" data-bs-toggle="tab" href="#footers" wire:ignore.self>Footers</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="headers" wire:ignore.self>
                                        @foreach($blocks as $key => $block)
                                            @if(in_array($key, ['header', 'hero']))
                                                <div class="draggable-block mb-3"
                                                     draggable="true"
                                                     data-block-key="{{ $key }}"
                                                     ondragstart="dragStart(event)"
                                                     ondragend="dragEnd(event)">
                                                    <x-email-blocks.block-card :block="$block" :blockKey="$key" />
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="tab-pane fade" id="content" wire:ignore.self>
                                        @foreach($blocks as $key => $block)
                                            @if(in_array($key, ['content']))
                                                <div class="draggable-block mb-3"
                                                     draggable="true"
                                                     data-block-key="{{ $key }}"
                                                     ondragstart="dragStart(event)"
                                                     ondragend="dragEnd(event)">
                                                    <x-email-blocks.block-card :block="$block" :blockKey="$key" />
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="tab-pane fade" id="column" wire:ignore.self>
                                        @foreach($blocks as $key => $block)
                                            @if(in_array($key, ['two_columns']))
                                                <div class="draggable-block mb-3"
                                                     draggable="true"
                                                     data-block-key="{{ $key }}"
                                                     ondragstart="dragStart(event)"
                                                     ondragend="dragEnd(event)">
                                                    <x-email-blocks.block-card :block="$block" :blockKey="$key" />
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="tab-pane fade" id="button" wire:ignore.self>
                                        @foreach($blocks as $key => $block)
                                            @if(in_array($key, ['button']))
                                                <div class="draggable-block mb-3"
                                                     draggable="true"
                                                     data-block-key="{{ $key }}"
                                                     ondragstart="dragStart(event)"
                                                     ondragend="dragEnd(event)">
                                                    <x-email-blocks.block-card :block="$block" :blockKey="$key" />
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="tab-pane fade" id="footers" wire:ignore.self>
                                        @foreach($blocks as $key => $block)
                                            @if($key === 'footer')
                                                <div class="draggable-block mb-3"
                                                     draggable="true"
                                                     data-block-key="{{ $key }}"
                                                     ondragstart="dragStart(event)"
                                                     ondragend="dragEnd(event)">
                                                    <x-email-blocks.block-card :block="$block" :blockKey="$key" />
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Configuración Global -->
                    <div class="accordion-item" wire:ignore>
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#settingsBlock">
                                <i class="fas fa-cog me-2"></i> Configuración
                            </button>
                        </h2>
                        <div id="settingsBlock" class="accordion-collapse collapse show" wire:ignore.self>
                            <div class="accordion-body">
                                <x-email-blocks.settings />
                            </div>
                        </div>
                    </div>

                    <!-- Bloques Guardados -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#savedBlocks">
                            <i class="fa-solid fa-user-plus me-2"></i> Bloques Guardados ({{ $savedBlocksCount }}/10)
                            </button>
                        </h2>
                        <div id="savedBlocks" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                                <div class="tab-content">
                                    @foreach($blocks as $key => $block)
                                        @if(str_starts_with($key, 'saved_'))
                                            <div class="draggable-block mb-3"
                                                 draggable="true"
                                                 data-block-key="{{ $key }}"
                                                 ondragstart="dragStart(event)"
                                                 ondragend="dragEnd(event)">
                                                <x-email-blocks.block-card :block="$block" :blockKey="$key" />
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="bg-light p-4 rounded-3 shadow-sm">
                    <h4>Vista Previa</h4>
                    <div class="d-flex justify-content-end align-items-center gap-4">
                        <button class="btn btn-success border-0" wire:click="downloadTemplate">
                            Descargar <i class="bi bi-download"></i>
                        </button>
                        <button class="btn btn-primary border-0" data-bs-toggle="modal" data-bs-target="#saveTemplateModal">
                            Guardar <i class="bi bi-floppy"></i>
                        </button>
                    </div>
                    <div class="preview-container mt-4"
                         ondragover="event.preventDefault()"
                         ondragenter="dragEnter(event)"
                         ondragleave="dragLeave(event)"
                         ondrop="drop(event)">
                        <div class="email-preview">
                            <center role="article" aria-roledescription="email" lang="en" style="width: 100%; background-color: {{ $blocks['settings']['content']['background_color'] ?? '#ebebeb' }};">
                                <!-- Visually Hidden Preheader Text : BEGIN -->
                                <div style="max-height:0; overflow:hidden; mso-hide:all;" aria-hidden="true">
                                    {{ isset($blocks['settings']['content']['preheader']) ? $blocks['settings']['content']['preheader'] : 'Newsletter preview text' }}
                                </div>
                                <!-- Visually Hidden Preheader Text : END -->

                                <div style="max-width: 600px; margin: 0 auto;" class="email-container">
                                    <!-- Email Body : BEGIN -->
                                    <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                                        <tbody wire:sortable="updateBlockOrder"
                                               wire:sortable.options="{ animation: 150, dragClass: 'sortable-drag' }">
                                            @if(is_array($blocks))
                                                @php
                                                    $activeBlocks = collect($blocks)
                                                        ->filter(function ($block) {
                                                            return $block['active'] ?? false;
                                                        })
                                                        ->sortBy(function ($block) {
                                                            return $block['order'] ?? PHP_INT_MAX;
                                                        })
                                                        ->toArray();
                                                @endphp

                                                @if(empty($activeBlocks))
                                                    <tr>
                                                        <td>
                                                            <div class="text-center p-4 text-muted">
                                                                <i class="fas fa-arrow-left fa-2x mb-2"></i>
                                                                <p>Arrastra bloques aquí para construir tu plantilla</p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @else
                                                    @foreach($activeBlocks as $key => $block)
                                                        <tr wire:key="preview-{{ $key }}"
                                                            wire:sortable.item="{{ $key }}"
                                                            class="email-block-wrapper">
                                                            <td style="background-color: {{ $block['content']['background_color'] ?? '#fafafa' }};">
                                                                <div class="email-block-content position-relative">
                                                                    <div wire:sortable.handle
                                                                         class="position-absolute top-0 end-0 m-2 opacity-0 block-controls">
                                                                        <button class="btn btn-sm btn-light me-2"
                                                                                wire:click="toggleBlock('{{ $key }}')"
                                                                                title="Ocultar bloque">
                                                                            <i class="fas fa-eye-slash"></i>
                                                                        </button>
                                                                        <span class="btn btn-sm btn-light cursor-move" title="Mover bloque">
                                                                            <i class="fas fa-grip-vertical"></i>
                                                                        </span>
                                                                    </div>
                                                                    @include("emails.blocks.{$block['type']}", ['block' => $block])
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            @else
                                                <tr>
                                                    <td>
                                                        <div class="text-center p-4">Loading preview...</div>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    <!-- Email Body : END -->
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modales -->
    <x-email-blocks.save-template-modal :templateId="$templateId" :blocks="$blocks" />

    @foreach($blocks as $key => $block)
        @if(isset($block['type']))
            <x-email-blocks.save-block-modal :blockKey="$key" :blockType="$block['type']" :block="$block" />
        @endif
    @endforeach

    @push('scripts')
    <script>
        function dragStart(event) {
            event.target.classList.add('dragging');
            event.dataTransfer.setData('blockKey', event.target.dataset.blockKey);
        }

        function dragEnd(event) {
            event.target.classList.remove('dragging');
        }

        function dragEnter(event) {
            event.preventDefault();
            event.target.closest('.preview-container').classList.add('drag-over');
        }

        function dragLeave(event) {
            event.preventDefault();
            event.target.closest('.preview-container').classList.remove('drag-over');
        }

        function drop(event) {
            event.preventDefault();
            const previewContainer = event.target.closest('.preview-container');
            previewContainer.classList.remove('drag-over');

            const blockKey = event.dataTransfer.getData('blockKey');
            if (blockKey) {
                @this.addBlock(blockKey);
            }
        }

        document.addEventListener('livewire:initialized', () => {
            @this.on('showToast', (data) => {
                Swal.fire(data[0]);
            });

            @this.on('showAuthAlert', (data) => {
                Swal.fire({
                    title: data[0].title,
                    text: data[0].text,
                    icon: data[0].icon,
                    showCancelButton: data[0].showCancelButton,
                    confirmButtonText: data[0].confirmButtonText,
                    cancelButtonText: data[0].cancelButtonText,
                    confirmButtonColor: data[0].confirmButtonColor,
                    cancelButtonColor: data[0].cancelButtonColor
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '{{ route("register") }}';
                    }
                });
            });

            // Inicializar las pestañas de Bootstrap
            const triggerTabList = [].slice.call(document.querySelectorAll('.nav-link-custom'));
            triggerTabList.forEach(function (triggerEl) {
                const tabTrigger = new bootstrap.Tab(triggerEl);
                
                triggerEl.addEventListener('click', function (event) {
                    event.preventDefault();
                    tabTrigger.show();
                });
            });

            // Mantener la pestaña activa después de las actualizaciones de Livewire
            const activeTab = document.querySelector('.nav-link-custom.active');
            if (activeTab) {
                const tabId = activeTab.getAttribute('href').substring(1);
                const tabContent = document.getElementById(tabId);
                if (tabContent) {
                    document.querySelectorAll('.tab-pane').forEach(pane => {
                        pane.classList.remove('show', 'active');
                    });
                    tabContent.classList.add('show', 'active');
                }
            }

            // Escuchar el evento closeModal
            @this.on('closeModal', (data) => {
                const modalId = data.modal;
                const modalElement = document.getElementById(modalId);
                const modal = bootstrap.Modal.getInstance(modalElement);
                if (modal) {
                    modal.hide();
                }
                // También eliminar el backdrop si existe
                const backdrop = document.querySelector('.modal-backdrop');
                if (backdrop) {
                    backdrop.remove();
                }
                // Restaurar el scroll del body
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            });
        });
    </script>
    @endpush
</div>
