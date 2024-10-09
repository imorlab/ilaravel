<?php

namespace App\Livewire;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use App\Models\Todo;

class TodoList extends Component
{
    use LivewireAlert;

    public $todos = [];
    public $task, $status, $todo_id;
    public $updateMode = false;
    protected $listeners = ['updateTaskOrder'];

    public function mount()
    {
        $this->todos = Todo::orderBy('status')->orderBy('order')->get();
        return view('livewire.todo-list', ['todos' => $this->todos]);
    }

    public function render()
    {
        $this->todos = Todo::orderBy('status')->orderBy('order')->get();
        return view('livewire.todo-list');
    }

    private function resetInputFields()
    {
        $this->task = $this->status = '';
        $this->todo_id = null;
    }

    public function store()
    {
        $this->validate([
            'task' => 'required|string|max:255',
        ]);

        Todo::create([
            'task' => $this->task,
            'status' => 'open'
        ]);

        session()->flash('message', 'Task Created Successfully.');
        $this->resetInputFields();
    }


    public function updateTaskOrder($data)
    {

        $newOrder = [];
        foreach ($data as $item) {
            $newOrder[] = $item['value'];
        }

        // Evitar duplicados (iOS)
        $newOrder = array_unique($newOrder);

        foreach ($newOrder as $index => $todoId) {
            $todo = Todo::find($todoId);

            if ($todo) {
                $todo->update([
                    'order' => $index,
                ]);
            }
        }

        $this->mount();

        $this->alert('success', __('¡Hecho!'), [
            'position' => 'center',
            'timer' => 1000,
        ]);
    }

    public function getTaskClass($status)
    {
        return match ($status) {
            'trash' => 'bg-danger text-light',
            'done' => 'bg-success text-light',
            'doing' => 'bg-warning text-dark',
            default => 'bg-info text-dark',
        };
    }

    public function delete()
    {

        $todo = Todo::where('status', 'trash')->first();
        if ($todo){
            $todo->delete();
        }

        $this->mount();

        $this->alert('error', __('Eliminada!'), [
            'position' => 'center',
            'timer' => 1000,
        ]);

    }



}
