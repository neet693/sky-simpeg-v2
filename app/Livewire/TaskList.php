<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class TaskList extends Component
{
    public $tasks;
    public $isConfirmingDelete = false;
    public $taskIdToDelete = null;

    protected $listeners = [
        'taskAdded' => 'refreshTasks',
        'updateTaskOrder' => 'updateTaskOrder',
        'deleteTask' => 'deleteTask',
    ];

    public function mount()
    {
        $this->refreshTasks();
    }

    public function refreshTasks()
    {
        $this->tasks = Task::orderBy('order')->get();
    }

    public function confirmDelete($taskId)
    {
        $this->taskIdToDelete = $taskId;
        $this->isConfirmingDelete = true;
    }

    public function deleteTask($taskId)
    {
        $task = Task::find($taskId);
        if ($task) {
            $task->delete();
            $this->refreshTasks();  // Memperbarui daftar tasks setelah penghapusan
        }
    }

    public function updateTaskOrder($tasks)
    {
        foreach ($tasks as $task) {
            Task::where('id', $task['id'])->update([
                'order' => $task['order'],
                'status' => $task['status'],
            ]);
        }
        $this->refreshTasks();
    }

    public function render()
    {
        return view('livewire.task-list');
    }
}
