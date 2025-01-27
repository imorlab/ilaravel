import './bootstrap';

// Importar Alpine.js
import Alpine from 'alpinejs';

// Importar otros plugins
import 'livewire-sortable';

// Inicializar Alpine solo si no está ya inicializado
if (!window.Alpine) {
    window.Alpine = Alpine;
    Alpine.start();
}
