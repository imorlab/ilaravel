<?php

namespace App\Livewire\Notes;

use App\Models\Note;
use Livewire\Component;

class NoteForm extends Component
{
    public $title = '';
    public $content = '';
    public $category = '';
    public $editingNoteId = null;
    public $show = false;

    protected $listeners = ['showNoteForm', 'editNote'];

    public function showNoteForm()
    {
        $this->resetForm();
        $this->show = true;
    }

    public function editNote($noteId)
    {
        try {
            $note = Note::findOrFail($noteId);
            $this->editingNoteId = $noteId;
            $this->title = $note->title;
            $this->content = $note->content;
            $this->category = $note->category;
            $this->show = true;
        } catch (\Exception $e) {
            session()->flash('error', 'No se pudo cargar la nota para editar.');
        }
    }

    public function save()
    {
        $validated = $this->validate([
            'title' => 'required|min:3',
            'content' => 'required',
            'category' => 'required|in:trabajo,personal,ideas'
        ]);

        try {
            if ($this->editingNoteId) {
                $note = Note::findOrFail($this->editingNoteId);
                $note->update($validated);
                session()->flash('success', '¡Nota actualizada correctamente!');
            } else {
                Note::create($validated);
                session()->flash('success', '¡Nota creada correctamente!');
            }

            $this->close();
            $this->dispatch('noteUpdated');
        } catch (\Exception $e) {
            session()->flash('error', 'Ocurrió un error al guardar la nota.');
        }
    }

    public function close()
    {
        $this->show = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->reset(['title', 'content', 'category', 'editingNoteId']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.notes.note-form');
    }
}
