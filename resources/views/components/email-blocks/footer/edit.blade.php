@props(['blockKey', 'content'])

<div class="mb-3">
    <label class="form-label">Company Name</label>
    <input type="text" class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.company">
</div>
<div class="mb-3">
    <label class="form-label">Address</label>
    <input type="text" class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.address">
</div>
<div class="mb-3">
    <label class="form-label">Phone</label>
    <input type="text" class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.phone">
</div>

<x-email-blocks.color-picker :blockKey="$blockKey" :blockContent="$content" />
