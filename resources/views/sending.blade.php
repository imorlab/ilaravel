@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-lg-8">
            <div class="card shadow glass-card">
                <div class="card-header glass-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0 text-light">{{ __('iMail') }}</h2>
                    <span class="badge glass-badge">
                        <i class="bi bi-envelope-paper me-1"></i>
                        {{ __('Newsletter') }}
                    </span>
                </div>
                <div class="card-body">
                    @livewire('sending')
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('swal:auth', (event) => {
            Swal.fire({
                icon: 'warning',
                title: event[0].title,
                text: event[0].text,
                background: '#1a1a1a',
                color: '#fff',
                showCancelButton: true,
                confirmButtonText: 'Iniciar sesión',
                cancelButtonText: 'Registrarse',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'btn btn-primary me-2',
                    cancelButton: 'btn btn-outline-light'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route("login") }}';
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    window.location.href = '{{ route("register") }}';
                }
            });
        });

        Livewire.on('swal:success', (event) => {
            Swal.fire({
                icon: 'success',
                title: event[0].title,
                text: event[0].text,
                background: '#1a1a1a',
                color: '#fff',
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500
            });
        });

        Livewire.on('swal:error', (event) => {
            Swal.fire({
                icon: 'error',
                title: event[0].title,
                text: event[0].text,
                background: '#1a1a1a',
                color: '#fff',
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500
            });
        });
    });
</script>
@endpush
@endsection