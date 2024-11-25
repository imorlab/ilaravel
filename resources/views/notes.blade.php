@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-10">
            <div class="col-auto floating text-center mb-4">
                <img src="{{ asset('/img/underwater_jelly.svg') }}" class="img-fluid ms-auto me-auto d-block mb-1">
            </div>
            <div class="card shadow glass-card">
                <div class="card-header glass-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0 text-light">Notas Personales</h2>
                    <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#newNoteModal">
                        <i class="bi bi-plus-lg"></i> Nueva Nota
                    </button>
                </div>
                <div class="card-body glass-body">
                    <div class="row">
                        <div class="col-md-3">
                            <!-- Categorías -->
                            <div class="list-group glass-list">
                                <a href="#" class="list-group-item list-group-item-action active glass-item" data-category="all">
                                    Todas las Notas
                                </a>
                                <a href="#" class="list-group-item list-group-item-action glass-item" data-category="favorites">
                                    <i class="bi bi-star-fill text-warning"></i> Favoritos
                                </a>
                                <a href="#" class="list-group-item list-group-item-action glass-item" data-category="trabajo">
                                    <i class="bi bi-folder"></i> Trabajo
                                </a>
                                <a href="#" class="list-group-item list-group-item-action glass-item" data-category="personal">
                                    <i class="bi bi-folder"></i> Personal
                                </a>
                                <a href="#" class="list-group-item list-group-item-action glass-item" data-category="ideas">
                                    <i class="bi bi-folder"></i> Ideas
                                </a>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <!-- Buscador -->
                            <div class="form-group mb-3">
                                <input type="text" 
                                       class="form-control glass-input"
                                       id="searchNote"
                                       placeholder="Buscar notas...">
                            </div>
                            
                            <!-- Lista de Notas -->
                            <div class="row row-cols-1 row-cols-md-2 g-4" id="notesList">
                                @foreach($notes as $note)
                                <div class="col note-item" data-category="{{ $note->category }}">
                                    <div class="card h-100 glass-note">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <h5 class="card-title text-light mb-0">{{ $note->title }}</h5>
                                                <button class="btn btn-link p-0 favorite-btn" data-note-id="{{ $note->id }}">
                                                    <i class="bi {{ $note->is_favorite ? 'bi-star-fill' : 'bi-star' }} text-warning"></i>
                                                </button>
                                            </div>
                                            <p class="card-text text-light">{{ $note->content }}</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-light">{{ $note->updated_at->diffForHumans() }}</small>
                                                <div>
                                                    <button class="btn btn-sm btn-outline-light edit-note" 
                                                            data-note-id="{{ $note->id }}"
                                                            data-note-title="{{ $note->title }}"
                                                            data-note-content="{{ $note->content }}"
                                                            data-note-category="{{ $note->category }}"
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#editNoteModal">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <form action="{{ route('notes.destroy', $note) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Estás seguro?')">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col text-center">
            <h5 class="text-center" style="color: #d54040">#ImlBeonww2024</h5>
            <a href="{{ '/' }}" type="button" class="btn btn-outline-warning btn-circle p-0">
                <i class="bi bi-house-fill p-0"></i>
            </a>
        </div>
    </div>
</div>

<!-- Modal Nueva Nota -->
<div class="modal fade" id="newNoteModal" tabindex="-1" aria-labelledby="newNoteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content glass-card">
            <div class="modal-header glass-header">
                <h5 class="modal-title text-light" id="newNoteModalLabel">Nueva Nota</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('notes.store') }}" method="POST">
                @csrf
                <div class="modal-body glass-body">
                    <div class="mb-3">
                        <label for="title" class="form-label text-light">Título</label>
                        <input type="text" class="form-control glass-input" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label text-light">Contenido</label>
                        <textarea class="form-control glass-input" id="content" name="content" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label text-light">Categoría</label>
                        <select class="form-control glass-input" id="category" name="category" required>
                            <option value="trabajo">Trabajo</option>
                            <option value="personal">Personal</option>
                            <option value="ideas">Ideas</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer glass-header">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-register">Guardar Nota</button>
                        <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Nota -->
