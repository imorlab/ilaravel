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

                    <form wire:submit.prevent="updatedExcelFile" novalidate>
                        <div class="form-group mb-4">
                            <div class="input-group">
                                <span class="input-group-text glass-input-icon">
                                    <img src="{{ asset('icons/excel-icon.webp') }}" alt="Excel Icon" style="width: 18px; height: 18px;">
                                </span>
                                <input type="file" 
                                    wire:model="excelFile" 
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
                                    <div wire:loading wire:target="updatedExcelFile" class="text-center">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">{{ __('Cargando...') }}</span>
                                        </div>
                                    </div>
                                    <div wire:loading.remove wire:target="updatedExcelFile">
                                        <iframe srcdoc="{{ $generatedHtml }}" 
                                                class="w-100"
                                                style="height: 600px; border: none; background: white;"
                                                frameborder="0"></iframe>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="d-flex justify-content-center gap-3">
                            <button type="submit"
                                    class="ibtn"
                                    wire:loading.attr="disabled"
                                    wire:target="updatedExcelFile">
                                <span wire:loading.remove wire:target="updatedExcelFile">
                                    <i class="fas fa-wand-magic-sparkles me-2"></i>
                                    {{ __('Generar Newsletter') }}
                                </span>
                                <span wire:loading wire:target="updatedExcelFile">
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
