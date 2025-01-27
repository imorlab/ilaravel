@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row min-vh-100 align-items-center justify-content-center">
        <div class="col-lg-11">
            <div class="card shadow glass-card">
                <div class="card-header glass-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0 text-light">{{ __('iTodo') }}</h2>
                    <span class="badge glass-badge">
                        <i class="bi bi-check2-square me-1"></i>
                        {{ __('Task Manager') }}
                    </span>
                </div>
                <div class="card-body py-4">
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
</div>
@endsection
