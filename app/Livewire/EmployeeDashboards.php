<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class EmployeeDashboards extends Component
{
    public $isEmployee;
    public $colleagues;
    public $colleaguesCount;

    public function mount()
    {
        $currentUser = auth()->user();
        $this->isEmployee = $currentUser->role === 'pegawai';

        if ($this->isEmployee) {
            $unitId = $currentUser->employmentDetail->unit_id ?? null;

            $this->colleagues = User::whereHas('employmentDetail', function ($query) use ($unitId) {
                $query->where('unit_id', $unitId);
            })->get(['employee_number', 'name', 'profile_photo_path']);

            $this->colleaguesCount = $this->colleagues->count();
        }
    }
    public function render()
    {
        return view('livewire.employee-dashboards')
            ->layout('template.dashboard'); // Gunakan layout Anda
    }
}
