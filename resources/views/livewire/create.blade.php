<form>
    <div class="form-group mb-3">
        {{-- <label for="exampleFormControlInput1">Title:</label> --}}
        <input type="text" class="form-control custom-border" id="exampleFormControlInput1" placeholder="New To&Do" wire:model="task">
        @error('task') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <button wire:click.prevent="store()" class="btn btn-outline-danger">Save</button>
</form>
