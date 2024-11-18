<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TaskModal extends Component
{
    public $isOpen = false; // Untuk mengontrol visibilitas modal
    public $title;
    public $description;
    public $status;
    public $tasks = []; // Menyimpan daftar task

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|string',
    ];

    protected $listeners = ['taskAdded' => 'refreshTasks'];

    // Method untuk memperbarui daftar task
    public function refreshTasks()
    {
        $this->tasks = Task::latest()->get(); // Ambil semua task terbaru
    }

    public function open()
    {
        $this->isOpen = true;
    }

    public function close()
    {
        $this->reset(); // Reset semua properti
        $this->isOpen = false;
    }

    public function saveTask()
    {
        $this->validate();

        // Hitung order berdasarkan jumlah task dengan status yang sama
        $order = Task::where('status', $this->status)->count();

        // Simpan task baru ke database
        Task::create([
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'order' => $order,
            'user_id' => Auth::id(),
        ]);

        // Emit event untuk parent menggunakan dispatch
        $this->dispatch('taskAdded');


        $this->close(); // Tutup modal setelah berhasil menambah task
    }


    public function render()
    {
        return view('livewire.task-modal');
    }
}
