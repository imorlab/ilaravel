@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-6 mb-5">
            <img src="{{ asset('/img/hero_sending.png') }}" style="width: 500px;" class="img-fluid ms-auto me-auto d-block mb-3" />

            <h4 class="text-center text-light fw-bold mb-4">{{__('¿Quieres enviar una newsletter?')}}</h4>
            <p class="text-center text-light mb-4">{{__('Asegurate de tener selecionada la newsletter que quieres enviar')}}</p>

            <form id="form" action="{{ url('/send') }}" method="POST">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-6 mb-3">
                        <div class="form-group mb-3">
                            <input type="email" id="email" placeholder="{{ __('Email') }}" list="datalistOptions"
                            class="custom-border form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email">
                            <datalist id="datalistOptions">
                                <option value="iml@beonww.com">
                                <option value="i13morenolabrador@gmail.com">
                                <option value="rg@beonww.com">
                                <option value="cci@beonww.com">
                                <option value="gg@beonww.com">
                            </datalist>
                            <div class="mt-3">
                                <textarea class="custom-border form-control" id="textarea" rows="3" placeholder="{{ __('Pega aquí tú html') }}"></textarea>
                            </div>
                            <button type="submit" class="btn btn-register mt-3">{{ __('Enviar') }}</button>
                        </div>
                    </div>
                </div>
            </form>

            <h5 class="text-center mt-2 hashtag" style="color: #d54040">#ImlBeonww2023</h5>

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
