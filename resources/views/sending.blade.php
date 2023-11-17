@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-6 mb-5">
            <img src="{{ asset('/img/sending.jpg') }}" class="img-fluid ms-auto me-auto d-block mb-1" />

            <h4 class="text-center primary fw-bold mb-4">{{__('¿Quieres enviar una newsletter?')}}</h4>
            <p class="text-center primary mb-4">{{__('Asegurate de tener selecionada la newsletter que quieres enviar')}}</p>

            <form id="form" action="{{ url('/send') }}" method="POST">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-6 mb-3">
                        <div class="input-group mb-3">
                            <input id="email" type="email" placeholder="{{ __('front.email') }}"
                            class="custom-border form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email">

                            <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
                        </div>
                    </div>
                </div>
            </form>

            <h5 class="text-center mt-2 hashtag" style="color: #9240d5">#ImlBeonww2023</h5>

        </div>
    </div>
</div>

@endsection


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('form').addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    icon: 'success',
                    iconColor: '#9240d5',
                    color:  '#2c0066',
                    title: 'Newsletter enviada',
                    showConfirmButton: false,
                    timer: 1500
                })
                this.submit();
            });
        });

    </script>


@push('scripts')

@endpush
