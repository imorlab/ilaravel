@props(['blockKey', 'content'])

<div class="row g-3">
    <div class="col-md-9">
        <label class="form-label">Image URL</label>
        <input type="text" class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.image">
    </div>
    <div class="col-md-3">
        <label class="form-label">Alt Text</label>
        <input type="text" class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.alt">
    </div>
</div>
<div class="row g-3 mt-1">
    <div class="col-md-4">
        <label class="form-label">Ancho imagen (px)</label>
        <input type="number" class="form-control"
               wire:model.live="blocks.{{ $blockKey }}.content.width"
               value="{{ $content['width'] ?? '600' }}"
               min="1" max="1200">
    </div>
    <div class="col-md-4">
        <label class="form-label">Padding (px)</label>
        <input type="number" class="form-control"
               wire:model.live="blocks.{{ $blockKey }}.content.padding"
               value="{{ $content['padding'] ?? '0' }}"
               min="0" max="100">
    </div>
    <div class="col-md-4">
        <label class="form-label">Alineación</label>
        <select class="form-select" wire:model.live="blocks.{{ $blockKey }}.content.alignment">
            <option value="left">Izquierda</option>
            <option value="center">Centro</option>
            <option value="right">Derecha</option>
        </select>
    </div>
</div>
<div class="row g-3 mt-1">
    <div class="col-md-6">
        <x-email-blocks.color-picker :blockKey="$blockKey" :blockContent="$content" />
    </div>
    <div class="col-md-6">
        <x-email-blocks.color-picker
        :blockKey="$blockKey"
        :blockContent="$content"
        label="Fondo de la Imagen"
        colorKey="image_background_color"
        defaultColor="#dddddd"
        />
    </div>
</div>
