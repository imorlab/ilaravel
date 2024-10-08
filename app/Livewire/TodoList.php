<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Todo;

class TodoList extends Component
{
    public $todos = [];
    public $task, $status, $todo_id;
    public $updateMode = false;
    protected $listeners = ['updateTaskOrder'];

    public function render()
    {
        $this->todos = Todo::latest()->get();
        return view('livewire.todo-list');
    }

    private function resetInputFields()
    {
        $this->task = '';
        $this->status = '';
        $this->todo_id = null; // Reiniciar el ID de la tarea
    }

    public function store()
    {
        $validatedData = $this->validate([
            'task' => 'required|string|max:255',
        ]);

        Todo::create($validatedData + ['status' => 'open']); // Establecer el estado inicial

        session()->flash('message', 'Task Created Successfully.');

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $todo = Todo::findOrFail($id);
        $this->todo_id = $id;
        $this->task = $todo->task;

        $this->updateMode = true;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $validatedData = $this->validate([
            'task' => 'required|string|max:255',
        ]);

        $todo = Todo::findOrFail($this->todo_id);
        $todo->update($validatedData);

        session()->flash('message', 'Task Updated Successfully.');

        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Todo::find($id)->delete();
        session()->flash('message', 'Task Deleted Successfully.');
    }

    public function markAsDone(Todo $todo)
    {
        $todo->status = 'done';
        $todo->save();
        $this->resetInputFields();
    }

    public function updateTaskOrder($taskId, $newStatus)
    {
        $todo = Todo::find($taskId);

        if ($todo) {
            // Actualiza el estado de la tarea según su nueva posición
            $todo->status = $newStatus; // 'open', 'doing', 'done', 'trash'
            $todo->save();
            session()->flash('message', 'Task status updated to ' . $newStatus);
        }

        $this->alert('success', __('¡Hecho!'), [
            'position' => 'center',
            'timer' => 1000,
        ]);
    }

}