<div class="modal fade" id="editNoteModal" tabindex="-1" aria-labelledby="editNoteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content glass-card">
            <div class="modal-header glass-header">
                <h5 class="modal-title text-light" id="editNoteModalLabel">Editar Nota</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editNoteForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body glass-body">
                    <div class="mb-3">
                        <label for="editTitle" class="form-label text-light">Título</label>
                        <input type="text" class="form-control glass-input" id="editTitle" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="editContent" class="form-label text-light">Contenido</label>
                        <textarea class="form-control glass-input" id="editContent" name="content" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editCategory" class="form-label text-light">Categoría</label>
                        <select class="form-control glass-input" id="editCategory" name="category" required>
                            <option value="trabajo">Trabajo</option>
                            <option value="personal">Personal</option>
                            <option value="ideas">Ideas</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer glass-header">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-register">Actualizar Nota</button>
                        <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.glass-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.glass-header {
    background: rgba(255, 255, 255, 0.1);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.glass-body {
    background: transparent;
}

.glass-input {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: white;
    backdrop-filter: blur(5px);
}

.glass-input:focus {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.2);
    color: white;
    box-shadow: none;
}

.glass-input::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

/* Estilos para el select */
select.glass-input {
    background-color: rgba(255, 255, 255, 0.05);
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

select.glass-input option {
    background-color: #1f1b1b;
    color: white;
}

select.glass-input:focus {
    background-color: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.2);
    color: white;
}

/* Estilos para el botón de actualizar */
.btn-register {
    background: linear-gradient(45deg, #d54040, #3d0b46);
    border: none;
    color: white;
    font-weight: bold;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.btn-register:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(213, 64, 64, 0.3);
    color: white;
}

.btn-register:active {
    transform: translateY(0);
}

.btn-register::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        90deg,
        transparent,
        rgba(255, 255, 255, 0.2),
        transparent
    );
    transition: 0.5s;
}

.btn-register:hover::before {
    left: 100%;
}

.glass-list .glass-item {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: white;
    transition: all 0.3s ease;
}

.glass-list .glass-item:hover,
.glass-list .glass-item.active {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.2);
}

.glass-note {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.glass-note:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

.favorite-btn {
    color: white;
    text-decoration: none;
}

.favorite-btn:hover {
    color: #ffc107;
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Manejar edición de notas
    const editButtons = document.querySelectorAll('.edit-note');
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const noteId = this.dataset.noteId;
            const noteTitle = this.dataset.noteTitle;
            const noteContent = this.dataset.noteContent;
            const noteCategory = this.dataset.noteCategory;
            
            document.getElementById('editTitle').value = noteTitle;
            document.getElementById('editContent').value = noteContent;
            document.getElementById('editCategory').value = noteCategory;
            
            const form = document.getElementById('editNoteForm');
            form.action = `/notes/${noteId}`;
        });
    });

    // Manejar favoritos
    const favoriteButtons = document.querySelectorAll('.favorite-btn');
    favoriteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const noteId = this.dataset.noteId;
            fetch(`/notes/${noteId}/toggle-favorite`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                const icon = this.querySelector('i');
                if (data.is_favorite) {
                    icon.classList.remove('bi-star');
                    icon.classList.add('bi-star-fill');
                } else {
                    icon.classList.remove('bi-star-fill');
                    icon.classList.add('bi-star');
                }
            });
        });
    });

    // Filtrar por categoría
    const categoryLinks = document.querySelectorAll('.glass-list .glass-item');
    categoryLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Actualizar clase activa
            categoryLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
            
            const category = this.dataset.category;
            const notes = document.querySelectorAll('.note-item');
            
            if (category === 'all') {
                notes.forEach(note => note.style.display = '');
            } else if (category === 'favorites') {
                notes.forEach(note => {
                    const isFavorite = note.querySelector('.bi-star-fill') !== null;
                    note.style.display = isFavorite ? '' : 'none';
                });
            } else {
                notes.forEach(note => {
                    note.style.display = note.dataset.category === category ? '' : 'none';
                });
            }
        });
    });

    // Buscador
    const searchInput = document.getElementById('searchNote');
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const notes = document.querySelectorAll('.note-item');
        
        notes.forEach(note => {
            const title = note.querySelector('.card-title').textContent.toLowerCase();
            const content = note.querySelector('.card-text').textContent.toLowerCase();
            const matches = title.includes(searchTerm) || content.includes(searchTerm);
            note.style.display = matches ? '' : 'none';
        });
    });
});
</script>
@endpush

@endsection
