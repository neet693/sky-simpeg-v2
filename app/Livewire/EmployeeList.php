<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class EmployeeList extends Component
{
    public $employees;
    public $totalEmployees;

    protected $listeners = ['employeeAdded' => 'refreshEmployees'];

    public function mount()
    {
        $this->refreshEmployees();
    }

    public function refreshEmployees()
    {
        $this->employees = User::all();
        $this->totalEmployees = User::count(); // Hitung jumlah total karyawan
    }

    public function render()
    {
        return view('livewire.employee-list');
    }
}
