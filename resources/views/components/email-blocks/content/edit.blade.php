@props(['blockKey', 'content'])

<div class="row g-3">
    <div class="col-md-12">
        <label class="form-label">Título Principal</label>
        <input type="text" class="form-control" wire:model.live="blocks.{{ $blockKey }}.content.title">
    </div>
</div>

<div class="row g-3 mt-1">
    <div class="col-md-4">
        <label class="form-label">Tamaño Título (px)</label>
        <input type="number" class="form-control" 
               wire:model.live="blocks.{{ $blockKey }}.content.title_size"
               value="{{ $content['title_size'] ?? '25' }}"
               min="10" max="50">
    </div>
    <div class="col-md-4">
        <label class="form-label">Altura línea título</label>
        <input type="number" class="form-control" 
               wire:model.live="blocks.{{ $blockKey }}.content.title_line_height"
               value="{{ $content['title_line_height'] ?? '30' }}"
               min="10" max="60">
    </div>
    <div class="col-md-4">
        <label class="form-label">Peso título</label>
        <select class="form-select" wire:model.live="blocks.{{ $blockKey }}.content.title_weight">
            <option value="normal">Normal</option>
            <option value="bold">Bold</option>
            <option value="lighter">Lighter</option>
        </select>
    </div>
</div>

<div class="row g-3 mt-1">
    <div class="col-md-12">
        <label class="form-label">Contenido Principal</label>
        <textarea class="form-control" rows="4" 
                  wire:model.live="blocks.{{ $blockKey }}.content.text"></textarea>
    </div>
</div>

<div class="row g-3 mt-1">
    <div class="col-md-12">
        <label class="form-label">Subtítulo</label>
        <input type="text" class="form-control" 
               wire:model.live="blocks.{{ $blockKey }}.content.subtitle">
    </div>
</div>

<div class="row g-3 mt-1">
    <div class="col-md-4">
        <label class="form-label">Tamaño Subtítulo (px)</label>
        <input type="number" class="form-control" 
               wire:model.live="blocks.{{ $blockKey }}.content.subtitle_size"
               value="{{ $content['subtitle_size'] ?? '18' }}"
               min="10" max="40">
    </div>
    <div class="col-md-4">
        <label class="form-label">Altura línea subtítulo</label>
        <input type="number" class="form-control" 
               wire:model.live="blocks.{{ $blockKey }}.content.subtitle_line_height"
               value="{{ $content['subtitle_line_height'] ?? '22' }}"
               min="10" max="50">
    </div>
    <div class="col-md-4">
        <label class="form-label">Peso subtítulo</label>
        <select class="form-select" wire:model.live="blocks.{{ $blockKey }}.content.subtitle_weight">
            <option value="normal">Normal</option>
            <option value="bold">Bold</option>
            <option value="lighter">Lighter</option>
        </select>
    </div>
</div>

<div class="row g-3 mt-1">
    <div class="col-md-12">
        <label class="form-label">Lista de elementos</label>
        <textarea class="form-control" rows="3" 
                  placeholder="Un elemento por línea"
                  wire:model.live="blocks.{{ $blockKey }}.content.list_items"></textarea>
    </div>
</div>

<div class="row g-3 mt-1">
    <div class="col-md-12">
        <label class="form-label">Contenido Secundario</label>
        <textarea class="form-control" rows="4" 
                  wire:model.live="blocks.{{ $blockKey }}.content.secondary_text"></textarea>
    </div>
</div>

<div class="row g-3 mt-1">
    <div class="col-md-4">
        <label class="form-label">Padding (px)</label>
        <input type="number" class="form-control" 
               wire:model.live="blocks.{{ $blockKey }}.content.padding"
               value="{{ $content['padding'] ?? '20' }}"
               min="0" max="100">
    </div>
    <div class="col-md-4">
        <label class="form-label">Tamaño texto (px)</label>
        <input type="number" class="form-control" 
               wire:model.live="blocks.{{ $blockKey }}.content.font_size"
               value="{{ $content['font_size'] ?? '15' }}"
               min="10" max="30">
    </div>
    <div class="col-md-4">
        <label class="form-label">Altura línea texto</label>
        <input type="number" class="form-control" 
               wire:model.live="blocks.{{ $blockKey }}.content.line_height"
               value="{{ $content['line_height'] ?? '20' }}"
               min="10" max="40">
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-6">
        <label class="form-label">Color del Texto</label>
        <div class="input-group">
            <input type="color" class="form-control form-control-color" 
                   wire:model.live="blocks.{{ $blockKey }}.content.text_color"
                   value="{{ $content['text_color'] ?? '#555555' }}"
                   title="Elige el color del texto">
            <input type="text" class="form-control" 
                   wire:model.live="blocks.{{ $blockKey }}.content.text_color"
                   value="{{ $content['text_color'] ?? '#555555' }}"
                   placeholder="#555555">
        </div>
    </div>
    <div class="col-md-6">
        <x-email-blocks.color-picker :blockKey="$blockKey" :blockContent="$content" />
    </div>
</div>
