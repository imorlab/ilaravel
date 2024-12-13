@props(['blockKey', 'blockType' => 'content', 'block'])

<div class="modal fade" id="saveBlockModal{{ $blockKey }}" tabindex="-1" aria-labelledby="saveBlockModalLabel{{ $blockKey }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="saveBlockModalLabel{{ $blockKey }}">Guardar Bloque</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nombre del Bloque</label>
                    <input type="text" class="form-control" wire:model="blockName">
                </div>

                <div class="mb-3">
                    <label class="form-label">Categoría</label>
                    <select class="form-select" wire:model="blockCategory">
                        <option value="header">Header</option>
                        <option value="content">Content</option>
                        <option value="footer">Footer</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Vista Previa</label>
                    <div class="border rounded p-2" style="max-height: 200px; overflow-y: auto;">
                        @include('emails.blocks.' . $blockType, ['block' => $block])
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" wire:click="saveBlock('{{ $blockKey }}', '{{ $blockType }}')">
                    Guardar Bloque
                </button>
            </div>
        </div>
    </div>
</div>
