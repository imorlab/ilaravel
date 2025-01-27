@props(['blockKey', 'content'])

<div class="row g-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Columna Izquierda</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label">Imagen</label>
                        <input type="text" class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.right.image">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Ancho Imagen</label>
                        <input type="number" class="form-control"
                               wire:model.live="blocks.{{ $blockKey }}.content.right.width"
                               value="{{ $content['right']['width'] ?? '280' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Alt Text</label>
                        <input type="text" class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.right.alt">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Columna Derecha</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label">Etiqueta Superior</label>
                        <div class="row g-2">
                            <div class="col-md-3">
                                <label class="form-label">Icono URL</label>
                                <input type="text" class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.left.icon">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Ancho Icono</label>
                                <input type="number" class="form-control"
                                       wire:model.live="blocks.{{ $blockKey }}.content.left.icon_width"
                                       value="{{ $content['left']['icon_width'] ?? '30' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Texto Etiqueta</label>
                                <input type="text" class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.left.label">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Título</label>
                        <input type="text" class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.left.title">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Color Destacado</label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color"
                                   wire:model.live="blocks.{{ $blockKey }}.content.left.highlight_color"
                                   value="{{ $content['left']['highlight_color'] ?? '#78CBCF' }}">
                            <input type="text" class="form-control"
                                   wire:model.live="blocks.{{ $blockKey }}.content.left.highlight_color"
                                   value="{{ $content['left']['highlight_color'] ?? '#78CBCF' }}"
                                   placeholder="#78CBCF">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Texto Destacado</label>
                        <input type="text" class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.left.highlight_text">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Contenido</label>
                        <textarea class="form-control" rows="3" wire:model.live="blocks.{{ $blockKey }}.content.left.text"></textarea>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Botón</label>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <input type="text" class="form-control"
                                       placeholder="Texto del botón"
                                       wire:model.live="blocks.{{ $blockKey }}.content.left.button_text">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control"
                                       placeholder="URL del botón"
                                       wire:model.live="blocks.{{ $blockKey }}.content.left.button_url">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Fondo del Botón</label>
                                <div class="input-group">
                                    <input type="color" class="form-control form-control-color"
                                           wire:model.live="blocks.{{ $blockKey }}.content.left.button_background"
                                           value="{{ $content['left']['button_background'] ?? '#007bff' }}"
                                           title="Elige el color de fondo del botón">
                                    <input type="text" class="form-control"
                                           wire:model.live="blocks.{{ $blockKey }}.content.left.button_background"
                                           value="{{ $content['left']['button_background'] ?? '#007bff' }}"
                                           placeholder="#007bff">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Texto del Botón</label>
                                <div class="input-group">
                                    <input type="color" class="form-control form-control-color"
                                           wire:model.live="blocks.{{ $blockKey }}.content.left.button_text_color"
                                           value="{{ $content['left']['button_text_color'] ?? '#fafafa' }}"
                                           title="Elige el color del texto del botón">
                                    <input type="text" class="form-control"
                                           wire:model.live="blocks.{{ $blockKey }}.content.left.button_text_color"
                                           value="{{ $content['left']['button_text_color'] ?? '#fafafa' }}"
                                           placeholder="#fafafa">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Alineación</label>
                                <select class="form-select"
                                        wire:model.live="blocks.{{ $blockKey }}.content.left.button_alignment">
                                    <option value="left">Izquierda</option>
                                    <option value="center">Centro</option>
                                    <option value="right">Derecha</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-4">
        <label class="form-label">Ancho del Contenedor</label>
        <input type="number" class="form-control"
               wire:model.live="blocks.{{ $blockKey }}.content.container_width"
               value="{{ $content['container_width'] ?? '550' }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Padding</label>
        <input type="number" class="form-control"
               wire:model.live="blocks.{{ $blockKey }}.content.padding"
               value="{{ $content['padding'] ?? '20' }}">
    </div>
    <div class="col-md-4">
        <x-email-blocks.color-picker :blockKey="$blockKey" :blockContent="$content" />
    </div>
</div>
