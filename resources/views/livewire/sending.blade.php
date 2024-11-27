<div class="mt-4">
    <p class="text-center text-light mb-4">{{ __('Asegúrate de pegar el HTML de la newsletter que quieres enviar') }}</p>

    <form wire:submit.prevent="send" novalidate>
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="form-group mb-4">
                    <div class="input-group">
                        <span class="input-group-text glass-input-icon">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" 
                               class="form-control glass-input @error('email') is-invalid @enderror" 
                               wire:model="email"
                               placeholder="{{ __('Email') }}"
                               list="mailOptions"
                               required>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <datalist id="mailOptions">
                        @foreach(['iml@beonww.com', 'i13morenolabrador@gmail.com', 'rg@beonww.com',
                                'cci@beonww.com', 'gg@beonww.com', 'jo@beonww.com'] as $email)
                            <option value="{{ $email }}">
                        @endforeach
                    </datalist>
                </div>

                <div class="form-group mb-4">
                    <div class="input-group">
                        <span class="input-group-text glass-input-icon">
                            <i class="fas fa-code"></i>
                        </span>
                        <textarea class="form-control glass-input @error('html') is-invalid @enderror" 
                                  wire:model.live="html"
                                  placeholder="{{ __('Pega aquí tu HTML') }}"
                                  rows="8"
                                  required></textarea>
                        @error('html')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="card glass-card mb-4" x-show="$wire.html">
                    <div class="card-header glass-header d-flex align-items-center">
                        <i class="fas fa-eye me-2"></i>
                        <h5 class="mb-0">Vista Previa</h5>
                    </div>
                    <div class="card-body preview-container preview-compact">
                        <div wire:loading wire:target="html" class="text-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Cargando...</span>
                            </div>
                        </div>
                        <div class="preview-content" wire:loading.remove wire:target="html">
                            {{ $this->previewHtml }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="glass-header rounded-top fixed-bottom p-3">
            <div class="d-flex justify-content-end">
                <button type="submit" 
                        class="ibtn"
                        wire:loading.attr="disabled"
                        wire:target="send">
                    <div class="button-content">
                        <i class="fas fa-paper-plane me-2"></i>
                        {{ __('Enviar') }}
                    </div>
                    <div class="button-loader">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </form>
</div>
