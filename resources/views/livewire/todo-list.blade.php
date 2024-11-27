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
                            <li class="list-group-item glass-item {{ $this->getTaskClass($todo->status) }} rounded m-2" 
                                draggable="true" ondragstart="drag(event)" id="task-{{ $todo->id }}" data-id="{{ $todo->id }}">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-grip-vertical fs-5 text-light me-2" style="cursor: move;"></i>
                                    <span class="text-light">{{ $todo->task }}</span>
                                </div>
                                @if($todo->status === 'doing' || $todo->status === 'done')
                                <div class="timer-controls mt-2">
                                    <div class="d-flex align-items-center glass-timer px-2 py-1 rounded">
                                        <i class="bi bi-clock-history text-light me-2"></i>
                                        <span class="timer-text" id="timer-{{ $todo->id }}" data-time="{{ $todo->time_spent }}">
                                            {{ $this->formattedTimeSpent($todo->time_spent) }}
                                        </span>
                                    </div>
                                    @if ($todo->status === 'doing')
                                    <div class="d-flex mt-2 justify-content-end">
                                        <button class="btn glass-button-timer me-2" onclick="pauseTimer({{ $todo->id }})" id="pause-{{ $todo->id }}" wire:ignore>
                                            <i class="bi {{ $todo->is_paused ? 'bi-play-circle-fill' : 'bi-pause-circle-fill' }}"></i>
                                        </button>
                                        <button class="btn glass-button-timer" onclick="stopTimer({{ $todo->id }})" wire:ignore>
                                            <i class="bi bi-check-circle-fill"></i>
                                        </button>
                                    </div>
                                    @endif
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

        const timers = {};
        const pausedTimes = {};

        document.addEventListener('DOMContentLoaded', function () {
            initializeTimers();
        });

        function initializeTimers() {
            document.querySelectorAll('[id^="timer-"]').forEach(timerElement => {
                const taskId = timerElement.id.replace('timer-', '');
                const savedTime = parseInt(timerElement.getAttribute('data-time')); // Recupera el tiempo desde el atributo
                pausedTimes[taskId] = savedTime || 0; // Inicializa el tiempo pausado con el valor de la base de datos o 0
                timerElement.textContent = formatTime(pausedTimes[taskId]); // Muestra el tiempo almacenado al cargar
            });
        }

        function startTimer(taskId) {
            if (timers[taskId]) {
                clearInterval(timers[taskId]);
            }

            pausedTimes[taskId] = pausedTimes[taskId] || 0;
            const startTime = Date.now() - (pausedTimes[taskId] * 1000);

            timers[taskId] = setInterval(() => {
                const totalElapsed = Math.floor((Date.now() - startTime) / 1000);
                document.getElementById(`timer-${taskId}`).textContent = formatTime(totalElapsed);
            }, 1000);
        }

        function pauseTimer(taskId) {
            const timerElement = document.getElementById(`timer-${taskId}`);
            const button = document.getElementById(`pause-${taskId}`);
            const isPaused = button.classList.contains('paused');

            if (isPaused) {
                clearInterval(timers[taskId]);
                const currentTime = timerElement.textContent;
                pausedTimes[taskId] = convertTimeToSeconds(currentTime);
                button.classList.remove('paused');
                button.querySelector('i').classList.remove('bi-pause');
                button.querySelector('i').classList.add('bi-play-fill');
            } else {
                startTimer(taskId);
                button.classList.add('paused');
                button.querySelector('i').classList.remove('bi-play-fill');
                button.querySelector('i').classList.add('bi-pause');
            }
        }


        function stopTimer(taskId) {
            clearInterval(timers[taskId]);
            const timerElement = document.getElementById(`timer-${taskId}`);
            const button = document.getElementById(`pause-${taskId}`);
            const timeSpent = timerElement.textContent;

            button.classList.remove('paused');
            button.querySelector('i').classList.remove('bi-pause');
            button.querySelector('i').classList.add('bi-play-fill');

            pausedTimes[taskId] = convertTimeToSeconds(timeSpent);

            timerElement.textContent = formatTime(pausedTimes[taskId]);

            window.dispatchEvent(new CustomEvent('updateTimeSpent', {
                detail: {
                    taskId: taskId,
                    timeSpent: timeSpent
                }
            }));
        }


        function formatTime(seconds) {
            const hrs = String(Math.floor(seconds / 3600)).padStart(2, '0');
            const mins = String(Math.floor((seconds % 3600) / 60)).padStart(2, '0');
            const secs = String(seconds % 60).padStart(2, '0');
            return `${hrs}:${mins}:${secs}`;
        }

        function convertTimeToSeconds(time) {
            const [hrs, mins, secs] = time.split(':').map(Number);
            return (hrs * 3600) + (mins * 60) + secs;
        }

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
