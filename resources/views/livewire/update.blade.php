<form>
    <input type="hidden" wire:model="todo_id">
    <div class="form-group mb-3">
        {{-- <label for="exampleFormControlInput1">Title:</label> --}}
        <input type="text" class="form-control custom-border" id="exampleFormControlInput1" placeholder="Enter Title" wire:model="task">
        @error('task') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <button wire:click.prevent="update()" class="btn btn-dark">Update</button>
    <button wire:click.prevent="cancel()" class="btn btn-danger">Cancel</button>
</form>
