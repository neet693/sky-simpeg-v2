<?php

namespace App\Livewire;

use App\Models\Assignment;
use App\Models\EmploymentDetail;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class AssignmentComponent extends Component
{
    use WithPagination;

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
    public $isOpen = false;
    public $isViewMode = false;
    public $isEditMode = false;

    public $isOpenKendalaModal = false; // Menambahkan properti untuk mengontrol status modal
    public $assignmentIdForKendala;
    public $statusForKendala;

    //Sorting

    public $search = '';
    public $sortColumn = 'progress'; // Default sorting field
    public $sortDirection = 'asc';

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

        $this->isEditMode = false;
        $this->isViewMode = false;
    }

    //Edit Form
    public function edit($assignmentId)
    {
        $this->isEditMode = true;
        $this->isViewMode = false; // Nonaktifkan view-only mode

        $assignment = Assignment::findOrFail($assignmentId);
        $this->selectedAssignmentId = $assignment->id;
        $this->assigner_employee_number = $assignment->assigner_employee_number;
        $this->assignee_employee_number = $assignment->assignee_employee_number;
        $this->unit_id = $assignment->unit_id;
        $this->assignment_date = $assignment->assignment_date->format('Y-m-d');
        $this->start_time = $assignment->start_time->format('H:i');
        $this->end_time = $assignment->end_time->format('H:i');
        $this->title = $assignment->title;
        $this->description = $assignment->description;
        $this->progress = $assignment->progress;

        $this->open();
    }

    public function viewDetail($assignmentId)
    {
        $this->isEditMode = false;
        $this->isViewMode = true;

        $assignment = Assignment::with(['assigner.user', 'assignee.user', 'unit'])->findOrFail($assignmentId);
        $this->assigner_employee_number = $assignment->assigner_employee_number;
        $this->assignee_employee_number = $assignment->assignee_employee_number;
        $this->title = $assignment->title;
        $this->description = $assignment->description;
        $this->assignment_date = $assignment->assignment_date->format('Y-m-d');
        $this->start_time = $assignment->start_time->format('H:i');
        $this->end_time = $assignment->end_time->format('H:i');
        $this->progress = $assignment->progress;

        $this->open();
    }



    //Delete
    public function delete($assignmentId)
    {
        if (!in_array(Auth::user()->role, ['admin', 'kepala'])) {
            abort(403, 'Akses ditolak.');
        }
        $assignment = Assignment::findOrFail($assignmentId);
        $assignment->delete();
        session()->flash('message', 'Tugas berhasil dihapus.');
    }

    public function setStatusSelesai($assignmentId)
    {
        // Menemukan assignment berdasarkan ID
        $assignment = Assignment::find($assignmentId);

        // Mengubah status menjadi "Selesai"
        $assignment->progress = 'Selesai';
        $assignment->save();

        // Memberi feedback setelah perubahan status berhasil
        session()->flash('message', 'Tugas berhasil diselesaikan.');
    }

    public function openPendingModal($assignmentId)
    {
        $this->assignmentIdForKendala = $assignmentId;
        $this->statusForKendala = 'Pending';
        $this->isOpenKendalaModal = true;
    }

    public function closePendingModal()
    {
        $this->isOpenKendalaModal = false; // Menutup modal
    }

    // Method untuk submit kendala dan update status
    public function submitPending()
    {
        // Validasi kendala
        $this->validate([
            'kendala' => 'required|string',
        ]);

        // Menemukan assignment berdasarkan ID
        $assignment = Assignment::findOrFail($this->assignmentIdForKendala);

        // Mengubah status menjadi "Pending" dan menyimpan kendala
        $assignment->progress = 'Pending';
        $assignment->kendala = $this->kendala;
        $assignment->save();

        // Menutup modal dan refresh data tugas
        $this->closePendingModal();


        // Memberi feedback setelah perubahan status berhasil
        session()->flash('message', 'Tugas berhasil diubah menjadi Pending.');
    }


    // Hanya reset halaman saat search berubah, agar sorting tidak terganggu
    public function searchAssignments()
    {
        $this->resetPage(); // Reset pagination saat search
    }


    // Fungsi sorting, tidak mereset search agar tidak terganggu
    public function sortBy($column)
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $assignments = Assignment::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', "%{$this->search}%");
            })
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate(10);
        return view('livewire.assignment-component', compact('assignments'));
    }
}
