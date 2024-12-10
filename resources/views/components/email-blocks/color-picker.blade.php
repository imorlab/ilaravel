@props(['blockKey', 'blockContent'])

<div class="mb-3">
    <label class="form-label">Color de Fondo del Bloque</label>
    <div class="input-group">
        <input type="color" class="form-control form-control-color" 
               wire:model.live="blocks.{{ $blockKey }}.content.background_color"
               value="{{ $blockContent['background_color'] ?? '#f8f8f8' }}"
               title="Elige el color de fondo">
        <input type="text" class="form-control" 
               wire:model.live="blocks.{{ $blockKey }}.content.background_color"
               value="{{ $blockContent['background_color'] ?? '#f8f8f8' }}"
               placeholder="#f8f8f8">
    </div>
</div>
