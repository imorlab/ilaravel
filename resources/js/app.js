import './bootstrap';
import Alpine from 'alpinejs';
import 'livewire-sortable';

// Asegurarse de que Livewire esté disponible antes de iniciar Alpine
document.addEventListener('livewire:navigated', () => {
    if (!window.Alpine) {
        window.Alpine = Alpine;
        Alpine.start();
    }
});

document.addEventListener('livewire:init', () => {
    if (!window.Alpine) {
        window.Alpine = Alpine;
        Alpine.start();
    }
});
