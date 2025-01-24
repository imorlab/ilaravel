@extends('layouts.app')

@push('styles')
    @livewireStyles
@endpush

@section('content')
<div class="container mt-5 pt-5">
    <livewire:pro360-newsletter />
</div>
@endsection

@push('scripts')
    @livewireScripts
@endpush
