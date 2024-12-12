@props(['templateId', 'blocks'])

<div class="modal fade" id="saveTemplateModal" tabindex="-1" aria-labelledby="saveTemplateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Guardar Plantilla</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nombre de la Plantilla</label>
                    <input type="text" class="form-control" wire:model="templateNameSave">
                </div>
                <div class="mb-3">
                    <label class="form-label">Descripción (opcional)</label>
                    <textarea class="form-control" wire:model="templateDescription" rows="3"></textarea>
                </div>
                @if($templateId)
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" wire:model="overwriteTemplate" id="overwriteTemplate">
                        <label class="form-check-label" for="overwriteTemplate">
                            Sobrescribir plantilla existente
                        </label>
                    </div>
                @endif
                <div class="mb-3">
                    <label class="form-label">Vista Previa</label>
                    <div class="border rounded p-2" style="max-height: 200px; overflow-y: auto;">
                        @if(is_array($blocks))
                            @php
                                $activeBlocks = collect($blocks)->filter(function ($block) {
                                    return $block['active'] ?? false;
                                })->toArray();
                            @endphp

                            @if(empty($activeBlocks))
                                <div class="text-center p-4">No hay bloques activos para mostrar</div>
                            @else
                                @include('emails.template', ['blocks' => $activeBlocks])
                            @endif
                        @else
                            <div class="text-center p-4">Loading preview...</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" wire:click="saveAsNewTemplate">
                    Guardar Plantilla
                </button>
            </div>
        </div>
    </div>
</div>