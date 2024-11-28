<div>
    @if($show)
    <div class="modal-backdrop" style="display: block; background: rgba(0, 0, 0, 0.5);"></div>
    <div class="modal" style="display: block;" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content glass-modal">
                <div class="modal-header">
                    <h5 class="modal-title text-light">{{ $editingNoteId ? 'Editar Nota' : 'Nueva Nota' }}</h5>
                    <button type="button" class="btn-close" wire:click="close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="save">
                        <div class="mb-3">
                            <label for="title" class="form-label text-light">Título</label>
                            <input type="text" class="form-control glass-input" id="title" wire:model="title">
                            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label text-light">Contenido</label>
                            <textarea class="form-control glass-input" id="content" rows="3" wire:model="content"></textarea>
                            @error('content') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label text-light">Categoría</label>
                            <select class="form-select glass-input" id="category" wire:model="category">
                                <option value="">Seleccionar categoría</option>
                                <option value="trabajo">Trabajo</option>
                                <option value="personal">Personal</option>
                                <option value="ideas">Ideas</option>
                            </select>
                            @error('category') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="close">Cancelar</button>
                            <button type="submit" class="btn btn-primary">{{ $editingNoteId ? 'Actualizar' : 'Guardar' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
