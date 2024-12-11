@props(['blockKey', 'blockContent', 'label' => 'Color de Fondo del Bloque', 'colorKey' => 'background_color', 'defaultColor' => '#f8f8f8'])

<div class="mb-3">
    <label class="form-label">{{ $label }}</label>
    <div class="input-group">
        <input type="color" class="form-control form-control-color" 
               wire:model.live="blocks.{{ $blockKey }}.content.{{ $colorKey }}"
               value="{{ $blockContent[$colorKey] ?? $defaultColor }}"
               title="Elige el color">
        <input type="text" class="form-control" 
               wire:model.live="blocks.{{ $blockKey }}.content.{{ $colorKey }}"
               value="{{ $blockContent[$colorKey] ?? $defaultColor }}"
               placeholder="{{ $defaultColor }}">
    </div>
</div>
