@props(['block' => null])

<div class="list-group-item rounded-3 mb-3" wire:key="settings-block">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Configuración Global</h5>
    </div>

    <div class="mb-3" wire:key="settings-title">
        <label class="form-label">Título del Email</label>
        <input type="text" class="form-control"
               wire:model.live="blocks.settings.content.title"
               placeholder="Newsletter Template">
    </div>

    <div class="mb-3" wire:key="settings-preheader">
        <label class="form-label">Pre-header</label>
        <input type="text" class="form-control"
               wire:model.live="blocks.settings.content.preheader"
               placeholder="Newsletter preview text">
        <div class="form-text">
            Este texto aparecerá como vista previa en algunos clientes de correo.
        </div>
    </div>

    <div class="mb-3" wire:key="settings-background">
        <label class="form-label">Color de Fondo Principal</label>
        <div class="input-group">
            <input type="color" class="form-control form-control-color" 
                    wire:model.live="blocks.settings.content.background_color"
                    title="Elige el color de fondo principal">
            <input type="text" class="form-control" 
                    wire:model.live="blocks.settings.content.background_color"
                    placeholder="#ebebeb">
        </div>
    </div>

    <div class="mb-3" wire:key="settings-darkmode">
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
