<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Todo;

class TodoList extends Component
{

    public $todos, $task, $status, $todo_id;
    public $updateMode = false;

    public function render()
    {
        $this->todos = Todo::latest()->get();
        return view('livewire.todo-list');
    }

    private function resetInputFields(){
        $this->task = '';
        $this->status = '';
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'task' => 'required',
        ]);

        Todo::create($validatedDate);

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
        $validatedDate = $this->validate([
            'task' => 'required',
        ]);

        $todo = Todo::findOrFail($this->todo_id);
        $todo->update($validatedDate);

        session()->flash('message', 'Task Updated Successfully.');

        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Todo::find($id)->delete();
        session()->flash('message', 'Task Deleted Successfully.');
    }

    function markAsDone(Todo $todo){
        $todo->status = 'done';
        $todo->save();
        $this->resetInputFields();
    }

}
