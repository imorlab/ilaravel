<?php

namespace App\Livewire\Notes;

use App\Models\Note;
use Livewire\Component;

class DeleteConfirm extends Component
{
    public $show = false;
    public $noteId = null;

    protected $listeners = ['confirmDelete'];

    public function confirmDelete($noteId)
    {
        $this->noteId = $noteId;
        $this->show = true;
    }

    public function delete()
    {
        try {
            $note = Note::findOrFail($this->noteId);
            $note->delete();
            session()->flash('success', '¡Nota eliminada correctamente!');
            $this->dispatch('noteUpdated');
        } catch (\Exception $e) {
            session()->flash('error', 'No se pudo eliminar la nota.');
        }

        $this->close();
    }

    public function close()
    {
        $this->show = false;
        $this->noteId = null;
    }

    public function render()
    {
        return view('livewire.notes.delete-confirm');
    }
}
