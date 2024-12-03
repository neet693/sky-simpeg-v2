<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class EmployeeList extends Component
{
    public $employees;
    public $totalEmployees;
    public $unitsWithCounts = []; // Untuk menyimpan jumlah pegawai per unit
    public $selectedUnit = null; // Untuk sorting berdasarkan unit
    public $isAdmin = false;
    public $isKepala = false;

    protected $listeners = ['employeeAdded' => 'refreshEmployees'];

    public function mount()
    {
        $this->checkUserRole();
        $this->refreshEmployees();
    }

    public function checkUserRole()
    {
        // Cek apakah user adalah admin atau kepala
        $user = Auth::user();

        if ($user) {
            if ($user->role === 'admin') {
                $this->isAdmin = true;
            } elseif ($user->role === 'kepala') {
                $this->isKepala = true;
            }
        }
    }

    public function refreshEmployees()
    {
        // Hitung total pegawai, kecuali admin
        $this->totalEmployees = User::where('role', '!=', 'admin')->count();

        // Hitung jumlah pegawai per unit, kecuali admin
        $this->unitsWithCounts = User::where('role', '!=', 'admin')
            ->with('employmentDetail.unit')
            ->get()
            ->groupBy('employmentDetail.unit.name')
            ->map(fn($group) => $group->count())
            ->toArray();

        // Ambil pegawai, filter berdasarkan unit jika dipilih, kecuali admin
        $query = User::query()->with('employmentDetail.unit')
            ->where('role', '!=', 'admin');  // Menyaring role admin

        if ($this->selectedUnit) {
            $query->whereHas('employmentDetail.unit', function ($query) {
                $query->where('name', $this->selectedUnit);
            });
        }

        $this->employees = $query->orderBy('name')->get();
    }

    public function filterByUnit($unitName)
    {
        $this->selectedUnit = $unitName;
        $this->refreshEmployees();
    }

    public function render()
    {
        return view('livewire.employee-list');
    }
}
