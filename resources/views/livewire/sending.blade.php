<div class="sending-form">
    {{-- Care about people's approval and you will be their prisoner. --}}
    <p class="text-center text-light mb-4">{{ __('Asegúrate de pegar el HTML de la newsletter que quieres enviar') }}</p>

    <form wire:submit.prevent="send" novalidate>
        <div class="row justify-content-center mb-5">
            <div class="col-md-10">
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
                                  wire:model="html"
                                  placeholder="{{ __('Pega aquí tu HTML') }}"
                                  rows="10"
                                  required></textarea>
                        @error('html')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="glass-header rounded-top fixed-bottom p-3">
            <div class="d-flex justify-content-end">
                <button type="submit" 
                        class="btn btn-mail"
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
