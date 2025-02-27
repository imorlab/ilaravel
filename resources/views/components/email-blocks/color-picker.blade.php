@props(['blockKey', 'blockContent', 'label' => 'Fondo del Bloque', 'colorKey' => 'background_color', 'defaultColor' => '#ededed'])

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
