# Componente TodoList

## 📋 Descripción General
El componente TodoList es una implementación avanzada de una lista de tareas con capacidades de gestión de tiempo y estado. Utiliza Laravel Livewire para la interactividad en tiempo real y JavaScript para el manejo preciso de temporizadores.

## 🚀 Características Principales

### 1. Gestión de Tareas
- Organización en columnas por estado (Por hacer, En progreso, Completado, Papelera)
- Arrastrar y soltar para cambiar el estado de las tareas
- Interfaz intuitiva con diseño de tarjetas de cristal

### 2. Sistema de Temporizadores
- Múltiples temporizadores activos simultáneamente
- Sincronización automática con el servidor cada 30 segundos
- Persistencia de tiempo entre recargas de página
- Manejo preciso del tiempo transcurrido

### 3. Interfaz de Usuario
- Diseño responsive con Bootstrap
- Efectos visuales de cristal (glassmorphism)
- Iconos intuitivos para cada acción
- Feedback visual para todas las interacciones

## 🛠️ Tecnologías Utilizadas

### Frontend
- HTML5/CSS3
- JavaScript (ES6+)
- Bootstrap 5
- Alpine.js
- Bootstrap Icons

### Backend
- Laravel 10.x
- Livewire
- MySQL/MariaDB

## 📦 Estructura del Componente

### Archivos Principales
```
resources/
├── views/
│   ├── livewire/
│   │   └── todo-list.blade.php    # Vista principal del componente
│   └── layouts/
│       └── app.blade.php          # Layout principal
├── sass/
│   └── app.scss                   # Estilos personalizados
└── js/
    └── app.js                     # JavaScript principal
```

### Clases PHP
```php
app/
└── Livewire/
    └── TodoList.php              # Lógica del componente
```

## 💻 API JavaScript

### Objetos Globales

#### window.todoApp
Objeto principal que mantiene el estado de la aplicación:
```javascript
window.todoApp = {
    activeTimers: new Set(),      // Timers actualmente en ejecución
    buttonStates: new Map(),      // Estado de los botones por tarea
    runningTasks: new Set(),      // Tareas en ejecución
    timerIntervals: new Map(),    // Intervalos de los temporizadores
    isInitialized: false          // Estado de inicialización
}
```

### Funciones Principales

#### startTimer(id, startTime)
Inicia un temporizador para una tarea específica.
```javascript
/**
 * @param {string} id - ID de la tarea
 * @param {string} startTime - Tiempo de inicio en formato ISO
 */
```

#### stopTimer(id)
Detiene un temporizador activo.
```javascript
/**
 * @param {string} id - ID de la tarea
 */
```

#### syncTimerWithServer(id, timeSpent)
Sincroniza el tiempo transcurrido con el servidor.
```javascript
/**
 * @param {string} id - ID de la tarea
 * @param {number} timeSpent - Tiempo transcurrido en segundos
 */
```

## 🔄 Eventos Livewire

### Emitidos por el Componente
- `taskUpdated`: Cuando se actualiza el estado de una tarea
- `timerStarted`: Al iniciar un temporizador
- `timerStopped`: Al detener un temporizador

### Escuchados por el Componente
- `message.processed`: Para manejar actualizaciones de Livewire
- `taskStatusUpdated`: Para actualizar el estado de arrastrar y soltar

## 🎨 Estilos CSS

### Clases Principales
- `.glass-card`: Efecto de cristal para las tarjetas
- `.todo-doing`: Estilo para tareas en progreso
- `.todo-done`: Estilo para tareas completadas
- `.timer-buttons`: Contenedor de botones del temporizador

## 🔒 Seguridad

### Validaciones
- Verificación de permisos de usuario
- Sanitización de entrada de datos
- Protección contra XSS
- Validación de estados de tareas

### Sincronización
- Verificación de integridad de datos
- Manejo de conflictos de tiempo
- Protección contra manipulación de temporizadores

## 🚀 Uso

### Inicialización
```php
<livewire:todo-list />
```

### Ejemplo de Uso
```html
<!-- En una vista Blade -->
<div>
    <livewire:todo-list />
</div>
```

## ⚙️ Configuración

### Valores por Defecto
```php
protected $defaults = [
    'refresh_interval' => 30000,  // Intervalo de sincronización (ms)
    'max_tasks' => 100,          // Máximo de tareas por usuario
    'states' => ['open', 'doing', 'done', 'trash']
];
```

## 🐛 Manejo de Errores

### Estrategias
1. Logging comprehensivo
2. Recuperación automática de errores
3. Feedback al usuario
4. Sincronización resiliente

## 📈 Rendimiento

### Optimizaciones
- Lazy loading de componentes
- Minimización de llamadas al servidor
- Cacheo de estados
- Manejo eficiente de memoria

## 🔄 Ciclo de Vida

1. Inicialización
2. Carga de estado inicial
3. Activación de listeners
4. Manejo de eventos
5. Sincronización
6. Limpieza

## 🤝 Contribución
Para contribuir al desarrollo de este componente:

1. Fork el repositorio
2. Cree una rama para su característica
3. Realice sus cambios
4. Envíe un pull request

## 📝 Notas de Desarrollo
- Mantener la sincronización de estado como prioridad
- Seguir las convenciones de Laravel
- Documentar cambios significativos
- Mantener la compatibilidad con versiones anteriores
