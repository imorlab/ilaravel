@extends('layouts.app')

@section('content')

<div class="position-relative">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="col-auto animate animate__animated animate__fadeIn text-center mb-5">
                    <img src="{{ asset('/img/underwater_jelly.svg') }}" class="img-fluid ms-auto me-auto d-block mb-1">
                </div>
            </div>
        </div>
        @livewire('counter')
    </div>
</div>



@endsection
