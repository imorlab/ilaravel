document.addEventListener('livewire:initialized', () => {
    // Escuchar eventos de SweetAlert2
    Livewire.on('swal:success', (event) => {
        Swal.fire({
            position: event[0].position || 'top-end',
            icon: 'success',
            title: event[0].title,
            text: event[0].text,
            showConfirmButton: event[0].showConfirmButton ?? false,
            timer: event[0].timer || 3000
        });
    });

    Livewire.on('swal:error', (event) => {
        Swal.fire({
            position: event[0].position || 'top-end',
            icon: 'error',
            title: event[0].title,
            text: event[0].text,
            showConfirmButton: event[0].showConfirmButton ?? false,
            timer: event[0].timer || 3000
        });
    });

    Livewire.on('swal:confirm', (event) => {
        Swal.fire({
            title: event[0].title,
            text: event[0].text,
            icon: event[0].icon || 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: event[0].confirmButtonText || 'Sí',
            cancelButtonText: event[0].cancelButtonText || 'No'
        }).then((result) => {
            if (result.isConfirmed && event[0].next) {
                Livewire.dispatch(event[0].next.event, event[0].next.params);
            }
        });
    });
});
