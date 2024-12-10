<div>
    <div class="container-fluid p-0">
        <div class="row g-4">
            <div class="col-12 mb-3">
                <form wire:submit.prevent="store">
                    <div class="input-group">
                        <input type="text" class="form-control glass-input" placeholder="Nueva tarea..." wire:model.defer="task" wire:keydown.enter="store">
                        <button type="submit" class="btn btn-danger glass-danger">
                            <i class="bi bi-plus-lg me-1"></i>Añadir
                        </button>
                    </div>
                    @error('task')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </form>
            </div>
        </div>

        <!-- Columnas de tareas -->
        <div class="row g-4">
            @foreach(['open' => '📝 Por hacer', 'doing' => '⚡ En progreso', 'done' => '✅ Completado', 'trash' => '🗑️ Papelera'] as $status => $title)
            <div class="col-md-3 mb-4">
                <div class="card glass-card mb-0">
                    <div class="shine"></div>
                    <div class="card-header glass-header text-center text-light fs-5 m-0">
                        {{ $title }}
                    </div>
                    <div class="card-body">
                        <div class="list-group-container" id="{{ $status }}" data-status="{{ $status }}">
                            <ul class="list-group list-group-flush glass-list">
                                @foreach($todos->where('status', $status) as $todo)
                                <li class="list-group-item todo-{{ $todo->status }} rounded mb-2"
                                    draggable="true" id="task-{{ $todo->id }}" data-id="{{ $todo->id }}">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-grip-vertical fs-5 text-light me-2" style="cursor: move;"></i>
                                        <span class="text-light">{{ $todo->task }}</span>
                                    </div>
                                    @if($todo->status === 'doing' || $todo->status === 'done')
                                    <div class="timer-controls" id="timer-controls-{{ $todo->id }}">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="timer-container" id="timer-container-{{ $todo->id }}">
                                                @if($todo->status === 'doing')
                                                <button type="button" class="glass-button-timer" id="start-timer-{{ $todo->id }}"
                                                        onclick="handleTimerClick(event, {{ $todo->id }}, 'start')"
                                                        style="display: inline-block;">
                                                    <i class="bi bi-play-circle-fill"></i>
                                                </button>
                                                @endif
                                                <span class="fs-4 timer-text"
                                                      id="timer-{{ $todo->id }}"
                                                      data-todo-id="{{ $todo->id }}"
                                                      data-time-spent="{{ $todo->time_spent }}"
                                                      data-is-running="{{ $todo->is_paused ? '0' : '1' }}"
                                                      data-status="{{ $todo->status }}"
                                                      data-last-started="{{ $todo->last_started_at }}">
                                                    {{ $this->formattedTimeSpent($todo->time_spent) }}
                                                </span>
                                                @if($todo->status === 'doing')
                                                <button type="button" class="glass-button-timer" id="stop-timer-{{ $todo->id }}"
                                                        onclick="handleTimerClick(event, {{ $todo->id }}, 'stop')"
                                                        style="display: inline-block;">
                                                    <i class="bi bi-stop-circle-fill"></i>
                                                </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    {{-- @if($todo->status === 'doing')
                                    <div class="timer-buttons d-flex justify-content-between align-items-center mt-2">
                                        <button type="button" class="glass-button-timer" id="start-timer-{{ $todo->id }}"
                                                onclick="handleTimerClick(event, {{ $todo->id }}, 'start')"
                                                style="display: inline-block;">
                                            <i class="bi bi-play-circle-fill"></i>
                                        </button>
                                        <button type="button" class="glass-button-timer" id="stop-timer-{{ $todo->id }}"
                                                onclick="handleTimerClick(event, {{ $todo->id }}, 'stop')"
                                                style="display: inline-block;">
                                            <i class="bi bi-stop-circle-fill"></i>
                                        </button>
                                    </div>
                                    @endif --}}
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @if ($status == 'trash' && $todos->where('status', $status)->count() > 0)
                        <div class="card-footer glass-footer text-center">
                            <button class="btn btn-sm glass-danger" wire:click="delete">
                                <i class="bi bi-trash me-1"></i>Eliminar todo
                            </button>
                        </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <script>
        // Inicialización global de TodoApp
        window.todoApp = {
            activeTimers: new Set(),
            buttonStates: new Map(),
            runningTasks: new Set(),
            timerIntervals: new Map(),
            isInitialized: false,

            // Método seguro para obtener elementos
            getTimerElements(id) {
                const timer = document.getElementById(`timer-${id}`);
                const startBtn = document.getElementById(`start-timer-${id}`);
                const stopBtn = document.getElementById(`stop-timer-${id}`);
                return { timer, startBtn, stopBtn };
            }
        };

        // Estado global de los timers
        if (!window.todoApp.timers) {
            window.todoApp.timers = {};
        }

        // Función para sincronizar el estado visual de los botones
        function syncButtonStates() {
            document.querySelectorAll('.timer-text').forEach(timer => {
                if (!timer?.dataset) return;

                const id = timer.dataset.todoId;
                if (!id) return;

                const isRunning = timer.dataset.isRunning === "1";
                const status = timer.dataset.status;

                updateButtonVisibility(id, status, isRunning);
            });
        }

        // Inicializar temporizadores
        function initializeTimers() {
            if (window.todoApp.isInitializing) {
                console.log('Ya hay una inicialización en proceso...');
                return;
            }

            window.todoApp.isInitializing = true;
            console.log('Inicializando temporizadores...');

            try {
                document.querySelectorAll('.timer-text').forEach(timer => {
                    if (!timer?.dataset) return;

                    const id = timer.dataset.todoId;
                    if (!id) return;

                    const timeSpent = parseInt(timer.dataset.timeSpent) || 0;
                    const isRunning = timer.dataset.isRunning === "1";
                    const status = timer.dataset.status;
                    const lastStarted = timer.dataset.lastStarted;

                    // Solo procesar tareas en estado 'doing'
                    if (status === 'doing') {
                        console.log(`Inicializando tarea ${id}: running=${isRunning}, status=${status}`);

                        // Verificar si los elementos existen
                        const elements = window.todoApp.getTimerElements(id);
                        if (!elements.timer) {
                            console.warn(`No se encontró el elemento timer para la tarea ${id}`);
                            return;
                        }

                        updateTimerDisplay(id, timeSpent);
                        updateButtonVisibility(id, status, isRunning);

                        // Manejar timer activo
                        if (isRunning && lastStarted) {
                            if (!window.todoApp.activeTimers.has(id)) {
                                console.log(`Iniciando timer para tarea ${id}`);
                                startTimer(id, lastStarted);
                            } else {
                                console.log(`Timer ya activo para tarea ${id}`);
                            }
                        } else if (!isRunning && window.todoApp.activeTimers.has(id)) {
                            console.log(`Deteniendo timer inactivo para tarea ${id}`);
                            stopTimer(id);
                        }
                    }
                });
            } catch (error) {
                console.error('Error durante la inicialización:', error);
            } finally {
                window.todoApp.isInitializing = false;
                window.todoApp.isInitialized = true;
            }
        }

        // Actualizar visibilidad de botones
        async function updateButtonVisibility(id, status, isRunning) {
            if (status !== 'doing') return;

            const elements = window.todoApp.getTimerElements(id);
            if (!elements.startBtn || !elements.stopBtn) {
                console.warn(`No se encontraron los botones para la tarea ${id}`);
                return;
            }

            try {
                window.todoApp.buttonStates.set(id, { status, isRunning });

                if (isRunning) {
                    window.todoApp.runningTasks.add(id);
                    elements.startBtn.style.display = 'inline-block';
                    elements.stopBtn.style.display = 'inline-block';
                    console.log(`Estado actualizado: Tarea ${id} - running`);
                } else {
                    window.todoApp.runningTasks.delete(id);
                    elements.startBtn.style.display = 'inline-block';
                    elements.stopBtn.style.display = 'inline-block';
                    console.log(`Estado actualizado: Tarea ${id} - stopped`);
                }
            } catch (error) {
                console.error(`Error al actualizar visibilidad de botones para tarea ${id}:`, error);
            }
        }

        // Función para sincronizar con el servidor
        async function syncTimerWithServer(id, timeSpent) {
            const elements = window.todoApp.getTimerElements(id);
            if (!elements.timer) return;

            try {
                const component = await getLivewireComponent();
                if (!component) return;

                const result = await component.call('updateTimeSpent', id, timeSpent);
                if (result === false) {
                    console.warn(`No se pudo sincronizar el tiempo para la tarea ${id}`);
                }
            } catch (error) {
                console.error(`Error al sincronizar tiempo para tarea ${id}:`, error);
            }
        }

        // Función para iniciar un timer
        function startTimer(id, startTime) {
            if (window.todoApp.timerIntervals.has(id)) {
                console.log(`Timer ${id} ya está activo, reiniciando...`);
                clearInterval(window.todoApp.timerIntervals.get(id));
            }

            const elements = window.todoApp.getTimerElements(id);
            if (!elements.timer) {
                console.error(`No se encontró el elemento timer-${id}`);
                return;
            }

            const timeSpent = parseInt(elements.timer.dataset.timeSpent) || 0;
            const startDate = new Date(startTime);
            let lastSyncTime = Date.now();

            const interval = setInterval(() => {
                const now = new Date();
                const elapsedSeconds = Math.floor((now - startDate) / 1000);
                const totalSeconds = timeSpent + elapsedSeconds;

                // Actualizar display
                updateTimerDisplay(id, totalSeconds);
                elements.timer.dataset.timeSpent = totalSeconds.toString();

                // Sincronizar con el servidor cada 30 segundos
                if (now - lastSyncTime >= 30000) {
                    syncTimerWithServer(id, totalSeconds);
                    lastSyncTime = now;
                }
            }, 1000);

            window.todoApp.timerIntervals.set(id, interval);
            window.todoApp.activeTimers.add(id);
            console.log(`Timer iniciado para tarea ${id}`);
        }

        // Función para detener un timer
        function stopTimer(id) {
            if (window.todoApp.timerIntervals.has(id)) {
                clearInterval(window.todoApp.timerIntervals.get(id));
                window.todoApp.timerIntervals.delete(id);
                window.todoApp.activeTimers.delete(id);

                // Sincronizar una última vez al detener
                const elements = window.todoApp.getTimerElements(id);
                if (elements.timer) {
                    const timeSpent = parseInt(elements.timer.dataset.timeSpent) || 0;
                    syncTimerWithServer(id, timeSpent);
                }

                console.log(`Timer detenido para tarea ${id}`);
            }
        }

        // Función para actualizar el display del temporizador
        function updateTimerDisplay(id, totalSeconds) {
            const elements = window.todoApp.getTimerElements(id);
            if (!elements.timer) return;

            const hours = Math.floor(totalSeconds / 3600);
            const minutes = Math.floor((totalSeconds % 3600) / 60);
            const seconds = totalSeconds % 60;

            const display = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            elements.timer.textContent = display;
        }

        // Función para manejar los clicks del timer
        async function handleTimerClick(event, id, action) {
            event.preventDefault();
            event.stopPropagation();

            const elements = window.todoApp.getTimerElements(id);
            if (!elements.timer) {
                console.error(`Timer element not found: timer-${id}`);
                return;
            }

            // Evitar múltiples clics mientras se procesa
            const processingKey = `processing_${id}`;
            if (window.todoApp[processingKey]) {
                console.log(`Ya se está procesando una acción para la tarea ${id}`);
                return;
            }
            window.todoApp[processingKey] = true;

            try {
                const isCurrentlyRunning = elements.timer.dataset.isRunning === "1";

                if ((action === 'start' && isCurrentlyRunning) ||
                    (action === 'stop' && !isCurrentlyRunning)) {
                    console.log(`Estado del timer ya coincide con la acción solicitada: ${action}`);
                    return;
                }

                const component = await getLivewireComponent();
                if (!component) {
                    console.error('No se pudo obtener el componente Livewire');
                    return;
                }

                if (action === 'start') {
                    console.log(`Iniciando temporizador para tarea: ${id}`);
                    const result = await component.call('startTimer', id);

                    if (result !== false) {
                        const status = elements.timer.dataset.status;
                        elements.timer.dataset.isRunning = "1";
                        elements.timer.dataset.lastStarted = new Date().toISOString();

                        startTimer(id, new Date().toISOString());
                        await updateButtonVisibility(id, status, true);
                        console.log(`Timer iniciado y botones actualizados para tarea ${id}`);
                    }
                } else if (action === 'stop') {
                    console.log(`Deteniendo temporizador para tarea: ${id}`);
                    const timeSpent = parseInt(elements.timer.dataset.timeSpent) || 0;
                    const result = await component.call('stopAndSaveTimer', id, timeSpent);

                    if (result !== false) {
                        const status = elements.timer.dataset.status;
                        elements.timer.dataset.isRunning = "0";
                        elements.timer.dataset.lastStarted = "";
                        stopTimer(id);
                        await updateButtonVisibility(id, status, false);
                        console.log(`Timer detenido y botones actualizados para tarea ${id}`);
                    }
                }
            } catch (error) {
                console.error(`Error en handleTimerClick para tarea ${id}:`, error);
            } finally {
                delete window.todoApp[processingKey];
            }
        }

        // Asociar eventos Livewire
        function setupEventListeners() {
            console.log('Configurando eventos...');

            // Escuchar eventos de actualización
            Livewire.on('taskUpdated', (data) => {
                console.log('Tarea actualizada, verificando estados...');
                const elements = window.todoApp.getTimerElements(data.id);
                if (!elements.timer) return;

                const isRunning = elements.timer.dataset.isRunning === "1";
                const status = elements.timer.dataset.status;

                if (status === 'doing') {
                    updateButtonVisibility(data.id, status, isRunning);
                    if (isRunning && !window.todoApp.activeTimers.has(data.id)) {
                        console.log(`Reiniciando timer para tarea ${data.id}`);
                        startTimer(data.id, elements.timer.dataset.lastStarted);
                    } else if (!isRunning && window.todoApp.activeTimers.has(data.id)) {
                        console.log(`Deteniendo timer inactivo para tarea ${data.id}`);
                        stopTimer(data.id);
                    }
                } else {
                    if (window.todoApp.activeTimers.has(data.id)) {
                        console.log(`Deteniendo timer para tarea no-doing ${data.id}`);
                        stopTimer(data.id);
                    }
                }
            });

            // Manejar actualizaciones de Livewire
            Livewire.hook('message.processed', (message, component) => {
                if (window.todoApp.isInitializing) {
                    console.log('Ignorando reinicialización durante actualización Livewire');
                    return;
                }

                // Solo reinicializar si hay cambios relevantes
                const hasTimerChanges = message.response.effects.html?.includes('timer-text');
                if (hasTimerChanges) {
                    console.log('Cambios detectados en timers, actualizando estados...');
                    document.querySelectorAll('.timer-text').forEach(timer => {
                        if (!timer?.dataset) return;

                        const id = timer.dataset.todoId;
                        if (!id) return;

                        const isRunning = timer.dataset.isRunning === "1";
                        const status = timer.dataset.status;

                        if (status === 'doing') {
                            updateButtonVisibility(id, status, isRunning);
                            if (isRunning && !window.todoApp.activeTimers.has(id)) {
                                console.log(`Reiniciando timer para tarea ${id}`);
                                startTimer(id, timer.dataset.lastStarted);
                            } else if (!isRunning && window.todoApp.activeTimers.has(id)) {
                                console.log(`Deteniendo timer inactivo para tarea ${id}`);
                                stopTimer(id);
                            }
                        }
                    });
                }
            });
        }

        // Inicialización
        document.addEventListener('DOMContentLoaded', () => {
            console.log('Iniciando inicialización de TodoApp...');

            // Limpiar estados anteriores
            console.log('Iniciando limpieza...');
            window.todoApp.activeTimers.forEach(id => stopTimer(id));
            window.todoApp.activeTimers.clear();
            window.todoApp.buttonStates.clear();
            window.todoApp.runningTasks.clear();
            window.todoApp.timerIntervals.clear();
            console.log('Limpieza completada');

            // Inicializar componentes
            initializeTimers();
            setupDragAndDrop();
            setupEventListeners();

            console.log('TodoApp inicializada correctamente');
        });

        // Configurar drag-and-drop
        function setupDragAndDrop() {
            if (window.todoApp.dragAndDropInitialized) return;

            console.log('Configurando drag-and-drop...');
            document.querySelectorAll('.list-group-container').forEach(container => {
                container.addEventListener('dragover', allowDrop);
                container.addEventListener('drop', drop);
            });

            document.querySelectorAll('.list-group-item').forEach(item => {
                item.addEventListener('dragstart', drag);
                item.addEventListener('dragend', handleDragEnd);
            });

            window.todoApp.dragAndDropInitialized = true;
        }

        function allowDrop(event) {
            event.preventDefault();
            const container = event.target?.closest('.list-group-container');
            if (container?.classList) {
                container.classList.add('drag-over');
            }
        }

        function drag(event) {
            const target = event.target;
            if (!target?.classList || !target.dataset?.id) return;

            event.dataTransfer.setData('text/plain', target.dataset.id);
            target.classList.add('dragging');
        }

        function handleDragEnd(event) {
            document.querySelectorAll('.list-group-container').forEach(container => {
                container?.classList?.remove('drag-over');
            });

            document.querySelectorAll('.dragging').forEach(element => {
                element?.classList?.remove('dragging');
            });
        }

        function drop(event) {
            event.preventDefault();
            const container = event.target?.closest('.list-group-container');
            if (!container?.classList) return;

            container.classList.remove('drag-over');
            const taskId = event.dataTransfer.getData('text/plain');
            const status = container.getAttribute('data-status');

            if (!taskId || !status) return;

            getLivewireComponent()
                .then(component => component.call('updateTaskStatus', taskId, status))
                .catch(error => console.error('Error al actualizar estado:', error));
        }

        // Obtener componente Livewire
        async function getLivewireComponent() {
            if (window.todoApp.livewireComponent) return window.todoApp.livewireComponent;

            return new Promise((resolve, reject) => {
                const maxAttempts = 5;
                let attempts = 0;

                const tryGetComponent = () => {
                    const element = document.querySelector('[wire\\:id]');
                    if (!element) {
                        if (attempts < maxAttempts) {
                            attempts++;
                            setTimeout(tryGetComponent, 200);
                            return;
                        }
                        reject(new Error('No se encontró el componente Livewire'));
                        return;
                    }

                    const componentId = element.getAttribute('wire:id');
                    if (!componentId) {
                        reject(new Error('El elemento no tiene wire:id'));
                        return;
                    }

                    const component = window.Livewire?.find(componentId);
                    if (component) {
                        window.todoApp.livewireComponent = component;
                        resolve(component);
                    } else if (attempts < maxAttempts) {
                        attempts++;
                        setTimeout(tryGetComponent, 200);
                    } else {
                        reject(new Error('No se pudo obtener el componente Livewire'));
                    }
                };

                tryGetComponent();
            });
        }
    </script>


    <style>
    .glass-input {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        color: white;
    }

    .todo-open {
        background: rgba(13, 202, 240, 0.2) !important;
        border: 1px solid rgba(13, 202, 240, 0.3) !important;
    }

    .todo-doing {
        background: rgba(255, 193, 7, 0.2) !important;
        border: 1px solid rgba(255, 193, 7, 0.3) !important;
    }

    .todo-done {
        background: rgba(25, 135, 84, 0.2) !important;
        border: 1px solid rgba(25, 135, 84, 0.3) !important;
    }

    .todo-trash {
        background: rgba(33, 37, 41, 0.2) !important;
        border: 1px solid rgba(33, 37, 41, 0.3) !important;
    }

    .list-group-container {
        min-height: 50px;
        padding: 0px;
        transition: background-color 0.3s ease;
    }

    .list-group-container.drag-over {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 0.5rem;
    }

    .list-group-item {
        cursor: grab;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .list-group-item:active {
        cursor: grabbing;
    }

    .list-group-item.dragging {
        opacity: 0.5;
        transform: scale(0.95);
    }

    </style>
</div>
