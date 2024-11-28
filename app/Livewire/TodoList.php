<?php

namespace App\Livewire;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Todo;

class TodoList extends Component
{
    use LivewireAlert;

    public $todos = [];
    public $task, $status, $todo_id, $time_spent, $paused = true;
    public $updateMode = false;

    protected $listeners = [
        'updateTaskStatus',
        'startTimer',
        'stopAndSaveTimer'
    ];

    public function mount()
    {
        $this->loadTodos();
        // Asegurarnos que todas las tareas nuevas en 'doing' empiecen pausadas
        Todo::where('status', 'doing')
            ->where('is_paused', false)
            ->where('last_started_at', null)
            ->update(['is_paused' => true]);
    }

    public function render()
    {

        return view('livewire.todo-list', [
            'todos' => $this->todos,
            'paused' => $this->paused
        ]);
    }

    private function resetInputFields()
    {
        $this->task = $this->status = '';
        $this->todo_id = null;
    }

    private function loadTodos()
    {
        $this->todos = Todo::orderBy('created_at', 'desc')->get();
        $this->dispatch('timersUpdated');
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

        $this->resetInputFields();
        $this->loadTodos();
        $this->alert('success', 'Task Created Successfully.', ['position' => 'center', 'timer' => 1000]);
    }

    public function updateTaskStatus($taskId, $newStatus)
    {
        $todo = Todo::find($taskId);
        if ($todo) {
            $todo->update(['status' => $newStatus]);

            $tasksInNewStatus = Todo::where('status', $newStatus)->orderBy('order')->get();
            foreach ($tasksInNewStatus as $index => $task) {
                $task->update(['order' => $index]);
            }

            $this->loadTodos();
        }
    }

    public function updateTimeSpent($taskId, $timeSpent)
    {
        $todo = Todo::find($taskId);
        if ($todo) {
            $parts = explode(':', $timeSpent);
            $hours = isset($parts[0]) ? (int)$parts[0] : 0;
            $minutes = isset($parts[1]) ? (int)$parts[1] : 0;
            $seconds = isset($parts[2]) ? (int)$parts[2] : 0;

            $totalSeconds = ($hours * 3600) + ($minutes * 60) + $seconds;

            $todo->update(['time_spent' => $totalSeconds]);

            $this->loadTodos();

            $this->alert('success', 'Tiempo registrado con éxito', [
                'position' => 'top-end',
                'timer' => 1000,
            ]);
        }
    }

    public function startTimer($taskId)
    {
        $todo = Todo::find($taskId);
        if (!$todo || $todo->status !== 'doing') return;

        // Calculamos el tiempo transcurrido si el timer estaba corriendo
        if (!$todo->is_paused && $todo->last_started_at) {
            $todo->time_spent += now()->diffInSeconds($todo->last_started_at);
        }

        // Cambiamos el estado del timer
        $todo->is_paused = !$todo->is_paused;
        $todo->last_started_at = $todo->is_paused ? null : now();
        $todo->save();

        $message = $todo->is_paused ? 'detenido' : 'iniciado';

        $this->dispatch('timersUpdated');
        $this->js("
            Swal.fire({
                title: 'Timer {$message}',
                icon: 'success',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500
            });
        ");
    }

    public function updateTodoOrder($items)
    {
        foreach ($items as $item) {
            $todo = Todo::find($item['value']);
            if ($todo) {
                $newStatus = $item['status'];
                $oldStatus = $todo->status;

                // Si la tarea sale o entra en 'doing', asegurarnos que esté pausada
                if ($newStatus === 'doing' || $oldStatus === 'doing') {
                    // Si el timer estaba corriendo, guardar el tiempo transcurrido
                    if (!$todo->is_paused && $todo->last_started_at) {
                        $todo->time_spent += now()->diffInSeconds($todo->last_started_at);
                    }

                    $todo->is_paused = true;
                    $todo->last_started_at = null;
                }

                $todo->status = $newStatus;
                $todo->order = $item['order'];
                $todo->save();
            }
        }

        $this->dispatch('timersUpdated');
    }

    public function getTaskClass($status)
    {
        return match ($status) {
            'trash' => 'bg-dark border-1 text-light',
            'done' => 'bg-success text-light',
            'doing' => 'bg-warning text-dark',
            default => 'bg-info text-dark',
        };
    }

    public function delete()
    {
        Todo::where('status', 'trash')->delete();
        $this->loadTodos();

        $this->alert('error', __('Eliminada!'), [
            'position' => 'top-end',
            'timer' => 1000,
        ]);
    }

    public function formattedTimeSpent($seconds)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
}
