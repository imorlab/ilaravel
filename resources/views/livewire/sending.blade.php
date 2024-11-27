<div class="sending-form">
    {{-- Care about people's approval and you will be their prisoner. --}}
    <p class="text-center text-light mb-4">{{ __('Asegúrate de pegar el HTML de la newsletter que quieres enviar') }}</p>

    <form wire:submit="send" novalidate>
        <div class="row justify-content-center mb-5">
            <div class="col-md-10">
                <div class="form-group mb-4">
                    <div class="input-group">
                        <span class="input-group-text glass-input-icon">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input type="email"
                               placeholder="{{ __('Email') }}"
                               list="mailOptions"
                               class="form-control glass-input @error('email') is-invalid @enderror"
                               wire:model="email"
                               required
                               autocomplete="email">
                    </div>

                    <datalist id="mailOptions">
                        @foreach(['iml@beonww.com', 'i13morenolabrador@gmail.com', 'rg@beonww.com',
                                'cci@beonww.com', 'gg@beonww.com', 'jo@beonww.com'] as $email)
                            <option value="{{ __($email) }}">
                        @endforeach
                    </datalist>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <div class="input-group">
                        <span class="input-group-text glass-input-icon">
                            <i class="bi bi-code-square"></i>
                        </span>
                        <textarea class="form-control glass-input @error('html') is-invalid @enderror"
                                  wire:model="html"
                                  rows="8"
                                  placeholder="{{ __('Pega aquí tu HTML') }}"
                                  required></textarea>
                    </div>

                    @error('html')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="glass-header rounded-top fixed-bottom p-3">
            <div class="d-flex justify-content-end">
                <button type="submit" 
                        class="btn btn-mail"
                        wire:loading.attr="disabled"
                        wire:target="send">
                    <span class="button-content" wire:loading.remove wire:target="send">
                        <i class="bi bi-send me-2"></i>
                        {{ __('Enviar') }}
                    </span>
                    <span class="button-loader" wire:loading wire:target="send">
                        <span class="spinner-border" role="status" aria-hidden="true"></span>
                    </span>
                </button>
            </div>
        </div>
    </form>
</div>
