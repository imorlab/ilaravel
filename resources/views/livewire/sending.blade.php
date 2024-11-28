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

                @if($html)
                    <div class="card glass-card mb-4">
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
                            <div wire:loading.remove wire:target="html">
                                {!! $this->previewHtml !!}
                            </div>
                        </div>
                    </div>
                @endif

                <div class="d-flex justify-content-center">
                    <button type="submit" 
                            class="btn btn-primary"
                            wire:loading.attr="disabled"
                            wire:target="send">
                        <span wire:loading.remove wire:target="send">
                            <i class="fas fa-paper-plane me-2"></i>
                            {{ __('Enviar') }}
                        </span>
                        <span wire:loading wire:target="send">
                            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                            {{ __('Enviando...') }}
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </form>

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
