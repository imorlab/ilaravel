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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="col-auto text-center mb-5">
                <img src="{{ asset('/img/laravel_96.png') }}" class="img-fluid ms-auto me-auto d-block mb-1">
            </div>
            {{-- <img src="{{ asset('/img/laravel.jpg') }}" class="img-fluid ms-auto me-auto d-block mb-1" /> --}}
            <div class="row">
                <div class="col-6">
                    <a href="{{ '/sending' }}" class="text-decoration-none">
                        <div class="card p-3 text-white bg-dark bg-gradient mb-3">

                            <div class="card-body">
                                <img src="{{ asset('/icons/mail_96.png') }}" style="width: 84px;">
                                <h4 class="card-title mt-2">Sending mail</h4>
                                <p class="card-text">Do you want to send a newsletter?</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6">
                    <a href="{{ '/rubik' }}" class="text-decoration-none">
                        <div class="card p-3 text-white bg-dark bg-gradient mb-3">

                            <div class="card-body">
                                <img src="{{ asset('/icons/rubik_96.png') }}" style="width: 84px;">
                                <h4 class="card-title mt-2">Cubo Rubik</h4>
                                <p class="card-text">Do you want to send a newsletter?<i class="bi bi-arrow-right"></i></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6">
                    <a href="{{ '/sending' }}" class="text-decoration-none">
                        <div class="card p-3 text-white bg-dark bg-gradient mb-3">

                            <div class="card-body">
                                <img src="{{ asset('/icons/new_96.png') }}" style="width: 84px;">
                                <h4 class="card-title mt-2">New tool</h4>
                                <p class="card-text">Do you want to send a newsletter?<i class="bi bi-arrow-right"></i></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6">
                    <a href="{{ '/sending' }}" class="text-decoration-none">
                        <div class="card p-3 text-white bg-dark bg-gradient mb-3">

                            <div class="card-body">
                                <img src="{{ asset('/icons/toolbox_96.png') }}" style="width: 84px;">
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
