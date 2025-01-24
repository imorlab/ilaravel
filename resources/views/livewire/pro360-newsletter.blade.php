<div class="mt-3">
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-8">
            <div class="card shadow glass-card">
                <div class="card-header glass-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0 text-light">{{ __('PRO360') }}</h2>
                    <span class="badge glass-badge">
                        <i class="bi bi-envelope-paper me-1"></i>
                        {{ __('Newsletter') }}
                    </span>
                </div>
                <div class="card-body">
                    <p class="text-center text-light my-4">{{ __('Genera tu newsletter PRO360 desde un archivo Excel') }}</p>

                    <form wire:submit.prevent="generateNewsletter" novalidate>
                        <div class="form-group mb-4">
                            <div class="input-group">
                                <span class="input-group-text glass-input-icon">
                                    <img src="{{ asset('icons/excel-icon.webp') }}" alt="Excel Icon" style="width: 18px; height: 18px;">
                                </span>
                                <input type="file" 
                                    wire:model.live="excelFile" 
                                    id="excel"
                                    class="form-control glass-input @error('excelFile') is-invalid @enderror"
                                    accept=".xlsx,.xls">
                                @error('excelFile')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        

                        @if($generatedHtml)
                            <div class="card glass-card mt-4">
                                <div class="card-header glass-header d-flex align-items-center">
                                    <i class="fas fa-eye me-2"></i>
                                    <h5 class="mb-0">{{ __('Vista Previa') }}</h5>
                                </div>
                                <div class="card-body preview-container">
                                    <div wire:loading wire:target="generateNewsletter" class="text-center">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">{{ __('Cargando...') }}</span>
                                        </div>
                                    </div>
                                    <div wire:loading.remove wire:target="generateNewsletter">
                                        {!! $generatedHtml !!}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="d-flex justify-content-center gap-3 pb-3">
                            <button type="submit"
                                    class="ibtn"
                                    wire:loading.attr="disabled"
                                    wire:target="generateNewsletter">
                                <span wire:loading.remove wire:target="generateNewsletter">
                                    <i class="fas fa-wand-magic-sparkles me-2"></i>
                                    {{ __('Generar Newsletter') }}
                                </span>
                                <span wire:loading wire:target="generateNewsletter">
                                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                    {{ __('Procesando...') }}
                                </span>
                            </button>

                            @if($generatedHtml)
                                <button wire:click="downloadNewsletter" 
                                        type="button"
                                        class="ibtn btn-glass">
                                    <i class="fas fa-download me-2"></i>
                                    {{ __('Descargar HTML') }}
                                </button>
                            
                                <div class="form-group mb-4" style="width: 150px;">
                                    <!-- <label for="selectedSheet" class="form-label text-light">Selecciona el idioma</label> -->
                                    <div class="input-group">
                                        <select wire:model="selectedSheet" class="form-select glass-input">
                                            <option value="ESP">ES</option>
                                            <option value="EN">EN</option>
                                            <option value="DE">DE</option>
                                            <option value="PT">PT</option>
                                            <option value="PTBR">PTBR</option>
                                        </select>
                                        <button type="button" 
                                                wire:click="updatePreview" 
                                                class="btn btn-primary"
                                                wire:loading.attr="disabled">
                                            <span wire:loading.remove wire:target="updatePreview">
                                                <i class="fas fa-sync-alt"></i>
                                            </span>
                                            <span wire:loading wire:target="updatePreview">
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Notificaciones -->
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show position-fixed bottom-0 end-0 m-3" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show position-fixed bottom-0 end-0 m-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
