<?php

namespace App\Livewire;

use App\Models\EmploymentDetail;
use Livewire\Component;
use App\Models\Meeting;
use App\Models\unit;
use App\Models\User;

class MeetingForm extends Component
{
    public $meetings; // List of meetings
    public $isOpen = false;

    public $title;
    public $meeting_date;
    public $start_time;
    public $end_time;
    public $meeting_location;
    public $meeting_result;

    public $units; // Daftar unit (diambil dari employmentDetails)
    public $selectedUnit; // Unit yang dipilih

    protected $rules = [
        'title' => 'required|string|max:255',
        'meeting_date' => 'required|date',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i|after:start_time',
        'meeting_location' => 'required|string|max:255',
        'meeting_result' => 'nullable|string',
    ];

    public function open()
    {
        $this->isOpen = true;
    }

    public function close()
    {
        $this->resetForm();
        $this->isOpen = false;
    }

    public function mount()
    {
        // Ambil unit dari tabel units
        $this->units = unit::all();
    }

    public function saveMeeting()
    {
        $this->validate();

        // Save the meeting
        $meeting = Meeting::create([
            'title' => $this->title,
            'meeting_date' => $this->meeting_date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'meeting_location' => $this->meeting_location,
            'meeting_result' => $this->meeting_result,
        ]);

        // Attach selected units to the meeting
        if ($this->selectedUnit) {
            $meeting->units()->attach($this->selectedUnit); // Multiple units
        }

        // Reload meetings
        $this->meetings = Meeting::all();

        session()->flash('message', 'Meeting successfully created.');
        $this->resetForm();
    }


    private function resetForm()
    {
        $this->title = null;
        $this->meeting_date = null;
        $this->start_time = null;
        $this->end_time = null;
        $this->meeting_location = null;
        $this->meeting_result = null;
    }


    public function render()
    {
        return view('livewire.meeting-form');
    }
}
