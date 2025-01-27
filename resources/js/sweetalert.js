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
        let config = {
            title: event[0].title,
            text: event[0].text,
            icon: event[0].icon || 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: event[0].confirmButtonText || 'Sí',
            cancelButtonText: event[0].cancelButtonText || 'No'
        };

        // Si es un input de emails, añadir el campo
        if (event[0].text && event[0].text.includes('emails')) {
            config.input = 'text';
            config.inputPlaceholder = 'ejemplo@email.com, otro@email.com';
            config.inputValidator = (value) => {
                if (!value) {
                    return 'Debes introducir al menos un email';
                }
                const emails = value.split(',').map(e => e.trim());
                const invalidEmails = emails.filter(e => !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(e));
                if (invalidEmails.length > 0) {
                    return 'Los siguientes emails no son válidos: ' + invalidEmails.join(', ');
                }
                return null; // La validación es exitosa
            }
        }

        Swal.fire(config).then((result) => {
            if (result.isConfirmed && event[0].next) {
                if (event[0].next.event === 'redirect') {
                    window.location.href = event[0].next.params.url;
                } else {
                    // Obtener el elemento que disparó el evento
                    const el = document.querySelector('[wire\\:id]');
                    if (el) {
                        // Obtener el componente Livewire
                        const component = Livewire.find(el.getAttribute('wire:id'));
                        if (component) {
                            // Establecer los emails y llamar al método
                            component.set('emailsToSend', result.value);
                            component.call(event[0].next.event);
                        }
                    }
                }
            }
        });
    });
});
