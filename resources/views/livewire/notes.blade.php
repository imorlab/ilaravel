<div>
    <div class="container justify-content-center align-items-center mt-5 pt-5">
        <div class="card shadow glass-card">
            <div class="card-header glass-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0 text-light">iNotas</h2>
                <button wire:click="$dispatch('showNoteForm')" class="ibtn">
                    <i class="bi bi-plus-lg me-2"></i> Nueva Nota
                </button>
            </div>
            <div class="card-body">
                <!-- Filtros y búsqueda -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <select class="form-select glass-input" wire:model.live="currentCategory">
                            <option value="all">Todas las notas</option>
                            <option value="favorites">Favoritos</option>
                            <option value="trabajo">Trabajo</option>
                            <option value="personal">Personal</option>
                            <option value="ideas">Ideas</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <input wire:model.live="searchTerm" type="text" class="form-control glass-input" placeholder="Buscar notas...">
                    </div>
                </div>

                <!-- Lista de notas -->
                <div class="row">
                    @forelse($notes as $note)
                        <div class="col-md-4 mb-4">
                            <div class="card glass-card h-100">
                                <div class="card-header glass-header py-2">
                                    <h5 class="card-title mb-0 text-white">{{ $note->title }}</h5>
                                </div>
                                <div class="card-body glass-body">
                                    <p class="card-text text-white m-0" style="font-size: 0.9rem;">{{ $note->content }}</p>
                                    <div class="fixed-bottom px-4">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center gap-2">
                                                @if($note->category)
                                                    <x-category-badge :category="$note->category" />
                                                @endif
                                                <small class="text-light" style="font-size: 0.8rem;">{{ $note->created_at->diffForHumans() }}</small>
                                            </div>
                                            <div class="btn-group">
                                                <button wire:click="toggleFavorite({{ $note->id }})" class="btn btn-link text-warning p-1">
                                                    <i class="bi {{ $note->is_favorite ? 'bi-star-fill' : 'bi-star' }}"></i>
                                                </button>
                                                <button wire:click="$dispatch('editNote', { noteId: {{ $note->id }} })" class="btn btn-link text-info p-1">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button wire:click="$dispatch('confirmDelete', { noteId: {{ $note->id }} })" class="btn btn-link text-danger p-1">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info">
                                No hay notas disponibles.
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Componentes de Modal -->
    @livewire('notes.note-form')
    @livewire('notes.delete-confirm')

    <!-- Notificaciones -->
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show position-fixed bottom-0 end-0 m-3" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show position-fixed bottom-0 end-0 m-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
