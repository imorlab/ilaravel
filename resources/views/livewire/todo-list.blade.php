<div class="flex justify-center">
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="row justify-content-center">
        <div class="col-md-6 mb-3">
            <div class="form-group mb-3">
                <input type="text" wire:model="task" wire:keydown.enter="addTodo" placeholder="{{ __('New Todo') }}"
                class="custom-border form-control @error('email') is-invalid @enderror" name="task">
                <ul class="list-group mt-5">

                @forelse ($todos as $todo)
                    <li class="list-group-item list-group-item-action text-danger">

                        @if($todo->status == 'open')
                            <input class="custom-border form-check-input me-1" type="checkbox" value="" id="markAsDone-{{ $todo->id }}" wire:change="markAsDone({{ $todo->id }})">
                        @endif

                        <label class="form-check-label" for="markAsDone-{{ $todo->id }}" style="{{ ($todo->status == 'done')?'text-decoration: line-through':'' }}">{{ $todo->task }}</label>
                        <a wire:click="editTodo({{ $todo->id }})">
                            <i class="bi bi-trash3 align-item-end"></i>
                        </a>
                        @if($todo->status == 'done')
                            <a wire:click="remove({{ $todo->id }})">
                                <i class="bi bi-trash3 align-item-end"></i>
                            </a>
                        @endif
                    </li>
                @empty
                    <p>No todos here.</p>
                @endforelse
                </ul>
                <button type="submit" class="btn btn-register mt-3">{{ __('Enviar') }}</button>
            </div>
        </div>
    </div>
</div>
