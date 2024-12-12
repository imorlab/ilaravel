<div>
    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-md-4 bg-light p-4 rounded-3 shadow-sm">
                <h4>Bloques de Contenido</h4>
                <div class="list-group mt-4">
                    <!-- Configuración Global -->
                    <x-email-blocks.settings :block="$blocks['settings']" />

                    <!-- Bloques de Contenido -->
                    @foreach($blocks as $key => $block)
                        @if($key !== 'settings')
                            <div class="list-group-item rounded-3 mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">{{ ucfirst($key) }}</h5>
                                    <div>
                                        <div class="form-check form-switch d-inline-block me-2">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                wire:model.live="blocks.{{ $key }}.active"
                                                id="block_{{ $key }}">
                                        </div>
                                    </div>
                                </div>

                                @if($block['active'])
                                    <div class="mt-3">
                                        @switch($key)
                                            @case('header')
                                                <x-email-blocks.header :blockKey="$key" :content="$block['content']" />
                                                @break

                                            @case('hero')
                                                <x-email-blocks.hero :blockKey="$key" :content="$block['content']" />
                                                @break

                                            @case('content')
                                                <x-email-blocks.content :blockKey="$key" :content="$block['content']" />
                                                @break

                                            @case('two_columns')
                                                <x-email-blocks.two-columns :blockKey="$key" :content="$block['content']" />
                                                @break

                                            @case('button')
                                                <x-email-blocks.button :blockKey="$key" :content="$block['content']" />
                                                @break

                                            @case('footer')
                                                <x-email-blocks.footer :blockKey="$key" :content="$block['content']" />
                                                @break
                                        @endswitch
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>


            </div>

            <div class="col-md-8">
                <div class="bg-light p-4 rounded-3 shadow-sm">
                    <h4>Vista Previa</h4>
                    <div class="border rounded-3 p-3 mt-3 bg-white">
                        <div wire:poll.5s id="preview-container">
                            {!! $previewHtml !!}
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
</div>
