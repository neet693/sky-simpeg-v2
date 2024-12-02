<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
        $currentUser = Auth::user();

        if ($currentUser->role === 'admin' || $currentUser->role === 'HRD') {
            // Admin atau HRD dapat melihat semua karyawan
            $this->employees = User::with('employmentDetail')->get();
            $this->totalEmployees = User::count();
        } elseif ($currentUser->employmentDetail?->unit_id) {
            // Hanya tampilkan karyawan dari unit yang sama
            $this->employees = User::whereHas('employmentDetail', function ($query) use ($currentUser) {
                $query->where('unit_id', $currentUser->employmentDetail->unit_id);
            })->where('id', '!=', $currentUser->id) // Kecualikan pengguna login
                ->with('employmentDetail') // Pastikan relasi di-load
                ->get();

            $this->totalEmployees = $this->employees->count();
        } else {
            // Pengguna tanpa unit, daftar kosong
            $this->employees = collect();
            $this->totalEmployees = 0;
        }
    }

    public function render()
    {
        return view('livewire.employee-list');
    }
}
