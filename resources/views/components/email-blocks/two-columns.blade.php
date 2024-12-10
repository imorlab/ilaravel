@props(['blockKey', 'content'])

<div class="mb-3">
    <h6>Left Column</h6>
    <div class="mb-2">
        <label class="form-label">Image URL</label>
        <input type="text" class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.left.image">
    </div>
    <div class="mb-2">
        <label class="form-label">Text</label>
        <textarea class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.left.text"></textarea>
    </div>
</div>

<div class="mb-3">
    <h6>Right Column</h6>
    <div class="mb-2">
        <label class="form-label">Image URL</label>
        <input type="text" class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.right.image">
    </div>
    <div class="mb-2">
        <label class="form-label">Text</label>
        <textarea class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.right.text"></textarea>
    </div>
</div>

<x-email-blocks.color-picker :blockKey="$blockKey" :blockContent="$content" />
