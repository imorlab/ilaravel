<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Todo;
use Livewire\Attributes\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;

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
        // Asegurarnos que todas las tareas en 'doing' empiecen pausadas
        Todo::where('status', 'doing')
            ->where('is_paused', false)
            ->update([
                'is_paused' => true,
                'last_started_at' => null
            ]);

        $this->loadTodos();
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
        $this->alert('success', 'Task Created Successfully.', ['position' => 'top-end', 'timer' => 1000]);
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

    public function startTimer($taskId)
    {
        $todo = Todo::find($taskId);
        if (!$todo || $todo->status !== 'doing') {
            return;
        }

        // Si el timer estaba corriendo, calcular el tiempo transcurrido
        if (!$todo->is_paused && $todo->last_started_at) {
            $todo->time_spent += now()->diffInSeconds($todo->last_started_at);
        }

        // Cambiar el estado del timer
        $todo->is_paused = !$todo->is_paused;
        $todo->last_started_at = $todo->is_paused ? null : now();
        $todo->save();

        // Emitir evento para actualizar UI
        $this->dispatch('taskStatusUpdated', [
            'id' => $todo->id,
            'status' => $todo->status
        ]);
        $this->dispatch('timersUpdated');
    }

    public function updateTimeSpent($taskId, $timeSpent)
    {
        try {
            $todo = Todo::find($taskId);
            if (!$todo) {
                \Log::error('Tarea no encontrada: ' . $taskId);
                return false;
            }

            // Convertir a segundos si es un string con formato
            if (is_string($timeSpent) && strpos($timeSpent, ':') !== false) {
                $parts = explode(':', $timeSpent);
                $hours = isset($parts[0]) ? (int)$parts[0] : 0;
                $minutes = isset($parts[1]) ? (int)$parts[1] : 0;
                $seconds = isset($parts[2]) ? (int)$parts[2] : 0;
                $timeSpent = ($hours * 3600) + ($minutes * 60) + $seconds;
            } else {
                $timeSpent = (int)$timeSpent;
            }

            // Solo actualizar si el estado es correcto
            if ($todo->status === 'doing' || $todo->status === 'done') {
                $todo->time_spent = $timeSpent;
                $saved = $todo->save();

                if (!$saved) {
                    \Log::error('Error al actualizar el tiempo en la base de datos');
                    return false;
                }

                \Log::info('Tiempo actualizado para tarea ' . $taskId . ': ' . $timeSpent . ' segundos');
                return true;
            }

            return false;
        } catch (\Exception $e) {
            \Log::error('Error updating time spent: ' . $e->getMessage());
            return false;
        }
    }

    public function updateTodoOrder($items)
    {
        foreach ($items as $item) {
            $todo = Todo::find($item['value']);
            if ($todo) {
                $newStatus = $item['status'];
                $oldStatus = $todo->status;

                // Si la tarea está en 'doing' y tiene el timer activo
                if ($oldStatus === 'doing' && !$todo->is_paused && $todo->last_started_at) {
                    // Guardar el tiempo transcurrido
                    $todo->time_spent += now()->diffInSeconds($todo->last_started_at);
                    $todo->is_paused = true;
                    $todo->last_started_at = null;
                }

                // Si la tarea se mueve a 'doing', asegurarse de que esté pausada
                if ($newStatus === 'doing') {
                    $todo->is_paused = true;
                    $todo->last_started_at = null;
                }

                $todo->status = $newStatus;
                $todo->order = $item['order'];
                $todo->save();

                // Emitir evento para actualizar UI
                $this->dispatch('taskStatusUpdated', [
                    'id' => $todo->id,
                    'status' => $newStatus
                ]);
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

    public function formatTime($seconds)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

    public function stopAndSaveTimer($taskId, $timeSpent)
    {
        try {
            \Log::info('Guardando tiempo para tarea ' . $taskId . ': ' . $timeSpent . ' segundos');
            
            $todo = Todo::find($taskId);
            if (!$todo) {
                $this->alert('error', 'Tarea no encontrada');
                return false;
            }

            // Actualizar el estado del timer
            $todo->is_paused = true;
            $todo->last_started_at = null;
            $todo->time_spent = (int)$timeSpent;
            $saved = $todo->save();

            if (!$saved) {
                \Log::error('Error al guardar el tiempo en la base de datos');
                $this->alert('error', 'Error al guardar el tiempo', [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                ]);
                return false;
            }

            // Emitir evento para actualizar UI
            $this->dispatch('taskStatusUpdated', [
                'id' => $todo->id,
                'status' => $todo->status
            ]);
            $this->dispatch('timersUpdated');

            // Mostrar alerta de éxito
            $this->alert('success', 'Tiempo guardado: ' . $this->formatTime($timeSpent), [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);

            \Log::info('Tiempo guardado correctamente');
            return true;

        } catch (\Exception $e) {
            \Log::error('Error al guardar tiempo: ' . $e->getMessage());
            $this->alert('error', 'Error al guardar el tiempo: ' . $e->getMessage(), [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);
            return false;
        }
    }
}
