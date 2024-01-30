@extends('layouts.app')

@section('content')

<div class="container">

        <div class="arrow arrow--top">
            <svg xmlns="http://www.w3.org/2000/svg" width="270.11" height="649.9" overflow="visible">

                <g class="item-to bounce-1">
                    <path class="geo-arrow draw-in" d="M135.06 142.564L267.995 275.5 135.06 408.434 2.125 275.499z" />
                </g>
                <circle class="geo-arrow item-to bounce-2" cx="194.65" cy="69.54" r="7.96" />
                <circle class="geo-arrow draw-in" cx="194.65" cy="39.5" r="7.96" />
                <circle class="geo-arrow item-to bounce-3" cx="194.65" cy="9.46" r="7.96" />
                <g class="geo-arrow item-to bounce-2">
                    <path class="st0 draw-in" d="M181.21 619.5l13.27 27 13.27-27zM194.48 644.5v-552" />
                </g>
            </svg>
        </div>
        <div class="arrow arrow--bottom">
            <svg xmlns="http://www.w3.org/2000/svg" width="31.35" height="649.9" overflow="visible">

                <g class="item-to bounce-1">
                    <circle class="geo-arrow item-to bounce-3" cx="15.5" cy="580.36" r="7.96" />
                    <circle class="geo-arrow draw-in" cx="15.5" cy="610.4" r="7.96" />
                    <circle class="geo-arrow item-to bounce-2" cx="15.5" cy="640.44" r="7.96" />
                    <g class="item-to bounce-2">
                        <path class="geo-arrow draw-in" d="M28.94 30.4l-13.26-27-13.27 27zM15.68 5.4v552" />
                    </g>
                </g>
            </svg>
        </div>

    <div class="row justify-content-center main">
        <div class="col-lg-6 col-md-6 mb-5">
            <img src="{{ asset('/img/hero_sending.png') }}" style="width: 500px;" class="img-fluid ms-auto me-auto d-block mb-3" />

            <h4 class="text-center text-light fw-bold mb-4">{{__('¿Quieres enviar una newsletter?')}}</h4>
            <p class="text-center text-light mb-4">{{__('Asegurate de tener selecionada la newsletter que quieres enviar')}}</p>

            <form id="form" action="{{ url('/send') }}" method="POST">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-6 mb-3">
                        <div class="form-group mb-3">
                            <input type="email" id="email" placeholder="{{ __('Email') }}" list="mailOptions"
                            class="custom-border form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email">
                            <datalist id="mailOptions">
                                <option value="{{ __('iml@beonww.com') }}">
                                <option value="{{ __('i13morenolabrador@gmail.com') }}">
                                <option value="{{ __('rg@beonww.com') }}">
                                <option value="{{ __('cci@beonww.com') }}">
                                <option value="{{ __('gg@beonww.com') }}">
                                <option value="{{ __('jo@beonww.com') }}">
                            </datalist>
                            <div class="mt-3">
                                <textarea class="custom-border form-control" name="html" id="html" rows="3" placeholder="{{ __('Pega aquí tú html') }}"></textarea>
                            </div>
                            <button type="submit" class="btn btn-register mt-3">{{ __('Enviar') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <h5 class="text-center mt-2 hashtag" style="color: #d54040">#ImlBeonww2023</h5>

        {{-- <button type="button" class="btn btn-outline-warning btn-circle text-center m-1"><i class="bi bi-arrow-left"></i></button> --}}
        <a href="{{ '/' }}" type="button" class="btn btn-outline-warning btn-circle"><i class="bi bi-house-fill"></i></a>
        {{-- <button type="button" class="btn btn-outline-warning btn-circle text-center m-1"><i class="bi bi-arrow-right"></i></button> --}}

    </div>
</div>

@push('scripts')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('form').addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    icon: 'success',
                    iconColor: '#0c0009',
                    color:  '#0c0009',
                    background: '#d54040',
                    title: 'Newsletter enviada',
                    showConfirmButton: false,
                    timer: 1500
                })
                this.submit();
            });
        });

    </script>

@endpush

@endsection
