@extends('layouts.app')

@section('content')
<div class="container">
    @include('components.arrows')

    <div class="row justify-content-center main">
        <div class="col-lg-6 col-md-6 mb-5">
            <img src="{{ asset('/img/hero_sending.png') }}"
                 width="500"
                 height="auto"
                 loading="lazy"
                 alt="Newsletter hero image"
                 class="img-fluid ms-auto me-auto d-block mb-3" />

            <h4 class="text-center text-light fw-bold mb-4">{{__('¿Quieres enviar una newsletter?')}}</h4>
            <p class="text-center text-light mb-4">{{__('Asegurate de tener selecionada la newsletter que quieres enviar')}}</p>

            <form id="newsletterForm" action="{{ url('/send') }}" method="POST" novalidate>
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-6 mb-3">
                        <div class="form-group mb-3">
                            <label for="email" class="visually-hidden">{{ __('Email') }}</label>
                            <input type="email"
                                   id="email"
                                   placeholder="{{ __('Email') }}"
                                   list="mailOptions"
                                   class="custom-border form-control @error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   autocomplete="email">

                            <datalist id="mailOptions">
                                @foreach(['iml@beonww.com', 'i13morenolabrador@gmail.com', 'rg@beonww.com',
                                        'cci@beonww.com', 'gg@beonww.com', 'jo@beonww.com'] as $email)
                                    <option value="{{ __($email) }}">
                                @endforeach
                            </datalist>

                            <label for="html" class="visually-hidden">{{ __('HTML Content') }}</label>
                            <textarea class="custom-border form-control mt-3"
                                      name="html"
                                      id="html"
                                      rows="3"
                                      placeholder="{{ __('Pega aquí tú html') }}"
                                      required></textarea>

                            <button type="submit" class="btn btn-register mt-3 w-100" id="submitButton">
                                <span class="button-content">
                                    {{ __('Enviar') }}
                                </span>
                                <span class="button-loader d-none">
                                    <span class="spinner-border" role="status" aria-hidden="true"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('newsletterForm');
    const submitButton = document.getElementById('submitButton');
    const buttonContent = submitButton.querySelector('.button-content');
    const buttonLoader = submitButton.querySelector('.button-loader');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Mostrar loader
        buttonContent.classList.add('d-none');
        buttonLoader.classList.remove('d-none');
        submitButton.disabled = true;

            Swal.fire({
                icon: 'success',
                iconColor: '#0c0009',
                color: '#0c0009',
                background: '#d54040',
                title: '{{ __("Newsletter enviada") }}',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                // Enviar el formulario
                form.submit();
            }).catch(error => {
                console.error('Error en SweetAlert:', error);
                // En caso de error, también enviamos el formulario
                form.submit();
            });
    });

    // Verificar que SweetAlert está disponible
    if (typeof Swal === 'undefined') {
        console.error('SweetAlert2 no está cargado correctamente');
    }
});
</script>
@endpush
@endsection
