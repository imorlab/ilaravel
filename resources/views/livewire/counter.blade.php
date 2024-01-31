<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1>{{ $title }}</h1>

            <h1>{{ $count }}</h1>


            <button type="button" class="btn btn-outline-danger" wire:click="increment"><i class="bi bi-plus-lg"></i></button>

            <button type="button" class="btn btn-outline-danger" wire:click="decrement"><i class="bi bi-dash-lg"></i></button>
        </div>
    </div>
</div>
