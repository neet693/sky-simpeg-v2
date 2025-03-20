<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan user yang login

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
        $this->tasks = Task::select('id', 'title', 'description', 'status', 'order', 'user_id')
            ->orderBy('order')
            ->get();
    }

    public function confirmDelete($taskId)
    {
        $this->taskIdToDelete = $taskId;
        $this->isConfirmingDelete = true;
    }

    public function deleteTask($taskId)
    {
        $task = Task::find($taskId);

        if (!$task) {
            session()->flash('error', 'Task tidak ditemukan.');
            return;
        }

        // Hanya pemilik task yang bisa menghapus
        if ($task->user_id !== Auth::id()) {
            session()->flash('error', 'Anda tidak memiliki izin untuk menghapus task ini.');
            return;
        }

        $task->delete();
        session()->flash('success', 'Task berhasil dihapus.');
        $this->refreshTasks();  // Memperbarui daftar tasks setelah penghapusan
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
