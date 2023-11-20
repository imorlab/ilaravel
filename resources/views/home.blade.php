@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-auto">
            <div class="col-auto text-center mb-5">
                <img src="{{ asset('/img/laravel_96.png') }}" class="img-fluid ms-auto me-auto d-block mb-1">
            </div>

            {{-- <img src="{{ asset('/img/laravel.jpg') }}" class="img-fluid ms-auto me-auto d-block mb-1" /> --}}
            <div class="row">

                <div class="col-6">
                    <a href="{{ '/sending' }}" class="text-decoration-none">
                        <div class="card text-white bg-dark bg-gradient mb-3">

                            <div class="card-body">
                                <img src="{{ asset('/icons/mail_96.png') }}" style="width: 96px;">
                                <h4 class="card-title mt-2">Sending mail</h4>
                                <p class="card-text">Do you want to send a newsletter?<i class="bi bi-arrow-right"></i></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6">
                    <a href="{{ '/sending' }}" class="text-decoration-none">
                        <div class="card text-white bg-dark bg-gradient mb-3">

                            <div class="card-body">
                                <img src="{{ asset('/icons/rubik_96.png') }}" style="width: 96px;">
                                <h4 class="card-title mt-2">Cubo Rubik</h4>
                                <p class="card-text">Do you want to send a newsletter?<i class="bi bi-arrow-right"></i></p>
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
                                <img src="{{ asset('/icons/new_96.png') }}" style="width: 96px;">
                                <h4 class="card-title mt-2">New tool</h4>
                                <p class="card-text">Do you want to send a newsletter?<i class="bi bi-arrow-right"></i></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6">
                    <a href="{{ '/sending' }}" class="text-decoration-none">
                        <div class="card text-white bg-dark bg-gradient mb-3">

                            <div class="card-body">
                                <img src="{{ asset('/icons/toolbox_96.png') }}" style="width: 96px;">
                                <h4 class="card-title mt-2">Tool Box</h4>
                                <p class="card-text">Do you want to send a newsletter?<i class="bi bi-arrow-right"></i></p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
