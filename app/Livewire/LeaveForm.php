<?php

namespace App\Livewire;

use App\Models\Leave;
use Livewire\Component;

class LeaveForm extends Component
{
    public $isOpen = false;
    public $tanggal_mulai;
    public $tanggal_selesai;
    public $keterangan;

    public function open()
    {
        $this->isOpen = true;
    }

    public function close()
    {
        $this->reset(['tanggal_mulai', 'tanggal_selesai', 'keterangan']);
        $this->isOpen = false;
    }

    public function submitLeave()
    {
        $user = auth()->user();

        $this->validate([
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'keterangan' => 'required|string|max:500',
        ]);

        Leave::create([
            'user_id' => $user->id,
            'status_kepegawaian' => $user->employmentDetail->status_kepegawaian ?? 'N/A',
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_selesai' => $this->tanggal_selesai,
            'keterangan' => $this->keterangan,
        ]);
        $this->close();

        session()->flash('message', 'Pengajuan izin berhasil dikirim.');
        return redirect()->route('leaves.index');
    }

    public function render()
    {
        return view('livewire.leave-form');
    }
}
