@extends('layouts.app')

@section('content')
<div class="mt-4">
    @livewire('notes')
</div>
@endsection

@push('styles')
<style>
.glass-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.glass-header {
    background: rgba(255, 255, 255, 0.1);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.glass-body {
    background: transparent;
}

/* Estilos para inputs y selects */
.glass-input {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: white;
    backdrop-filter: blur(5px);
    padding: 0.375rem 2.25rem 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    border-radius: 0.375rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 16px 12px;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}

.glass-input:focus {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.2);
    color: white;
    box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.1);
    outline: none;
}

.glass-input::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

.glass-input option {
    background-color: #1f1b1b;
    color: white;
    padding: 8px;
}

/* Para quitar la flecha en inputs de tipo number */
.glass-input::-webkit-outer-spin-button,
.glass-input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Para Firefox */
.glass-input[type=number] {
    -moz-appearance: textfield;
}

.glass-list .glass-item {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: white;
    transition: all 0.3s ease;
}

.glass-list .glass-item:hover,
.glass-list .glass-item.active {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.2);
}

.glass-note {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.glass-note:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

.favorite-btn {
    color: white;
    text-decoration: none;
}

.favorite-btn:hover {
    color: #ffc107;
}

.ibtn-outline {
    background: none;
    border: 1px solid white;
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.ibtn-outline:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.2);
    color: white;
}

.ibtn-outline .button-content {
    display: flex;
    align-items: center;
    justify-content: center;
}

.ibtn-outline .button-content i {
    margin-right: 10px;
}

.glass-modal {
    background: rgba(255, 255, 255, 0.02) !important;
    backdrop-filter: blur(10px) !important;
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
    color: white !important;
}

.glass-modal .modal-content {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.glass-modal .modal-header,
.glass-modal .modal-footer {
    border-color: rgba(255, 255, 255, 0.1);
}

.glass-modal .modal-title {
    color: #fff;
}

.glass-modal .btn-close {
    filter: invert(1) grayscale(100%) brightness(200%);
}
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('show-modal', ({ id }) => {
            const modal = new bootstrap.Modal(document.getElementById(id));
            modal.show();
        });

        Livewire.on('hide-modal', ({ id }) => {
            const modal = bootstrap.Modal.getInstance(document.getElementById(id));
            if (modal) {
                modal.hide();
            }
        });
    });
</script>
@endpush
