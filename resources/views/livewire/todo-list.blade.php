<div>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-8 mb-3">
                <form wire:submit.prevent="store">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control custom-border" placeholder="New Task..." wire:model="task">
                        <button type="submit" class="btn btn-danger">Add</button>
                    </div>
                    @error('task')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </form>
            </div>
        </div>

        <!-- Columnas de tareas -->
        <div class="row">
            @foreach(['open' => '🌟 To Do', 'doing' => '💫 Doing', 'done' => '🏆 Done', 'trash' => '❌ Trash'] as $status => $title)
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-header text-center text-light fs-5 m-0">{{ $title }}</div>
                    <hr class="text-light m-0">
                    <ul class="list-group list-group-flush" id="{{ $status }}" style="min-height: 3rem;"
                        ondrop="drop(event)" ondragover="allowDrop(event)" data-status="{{ $status }}">
                        @foreach($todos->where('status', $status) as $todo)
                        <li class="list-group-item {{ $this->getTaskClass($todo->status) }} rounded m-2 ps-0" style="cursor: pointer;"
                            draggable="true" ondragstart="drag(event)" id="task-{{ $todo->id }}" data-id="{{ $todo->id }}">
                            <div class="d-flex">
                                <i class="bi bi-grip-vertical fs-3 m-0 p-0" style="cursor: move;"></i>
                                <p>{{ $todo->task }}</p>
                            </div>
                            @if($todo->status === 'doing' || $todo->status === 'done')
                            <div class="text-end">
                                <span class="fs-5" id="timer-{{ $todo->id }}" data-time="{{ $todo->time_spent }}"> {{ $todo->time_spent ? $todo->formatted_time_spent : '00:00:00' }} </span>
                                @if ($todo->status === 'doing')
                                    <button class="btn btn-sm btn-success" onclick="pauseTimer({{ $todo->id }})" id="pause-{{ $todo->id }}">
                                        {{ $todo->is_paused ? 'Pause' : 'Play' }}
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="stopTimer({{ $todo->id }})">Stop</button>
                                @endif
                            </div>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                    @if ($status == 'trash' && $todos->where('status', $status)->count() > 0)
                        <div class="card-footer text-center">
                            <a href="#" class="text-decoration-none text-light" wire:click="delete"> 🗑️ Delete </a>
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
            const startTime = new Date().getTime() - (pausedTimes[taskId] * 1000);
            timers[taskId] = setInterval(() => {
                const elapsed = Math.floor((new Date().getTime() - startTime) / 1000);
                document.getElementById(`timer-${taskId}`).textContent = formatTime(elapsed);
            }, 1000);
        }

        function pauseTimer(taskId) {
            const timerElement = document.getElementById(`timer-${taskId}`);
            const button = document.getElementById(`pause-${taskId}`);

            if (button.textContent === 'Pause') {
                clearInterval(timers[taskId]);
                const currentTime = timerElement.textContent;
                pausedTimes[taskId] = convertTimeToSeconds(currentTime);
                button.textContent = 'Play';
            } else {
                startTimer(taskId);
                button.textContent = 'Pause';
            }
        }

        function stopTimer(taskId) {
            clearInterval(timers[taskId]);
            const timerElement = document.getElementById(`timer-${taskId}`);
            const timeSpent = timerElement.textContent;

            pausedTimes[taskId] = convertTimeToSeconds(timeSpent);

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
</div>
