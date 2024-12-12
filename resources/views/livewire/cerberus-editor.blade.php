<div>
    <style>
        .nav-tabs-custom {
            /* border-bottom: 2px solid #dee2e6; */
        }

        .nav-tabs-custom .nav-item-custom {
            margin-bottom: -2px;

        }

        .nav-tabs-custom .nav-link-custom {
            border: none;
            border-bottom: 2px solid transparent;
            color: #6c757d;
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
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
    </style>
    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-md-4 bg-light p-4 rounded-3 shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4>Bloques de Contenido</h4>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#saveTemplateModal">
                        Guardar Plantilla
                    </button>
                </div>

                <div wire:ignore>
                    <div class="accordion" id="blocksAccordion">
                        <!-- Bloques del Sistema -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#systemBlocks">
                                    Bloques Disponibles
                                </button>
                            </h2>
                            <div id="systemBlocks" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <div wire:ignore>
                                        <ul class="nav nav-tabs-custom mb-3">
                                            <li class="nav-item-custom">
                                                <a class="nav-link-custom active" data-bs-toggle="tab" href="#headers">Headers</a>
                                            </li>
                                            <li class="nav-item-custom">
                                                <a class="nav-link-custom" data-bs-toggle="tab" href="#content">Contenido</a>
                                            </li>
                                            <li class="nav-item-custom">
                                                <a class="nav-link-custom" data-bs-toggle="tab" href="#footers">Footers</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="headers">
                                            @foreach($blocks as $key => $block)
                                                @if(in_array($key, ['header', 'hero']))
                                                    <x-email-blocks.block-card :block="$block" :blockKey="$key" />
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="tab-pane fade" id="content">
                                            @foreach($blocks as $key => $block)
                                                @if(in_array($key, ['text', 'two_columns', 'button']))
                                                    <x-email-blocks.block-card :block="$block" :blockKey="$key" />
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="tab-pane fade" id="footers">
                                            @foreach($blocks as $key => $block)
                                                @if($key === 'footer')
                                                    <x-email-blocks.block-card :block="$block" :blockKey="$key" />
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bloques Guardados -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#savedBlocks">
                                    Mis Bloques Guardados ({{ $savedBlocksCount ?? 0 }}/10)
                                </button>
                            </h2>
                            <div id="savedBlocks" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="row g-2">
                                        @forelse($savedBlocks ?? [] as $savedBlock)
                                            <div class="col-6">
                                                <div class="card">
                                                    <img src="{{ $savedBlock->thumbnail }}" class="card-img-top" alt="{{ $savedBlock->name }}">
                                                    <div class="card-body p-2">
                                                        <h6 class="card-title mb-0">{{ $savedBlock->name }}</h6>
                                                        <small class="text-muted">{{ $savedBlock->category }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12 text-center py-3">
                                                <p class="text-muted mb-0">No tienes bloques guardados</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="bg-light p-4 rounded-3 shadow-sm">
                    <h4>Vista Previa</h4>
                    <div class="border rounded-3 p-3 mt-3 bg-white">
                        <div wire:poll.5s id="preview-container">
                            @if(is_array($blocks))
                                @php
                                    $activeBlocks = collect($blocks)->filter(function ($block) {
                                        return $block['active'] ?? false;
                                    })->toArray();
                                @endphp

                                @if(empty($activeBlocks))
                                    <div class="text-center p-4">No hay bloques activos para mostrar</div>
                                @else
                                    @include('emails.template', ['blocks' => $activeBlocks])
                                @endif
                            @else
                                <div class="text-center p-4">Loading preview...</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <button class="btn btn-success" wire:click="downloadTemplate">
                        Download Template
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modales -->
    <x-email-blocks.save-template-modal :templateId="$templateId" :blocks="$blocks" />

    @foreach($blocks as $key => $block)
        <x-email-blocks.save-block-modal :blockKey="$key" :blockType="$block['type']" :block="$block" />
    @endforeach
</div>
