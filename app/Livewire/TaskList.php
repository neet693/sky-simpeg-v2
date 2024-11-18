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
        'deleteTask' => 'deleteTask',  // Tambahkan listener untuk penghapusan task
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
        // Menghapus task berdasarkan taskId yang diterima
        $task = Task::find($taskId);
        if ($task) {
            $task->delete();
            $this->tasks = $this->tasks->where('id', '!=', $taskId); // Menghapus task dari list yang sudah ada
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
