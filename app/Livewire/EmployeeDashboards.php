<?php

namespace App\Livewire;

use App\Models\Assignment;
use App\Models\User;
use Livewire\Component;

class EmployeeDashboards extends Component
{
    public $isEmployee;
    public $isKepala;
    public $colleagues;
    public $colleaguesCount;
    public $assignments;

    public function mount()
    {
        $currentUser = auth()->user(); // Mendapatkan data pengguna yang sedang login

        // Menentukan apakah pengguna adalah 'pegawai' atau 'kepala'
        $this->isEmployee = $currentUser->role === 'pegawai';
        $this->isKepala = $currentUser->role === 'kepala';

        $unitId = $currentUser->employmentDetail->unit_id ?? null; // Mendapatkan unit pengguna

        if ($this->isEmployee) {
            // Pegawai hanya melihat tugas yang ditugaskan kepada mereka
            $employeeNumber = $currentUser->employmentDetail->employee_number;

            // Ambil tugas yang ditugaskan kepada pegawai ini
            $this->assignments = Assignment::where('assignee_employee_number', $employeeNumber)
                ->orderBy('assignment_date', 'asc')
                ->get();

            // Ambil rekan kerja dalam unit yang sama (jika diperlukan)
            $this->colleagues = User::whereHas('employmentDetail', function ($query) use ($unitId) {
                $query->where('unit_id', $unitId);
            })->get(['employee_number', 'name', 'profile_photo_path']);

            $this->colleaguesCount = $this->colleagues->count();
        } elseif ($this->isKepala) {
            $this->colleagues = User::whereHas('employmentDetail', function ($query) use ($unitId) {
                $query->where('unit_id', $unitId);
            })->get(['employee_number', 'name', 'profile_photo_path']);
            $this->colleaguesCount = $this->colleagues->count();
            // Kepala hanya melihat tugas di unit mereka
            $this->assignments = Assignment::where('unit_id', $unitId)
                ->orderBy('assignment_date', 'asc')
                ->get();
        } else {
            // Jika bukan pegawai atau kepala, misalnya admin
            // Admin dapat melihat semua tugas
            $this->assignments = Assignment::orderBy('assignment_date', 'asc')
                ->get();
        }
    }


    public function render()
    {
        return view('livewire.employee-dashboards')
            ->layout('template.dashboard'); // Gunakan layout Anda
    }
}
