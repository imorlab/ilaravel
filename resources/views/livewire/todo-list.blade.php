<div class="row justify-content-center">
    <div class="col-md-6 mb-3">
        {{-- Nothing in the world is as soft and yielding as water. --}}
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        @if($updateMode)
            @include('livewire.update')
        @else
            @include('livewire.create')
        @endif

        <table class="table table-dark table-hover table-borderless align-middle mt-5">
            {{-- <thead>
                <tr>
                    <th>No.</th>
                    <th>Title</th>
                    <th width="100px">Action</th>
                </tr>
            </thead> --}}
            <tbody>
                @foreach($todos as $todo)
                    <tr>
                        <td width="50px">
                            <input class="form-check-input me-1" type="checkbox" value="open" id="markAsDone-{{ $todo->id }}" wire:change="markAsDone({{ $todo->id }})">
                        </td>
                        <td>
                            <label class="form-check-label" for="markAsDone-{{ $todo->id }}" style="{{ ($todo->status == 'done')?'text-decoration: line-through':'' }}">
                                {{ $todo->task }}
                            </label>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button wire:click="edit({{ $todo->id }})" type="button" class="btn btn-outline-warning"><i class="bi bi-pencil-square"></i></button>
                                <button wire:click="delete({{ $todo->id }})" type="button" class="btn btn-outline-warning"><i class="bi bi-trash3"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row">
            @foreach($todos as $todo)
            <div class="col-sm-6">
                <div class="card border-dark bg-dark bg-gradient m-2 text-light">
                    <div class="card-body">
                        <input class="form-check-input me-1" type="checkbox" value="open" id="markAsDone-{{ $todo->id }}" wire:change="markAsDone({{ $todo->id }})">
                        <label class="form-check-label" for="markAsDone-{{ $todo->id }}" style="{{ ($todo->status == 'done')?'text-decoration: line-through':'' }}">
                            {{ $todo->task }}
                        </label>
                    </div>
                    <div class="card-footer text-end">
                        <i wire:click="edit({{ $todo->id }})" class="bi bi-pencil-square text-warning"></i>
                        <i wire:click="delete({{ $todo->id }})" class="bi bi-trash3 text-danger"></i>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>


