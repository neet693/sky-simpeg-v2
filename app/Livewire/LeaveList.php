<?php

namespace App\Livewire;

use App\Models\Leave;
use Livewire\Component;

class LeaveList extends Component
{
    public $leaves;
    public $selectedLeave;  // Menyimpan data izin yang dipilih untuk detail
    public $isModalOpen = false;  // Status untuk modal (terbuka/tertutup)


    public function mount()
    {
        $user = auth()->user();

        if ($user->role === 'kepala') {
            // Kepala melihat permohonan izin unitnya
            $unitId = $user->employmentDetail->unit_id;
            $this->leaves = Leave::whereHas('user.employmentDetail', function ($query) use ($unitId) {
                $query->where('unit_id', $unitId);
            })->orderBy('created_at', 'desc')->get();
        } else {
            // Pegawai melihat permohonan izin mereka sendiri
            $this->leaves = Leave::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }
    }

    public function viewDetails($leaveId)
    {
        $this->selectedLeave = Leave::findOrFail($leaveId);  // Mengambil data leave berdasarkan ID
        $this->isModalOpen = true;  // Membuka modal
    }

    // Fungsi untuk menutup modal
    public function closeModal()
    {
        $this->isModalOpen = false;  // Menutup modal
    }

    public function approve($leaveId)
    {
        $leave = Leave::findOrFail($leaveId);
        $user = auth()->user();
        $approver_id = $user->id;
        $leave->update([
            'status_permohonan' => 'Disetujui',
            'approver_id' => $approver_id
        ]);
        session()->flash('message', 'Permohonan izin disetujui.');
        return redirect()->route('leaves.index');
    }

    public function reject($leaveId)
    {
        $leave = Leave::findOrFail($leaveId);
        $user = auth()->user();
        $approver_id = $user->id;
        $leave->update([
            'status_permohonan' => 'Ditolak',
            'approver_id' => $approver_id
        ]);
        session()->flash('message', 'Permohonan izin ditolak.');
        return redirect()->route('leaves.index');
    }

    public function render()
    {
        return view('livewire.leave-list');
    }
}
