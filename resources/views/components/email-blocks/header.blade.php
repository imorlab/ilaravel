@props(['blockKey', 'content'])

<div class="mb-3">
    <label class="form-label">Logo URL</label>
    <input type="text" class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.logo">
</div>
<div class="mb-3">
    <label class="form-label">Alt Text</label>
    <input type="text" class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.alt">
</div>
<div class="mb-3">
    <label class="form-label">Width (max 600px)</label>
    <input type="number" class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.width">
</div>
<div class="mb-3">
    <label class="form-label">Alignment</label>
    <select class="form-select" wire:model.live="blocks.{{ $blockKey }}.content.alignment">
        <option value="left">Izquierda</option>
        <option value="center">Centro</option>
        <option value="right">Derecha</option>
    </select>
</div>

<x-email-blocks.color-picker :blockKey="$blockKey" :blockContent="$content" />
