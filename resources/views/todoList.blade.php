@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-auto floating text-center my-3">
            <img src="{{ asset('/img/underwater_jelly.svg') }}" class="img-fluid ms-auto me-auto d-block mb-1">
        </div>
        <div class="">
            <div class=" text-center">
                <h2>iTodo</h2>
            </div>
            <div class="">
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                @livewire('todo-list')
            </div>
        </div>
    </div>
</div>

@endsection
