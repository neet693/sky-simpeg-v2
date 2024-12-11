<?php

namespace App\Livewire;

use App\Models\Meeting;
use Livewire\Component;

class MeetingList extends Component
{

    public $meetings; // List of meetings
    public $selectedMeeting; // Selected meeting details
    public $isModalOpen = false; // Control modal visibility

    public function mount()
    {
        // Load all meetings when the component is initialized
        $this->meetings = Meeting::all();
    }

    public function viewDetails($meetingID)
    {
        // Retrieve and store selected meeting
        $this->selectedMeeting = Meeting::findOrFail($meetingID);
        $this->isModalOpen = true; // Open the modal
    }

    public function render()
    {
        return view('livewire.meeting-list');
    }
}
