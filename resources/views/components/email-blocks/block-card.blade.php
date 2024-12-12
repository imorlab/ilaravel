@props(['block', 'blockKey'])

<div class="card mb-2">
    <div class="card-body p-2">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h6 class="card-title mb-0">{{ ucfirst($blockKey) }}</h6>
                <small class="text-muted">{{ $block['type'] ?? $blockKey }}</small>
            </div>
            <div class="btn-group">
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
                @switch($blockKey)
                    @case('header')
                        <x-email-blocks.header :blockKey="$blockKey" :content="$block['content']" />
                        @break

                    @case('hero')
                        <x-email-blocks.hero :blockKey="$blockKey" :content="$block['content']" />
                        @break

                    @case('content')
                        <x-email-blocks.content :blockKey="$blockKey" :content="$block['content']" />
                        @break

                    @case('two_columns')
                        <x-email-blocks.two-columns :blockKey="$blockKey" :content="$block['content']" />
                        @break

                    @case('button')
                        <x-email-blocks.button :blockKey="$blockKey" :content="$block['content']" />
                        @break

                    @case('footer')
                        <x-email-blocks.footer :blockKey="$blockKey" :content="$block['content']" />
                        @break
                @endswitch
            </div>
        @endif
    </div>
</div>
