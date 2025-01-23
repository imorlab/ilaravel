@extends('layouts.app')

@push('styles')
    @livewireStyles
@endpush

@section('content')
<div class="container">
    <livewire:pro360-newsletter />
</div>
@endsection

@push('scripts')
    @livewireScripts
@endpush
