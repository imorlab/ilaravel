<div class="list-group-item rounded-3 mb-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Configuración Global</h5>
    </div>
    <div class="mb-3">
        <label class="form-label">Color de Fondo Principal</label>
        <div class="input-group">
            <input type="color" class="form-control form-control-color" 
                    wire:model.live="blocks.settings.content.background_color"
                    value="{{ $block['content']['background_color'] ?? '#ffffff' }}"
                    title="Elige el color de fondo principal">
            <input type="text" class="form-control" 
                    wire:model.live="blocks.settings.content.background_color"
                    value="{{ $block['content']['background_color'] ?? '#ffffff' }}"
                    placeholder="#ffffff">
        </div>
    </div>
    <div class="mb-3">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" 
                   wire:model.live="blocks.settings.content.dark_mode"
                   id="darkModeSwitch">
            <label class="form-check-label" for="darkModeSwitch">
                Modo Oscuro
            </label>
        </div>
    </div>
</div>
