@props(['blockKey', 'content'])

<div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.title">
</div>
<div class="mb-3">
    <label class="form-label">Text</label>
    <textarea class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.text"></textarea>
</div>
<div class="mb-3">
    <label class="form-label">Button Text</label>
    <input type="text" class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.button.text">
</div>
<div class="mb-3">
    <label class="form-label">Button URL</label>
    <input type="text" class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.button.url">
</div>

<x-email-blocks.color-picker :blockKey="$blockKey" :blockContent="$content" />
