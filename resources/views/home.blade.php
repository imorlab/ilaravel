@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-auto">
            <div class="col-auto text-center mb-5">
                <img src="{{ asset('/img/logo.png') }}" class="img-fluid ms-auto me-auto d-block mb-1">
            </div>

            {{-- <img src="{{ asset('/img/laravel.jpg') }}" class="img-fluid ms-auto me-auto d-block mb-1" /> --}}
            <div class="row">

                <div class="col-6">
                    <a href="{{ '/sending' }}" class="text-decoration-none">
                        <div class="card text-white bg-dark bg-gradient mb-3">

                            <div class="card-body">
                                <img src="{{ asset('/img/mail.png') }}" class="card-img-top w-25 mb-3 text-center" alt="...">
                                <h2 class="card-title">Sending mail</h2>
                                <p class="card-text">Do you want to send a newsletter?<i class="bi bi-arrow-right"></i></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6">
                    <a href="{{ '/sending' }}" class="text-decoration-none">
                        <div class="card text-white bg-dark bg-gradient mb-3">

                            <div class="card-body">
                                <img src="{{ asset('/img/mail.png') }}" class="card-img-top w-25 mb-3" alt="...">
                                <i class="bi bi-arrow-right"></i>
                                <h5 class="card-title">Sending mail</h5>
                                <p class="card-text">Do you want to send a newsletter?</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <a href="{{ '/sending' }}" class="text-decoration-none">
                        <div class="card text-white bg-dark bg-gradient mb-3">

                            <div class="card-body">
                                <i class="bi bi-arrow-right"></i>
                                <h5 class="card-title">Sending mail</h5>
                                <p class="card-text">Do you want to send a newsletter?</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6">
                    <a href="{{ '/sending' }}" class="text-decoration-none">
                        <div class="card text-white bg-dark bg-gradient mb-3">

                            <div class="card-body">
                                <i class="bi bi-arrow-right"></i>
                                <h5 class="card-title">Sending mail</h5>
                                <p class="card-text">Do you want to send a newsletter?</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
