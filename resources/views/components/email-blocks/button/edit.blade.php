@props(['blockKey', 'content'])

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">URL</label>
        <input type="text" class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.url">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Texto del Botón</label>
        <input type="text" class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.text">
    </div>
</div>
<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">Ancho (px)</label>
        <input type="number" class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.width">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Alto (px)</label>
        <input type="number" class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.height">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Alineación</label>
        <select class="form-select" wire:model.live="blocks.{{ $blockKey }}.content.alignment">
            <option value="left">Izquierda</option>
            <option value="center">Centro</option>
            <option value="right">Derecha</option>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">Tamaño de Fuente (px)</label>
        <input type="number" class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.font_size">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Peso de Fuente</label>
        <select class="form-select" wire:model.live="blocks.{{ $blockKey }}.content.font_weight">
            <option value="normal">Normal</option>
            <option value="bold">Bold</option>
            <option value="bolder">Bolder</option>
            <option value="lighter">Lighter</option>
        </select>
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Color del Texto</label>
        <div class="input-group">
            <input type="color" class="form-control form-control-color"
                wire:model.live="blocks.{{ $blockKey }}.content.text_color"
                value="{{ $content['text_color'] ?? '#fafafa' }}"
                title="Elige el color del texto">
            <input type="text" class="form-control"
                wire:model.live="blocks.{{ $blockKey }}.content.text_color"
                value="{{ $content['text_color'] ?? '#fafafa' }}"
                placeholder="#fafafa">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">Radio del Borde (px)</label>
        <input type="number" class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.border_radius">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Padding Superior (px)</label>
        <input type="number" class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.padding_top">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Padding Inferior (px)</label>
        <input type="number" class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.padding_bottom">
    </div>
</div>
<div class="mb-3">
    <label class="form-label">Ancho del Contenedor (px)</label>
    <input type="number" class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.container_width">
</div>
<div class="row">
    <div class="col-md-6 mb-3">
    <label class="form-label">Color de Fondo del Botón</label>
        <div class="input-group">
            <input type="color" class="form-control form-control-color"
                wire:model.live="blocks.{{ $blockKey }}.content.button_background_color"
                value="{{ $content['button_background_color'] ?? '#007bff' }}"
                title="Elige el color de fondo del botón">
            <input type="text" class="form-control"
                wire:model.live="blocks.{{ $blockKey }}.content.button_background_color"
                value="{{ $content['button_background_color'] ?? '#007bff' }}"
                placeholder="#007bff">
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <x-email-blocks.color-picker :blockKey="$blockKey" :blockContent="$content" />
    </div>
</div>