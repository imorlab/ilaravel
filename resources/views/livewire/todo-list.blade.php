<div>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-8 mb-3">
                <form wire:submit.prevent="store">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control custom-border" placeholder="New Task..." wire:model="task">
                        @error('task') <span class="text-danger">{{ $message }}</span> @enderror
                        <button type="submit" class="btn btn-danger">Add</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Columnas de tareas -->
        <div class="row">
            <!-- Columna To Do -->
            <div class="col-md-3">
                <div class="card bg-dark text-light mb-3">
                    <div class="card-header text-center fs-5">🌟 To Do</div>
                    <hr class="m-0">
                    <ul class="list-group list-group-flush task-list" wire:sortable="updateTaskOrder" wire:sortable-group="toDoGroup">
                        @foreach($todos->where('status', 'open') as $todo)
                            <li class="list-group-item bg-info rounded rounded-3 m-2 text-dark" wire:sortable.item="{{ $todo->id }}" wire:key="todo-{{ $todo->id }}">
                                <p>{{ $todo->task }}</p>
                                <div wire:sortable.handle>
                                    <i class="bi bi-grip-horizontal" style="cursor: move;"></i>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Columna Doing -->
            <div class="col-md-3">
                <div class="card bg-dark text-light mb-3">
                    <div class="card-header text-center fs-5">💫 Doing</div>
                    <hr class="m-0">
                    <ul class="list-group list-group-flush task-list" wire:sortable="updateTaskOrder" wire:sortable-group="doingGroup">
                        @foreach($todos->where('status', 'doing') as $todo)
                            <li class="list-group-item bg-warning rounded rounded-3 m-2 text-light" wire:sortable.item="{{ $todo->id }}" wire:key="doing-{{ $todo->id }}">
                                <p>{{ $todo->task }}</p>
                                <div wire:sortable.handle>
                                    <i class="bi bi-grip-horizontal" style="cursor: move;"></i>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Columna Done -->
            <div class="col-md-3">
                <div class="card bg-dark text-light mb-3">
                    <div class="card-header text-center fs-5">🏆 Done</div>
                    <hr class="m-0">
                    <ul class="list-group list-group-flush task-list" wire:sortable="updateTaskOrder" wire:sortable-group="doneGroup">
                        @foreach($todos->where('status', 'done') as $todo)
                            <li class="list-group-item bg-success rounded rounded-3 m-2 text-light" wire:sortable.item="{{ $todo->id }}" wire:key="done-{{ $todo->id }}">
                                <p>{{ $todo->task }}</p>
                                <div wire:sortable.handle>
                                    <i class="bi bi-grip-horizontal" style="cursor: move;"></i>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Columna Trash -->
            <div class="col-md-3">
                <div class="card bg-dark text-light mb-3">
                    <div class="card-header text-center fs-5">❌ Trash</div>
                    <hr class="m-0">
                    <ul class="list-group list-group-flush task-list" wire:sortable="updateTaskOrder" wire:sortable-group="trashGroup">
                        @foreach($todos->where('status', 'trash') as $todo)
                            <li class="list-group-item bg-dark text-light" wire:sortable.item="{{ $todo->id }}" wire:key="trash-{{ $todo->id }}">
                                <p>{{ $todo->task }}</p>
                                <div wire:sortable.handle>
                                    <i class="bi bi-grip-horizontal" style="cursor: move;"></i>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="text-center my-2">
                        <button class="btn btn-danger" wire:click="emptyTrash">Delete</button>
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>
