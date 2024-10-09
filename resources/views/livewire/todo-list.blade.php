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
                        <ul class="list-group list-group-flush" id="{{ $status }}" wire:sortable="updateTaskOrder" style="min-height: 3rem;">
                            @foreach($todos->where('status', $status) as $todo)
                                <li class="list-group-item {{ $this->getTaskClass($status) }} rounded m-2" style="cursor: pointer;"
                                    wire:sortable.item="{{ $todo->id }}" wire:key="task-{{ $todo->id }}">
                                    <div class="d-flex" wire:sortable.handle>
                                        <i class="bi bi-grip-vertical fs-3 m-0 p-0" style="cursor: move;"></i>
                                        <p>{{ $todo->task }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        @if ($status == 'trash' && $todos->where('status', 'trash')->count())
                            <button class="btn btn-outline-danger m-0 p-0" wire:click="delete"><i class="bi bi-trash3 fs-5"></i></button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
