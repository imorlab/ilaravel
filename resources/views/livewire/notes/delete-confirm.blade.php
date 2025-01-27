<div>
    @if($show)
    <div class="modal-backdrop" style="display: block; background: rgba(0, 0, 0, 0.5);"></div>
    <div class="modal" style="display: block;" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content glass-modal">
                <div class="modal-header">
                    <h5 class="modal-title text-light">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" wire:click="close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-light">¿Estás seguro de que deseas eliminar esta nota?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="close">Cancelar</button>
                    <button type="button" class="btn btn-danger" wire:click="delete">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
