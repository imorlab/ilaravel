@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-auto floating text-center my-3">
            <img src="{{ asset('/img/underwater_jelly.svg') }}" class="img-fluid ms-auto me-auto d-block mb-1">
        </div>
        <div class="">
            <div class=" text-center">
                <h2>To & Do List</h2>
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
    <div class="row mt-5">
        <div class="col text-center mt-5">
            <h5 class="text-center mt-5" style="color: #d54040">#ImlBeonww2024</h5>

            {{-- <button type="button" class="btn btn-outline-warning btn-circle text-center m-1"><i class="bi bi-arrow-left"></i></button> --}}
            <a href="{{ '/' }}" type="button" class="btn btn-outline-warning btn-circle p-0"><i class="bi bi-house-fill p-0"></i></a>
            {{-- <button type="button" class="btn btn-outline-warning btn-circle text-center m-1"><i class="bi bi-arrow-right"></i></button> --}}
        </div>
    </div>


</div>

@endsection
