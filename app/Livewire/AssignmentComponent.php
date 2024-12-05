<?php

namespace App\Livewire;

use App\Models\Assignment;
use App\Models\EmploymentDetail;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AssignmentComponent extends Component
{
    public $assignments = [];
    public $units = [];
    public $employees = [];
    public $assigner_employee_number;
    public $assignee_employee_number;
    public $unit_id;
    public $assignment_date;
    public $start_time;
    public $end_time;
    public $title;
    public $description;
    public $progress = 'Ditugaskan';
    public $kendala;
    public $selectedAssignmentId = null;
    public $isOpen = false; // Track modal visibility

    public function mount()
    {
        if (Auth::user()->role === 'admin') {
            $this->units = Unit::all();
            $this->employees = EmploymentDetail::with('user')->get();
        } else {
            $this->units = [Auth::user()->employmentDetail->unit];
            $this->employees = EmploymentDetail::with('user')
                ->where('unit_id', Auth::user()->employmentDetail->unit_id)
                ->get();

            $this->assigner_employee_number = Auth::user()->employmentDetail->employee_number;
            $this->unit_id = Auth::user()->employmentDetail->unit_id;
        }

        $this->refreshAssignments();
    }

    public function refreshAssignments()
    {
        $query = Assignment::query();

        if (Auth::user()->role !== 'admin') {
            $unitId = Auth::user()->employmentDetail->unit_id;
            $query->where('unit_id', $unitId);
        }

        $this->assignments = $query->with(['assigner.user', 'assignee.user', 'unit'])->get();
    }

    public function open()
    {
        $this->isOpen = true; // Show modal
    }

    public function close()
    {
        $this->isOpen = false; // Hide modal
    }

    public function saveAssignment()
    {
        $this->validate([
            'assignee_employee_number' => 'required|exists:employment_details,employee_number',
            'unit_id' => 'required|exists:units,id',
            'assignment_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'progress' => 'required|string',
            'kendala' => 'nullable|string',
        ]);

        if (Auth::user()->role !== 'admin') {
            $assignee = EmploymentDetail::where('employee_number', $this->assignee_employee_number)->first();
            if (!$assignee || $assignee->unit_id !== Auth::user()->employmentDetail->unit_id) {
                session()->flash('error', 'Penerima tugas harus dari unit yang sama.');
                return;
            }
        }

        $data = $this->getInputData();

        if ($this->selectedAssignmentId) {
            Assignment::findOrFail($this->selectedAssignmentId)->update($data);
        } else {
            Assignment::create($data);
        }

        $this->resetForm();
        $this->close(); // Close the modal after save
        $this->refreshAssignments();
    }

    private function getInputData()
    {
        return [
            'assigner_employee_number' => $this->assigner_employee_number,
            'assignee_employee_number' => $this->assignee_employee_number,
            'unit_id' => $this->unit_id,
            'assignment_date' => $this->assignment_date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'title' => $this->title,
            'description' => $this->description,
            'progress' => $this->progress,
            'kendala' => $this->kendala,
        ];
    }

    public function resetForm()
    {
        $this->selectedAssignmentId = null;
        $this->assigner_employee_number = null;
        $this->assignee_employee_number = null;
        $this->unit_id = null;
        $this->assignment_date = null;
        $this->start_time = null;
        $this->end_time = null;
        $this->title = null;
        $this->description = null;
        $this->progress = 'Ditugaskan';
        $this->kendala = null;
    }

    public function render()
    {
        return view('livewire.assignment-component');
    }
}
