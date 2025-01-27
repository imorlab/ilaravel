@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Laravel 10 Livewire CRUD Operation Example</h2>
                </div>
                <div class="card-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    @livewire('posts')
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
    </div>
</div>

@endsection
