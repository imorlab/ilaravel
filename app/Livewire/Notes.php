<?php

namespace App\Livewire;

use App\Models\Note;
use Livewire\Component;
use Livewire\Attributes\On;

class Notes extends Component
{
    public $notes;
    public $currentCategory = 'all';
    public $searchTerm = '';
    public $showNoteForm = false;
    public $showDeleteConfirm = false;
    public $selectedNoteId = null;

    protected $listeners = [
        'noteUpdated' => 'loadNotes',
        'showNoteForm' => 'showNoteForm',
        'editNote' => 'editNote',
        'confirmDelete' => 'confirmDelete'
    ];

    public function mount()
    {
        $this->loadNotes();
    }

    public function showNoteForm()
    {
        $this->showNoteForm = true;
    }

    public function editNote($noteId)
    {
        $this->selectedNoteId = $noteId;
        $this->showNoteForm = true;
    }

    public function confirmDelete($noteId)
    {
        $this->selectedNoteId = $noteId;
        $this->showDeleteConfirm = true;
    }

    public function loadNotes()
    {
        $query = Note::query();

        if ($this->searchTerm) {
            $query->where(function($q) {
                $q->where('title', 'like', "%{$this->searchTerm}%")
                  ->orWhere('content', 'like', "%{$this->searchTerm}%");
            });
        }

        if ($this->currentCategory !== 'all') {
            if ($this->currentCategory === 'favorites') {
                $query->where('is_favorite', true);
            } else {
                $query->where('category', $this->currentCategory);
            }
        }

        $this->notes = $query->latest()->get();
    }

    public function toggleFavorite($noteId)
    {
        try {
            $note = Note::findOrFail($noteId);
            $note->update(['is_favorite' => !$note->is_favorite]);
            $this->loadNotes();
        } catch (\Exception $e) {
            session()->flash('error', 'No se pudo actualizar el estado de favorito.');
        }
    }

    public function updatedSearchTerm()
    {
        $this->loadNotes();
    }

    public function updatedCurrentCategory()
    {
        $this->loadNotes();
    }

    public function render()
    {
        return view('livewire.notes');
    }
}
