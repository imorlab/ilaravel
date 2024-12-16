@props(['block', 'blockKey'])

<div class="card mb-2">
    <div class="card-body p-2">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h6 class="card-title mb-0">{{ ucfirst($blockKey) }}</h6>
                <small class="text-muted">{{ $block['type'] ?? $blockKey }}</small>
            </div>
            <div class="btn-group">
                @if(!str_starts_with($blockKey, 'saved_'))
                    <button class="btn btn-sm btn-outline-primary" 
                            wire:click="duplicateBlock('{{ $blockKey }}')"
                            title="Duplicar bloque">
                        <i class="bi bi-files"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-success"
                            data-bs-toggle="modal"
                            data-bs-target="#saveBlockModal{{ $blockKey }}"
                            title="Guardar bloque">
                        <i class="bi bi-bookmark-plus"></i>
                    </button>
                @else
                    <button class="btn btn-sm btn-outline-danger"
                            wire:click="deleteSavedBlock('{{ $blockKey }}')"
                            title="Eliminar bloque">
                        <i class="bi bi-trash"></i>
                    </button>
                @endif
            </div>
        </div>

        <div class="form-check form-switch mt-2">
            <input class="form-check-input" type="checkbox" role="switch"
                   wire:model.live="blocks.{{ $blockKey }}.active"
                   id="block_{{ $blockKey }}">
            <label class="form-check-label" for="block_{{ $blockKey }}">
                Activar
            </label>
        </div>

        @if($block['active'])
            <div class="mt-2">
                @php
                    $type = $block['original_type'] ?? $block['type'];
                @endphp
                @switch($type)
                    @case('header')
                        <x-email-blocks.header.edit :blockKey="$blockKey" :content="$block['content']" />
                        @break

                    @case('hero')
                        <x-email-blocks.hero.edit :blockKey="$blockKey" :content="$block['content']" />
                        @break

                    @case('content')
                        <x-email-blocks.content.edit :blockKey="$blockKey" :content="$block['content']" />
                        @break

                    @case('button')
                        <x-email-blocks.button.edit :blockKey="$blockKey" :content="$block['content']" />
                        @break

                    @case('footer')
                        <x-email-blocks.footer.edit :blockKey="$blockKey" :content="$block['content']" />
                        @break

                    @case('two-columns-left')
                        <x-email-blocks.two-columns-left.edit :blockKey="$blockKey" :content="$block['content']" />
                        @break

                    @case('two-columns-right')
                        <x-email-blocks.two-columns-right.edit :blockKey="$blockKey" :content="$block['content']" />
                        @break

                    @default
                        <div class="alert alert-warning">
                            Tipo de bloque no soportado: {{ $type }}
                        </div>
                @endswitch
            </div>
        @endif
    </div>
</div>
