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
            <div class="col-md-3">
                <div class="card glass-card mb-0">
                    <div class="shine"></div>
                    <div class="card-header glass-header text-center text-light fs-5 m-0">
                        {{ $title }}
                    </div>
                    <div class="card-body p-2">
                        <ul class="list-group list-group-flush glass-list" id="{{ $status }}" style="min-height: 3rem;"
                            ondrop="drop(event)" ondragover="allowDrop(event)" data-status="{{ $status }}">
                            @foreach($todos->where('status', $status) as $todo)
                            <li class="list-group-item glass-item todo-{{ $todo->status }} rounded m-2"
                                draggable="true" ondragstart="drag(event)" id="task-{{ $todo->id }}" data-id="{{ $todo->id }}">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-grip-vertical fs-5 text-light me-2" style="cursor: move;"></i>
                                    <span class="text-light">{{ $todo->task }}</span>
                                </div>
                                @if($todo->status === 'doing' || $todo->status === 'done')
                                <div class="timer-controls">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="glass-timer">
                                            <i class="bi bi-clock-history me-2"></i>
                                            <span class="timer-text" id="timer-{{ $todo->id }}"
                                                  data-time-spent="{{ $todo->time_spent }}"
                                                  data-is-running="{{ !$todo->is_paused }}"
                                                  data-status="{{ $todo->status }}">
                                                00:00:00
                                            </span>
                                        </div>
                                        @if($todo->status === 'doing')
                                        <button type="button" class="glass-button-timer" id="play-{{ $todo->id }}"
                                                wire:click="startTimer({{ $todo->id }})"
                                                style="display: {{ !$todo->is_paused ? 'none' : 'inline-block' }}">
                                            <i class="bi bi-play-circle-fill"></i>
                                        </button>
                                        <button type="button" class="glass-button-timer" id="stop-{{ $todo->id }}"
                                                wire:click="startTimer({{ $todo->id }})"
                                                style="display: {{ $todo->is_paused ? 'none' : 'inline-block' }}">
                                            <i class="bi bi-stop-circle-fill"></i>
                                        </button>
                                        @endif
                                    </div>
                                </div>
                                @endif
                            </li>
                            @endforeach
                        </ul>
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
        function allowDrop(event) {
            event.preventDefault();
        }

        function drag(event) {
            event.dataTransfer.setData("text", event.target.id);
        }

        function drop(event) {
            event.preventDefault();
            var taskId = event.dataTransfer.getData("text");
            var targetColumn = event.target.closest('ul');
            var status = targetColumn.getAttribute('data-status');

            // Agregar el elemento a la nueva columna
            targetColumn.appendChild(document.getElementById(taskId));

            // Llamar a Livewire para actualizar el estado de la tarea
            window.dispatchEvent(new CustomEvent('updateTaskStatus', {
                detail: {
                    taskId: parseInt(taskId.replace('task-', '')),
                    newStatus: status
                }
            }));
        }

        document.addEventListener('livewire:initialized', () => {
            const timers = {};
            const savedTimes = {};

            function formatTime(seconds) {
                const hrs = Math.floor(seconds / 3600).toString().padStart(2, '0');
                const mins = Math.floor((seconds % 3600) / 60).toString().padStart(2, '0');
                const secs = (seconds % 60).toString().padStart(2, '0');
                return `${hrs}:${mins}:${secs}`;
            }

            function updateDisplay(taskId) {
                const display = document.getElementById(`timer-${taskId}`);
                if (display) {
                    display.textContent = formatTime(savedTimes[taskId] || 0);
                }
            }

            function clearTimer(taskId) {
                if (timers[taskId]) {
                    clearInterval(timers[taskId]);
                    delete timers[taskId];
                }
            }

            function initializeTimer(element) {
                const taskId = element.id.replace('timer-', '');
                const timeSpent = parseInt(element.getAttribute('data-time-spent')) || 0;
                const isRunning = element.getAttribute('data-is-running') === 'true';
                const status = element.getAttribute('data-status');

                // Limpiar timer existente
                clearTimer(taskId);

                // Actualizar el tiempo guardado y el display
                savedTimes[taskId] = timeSpent;
                updateDisplay(taskId);

                // Si está en 'doing' y no está pausado, iniciar el timer
                if (status === 'doing' && isRunning) {
                    timers[taskId] = setInterval(() => {
                        savedTimes[taskId]++;
                        updateDisplay(taskId);
                    }, 1000);
                }
            }

            function initializeAllTimers() {
                // Inicializar todos los timers
                document.querySelectorAll('[id^="timer-"]').forEach(initializeTimer);
            }

            // Inicializar al cargar
            initializeAllTimers();

            // Reinicializar en actualizaciones de Livewire
            Livewire.on('timersUpdated', initializeAllTimers);

            // Manejar cambios por arrastre
            document.addEventListener('dragend', () => {
                setTimeout(initializeAllTimers, 100);
            });
        });
    </script>
    <style>
    .glass-input {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
    }
    .glass-input::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }
    .glass-input:focus {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.3);
        color: white;
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.1);
    }
    .glass-danger {
        background: rgba(220, 53, 69, 0.7);
        border: 1px solid rgba(220, 53, 69, 0.3);
        backdrop-filter: blur(10px);
        color: white;
    }
    .glass-danger:hover {
        background: rgba(220, 53, 69, 0.8);
        color: white;
    }
    .glass-item {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
    }
    .glass-list {
        background: transparent;
    }
    .glass-badge {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
    }
    .glass-timer {
        background: rgba(13, 110, 253, 0.2);
        border: 1px solid rgba(13, 110, 253, 0.3);
        backdrop-filter: blur(10px);
        width: 100%;
    }
    .timer-text {
        color: white;
        font-size: 1rem;
        font-weight: 500;
        letter-spacing: 0.5px;
        font-family: 'Courier New', monospace;
    }
    .timer-controls {
        width: 100%;
    }
    .glass-button-timer {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        padding: 0.25rem 0.5rem;
        color: white;
        transition: all 0.3s ease;
    }
    .glass-button-timer:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.3);
        color: white;
        transform: translateY(-1px);
    }
    .glass-button-timer i {
        filter: drop-shadow(0 0 2px rgba(255, 255, 255, 0.5));
        font-size: 1.2rem;
    }
    </style>
</div>
