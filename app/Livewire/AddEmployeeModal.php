<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AddEmployeeModal extends Component
{
    public $isOpen = false;
    public $name, $email, $phone_number, $employee_number, $birth_date, $address, $gender, $password;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users',
        'phone_number' => 'required|string|max:255',
        'employee_number' => 'required|string|max:255|unique:users',
        'birth_date' => 'required|date',
        'gender' => 'required|in:Laki - Laki,Perempuan',
        'address' => 'required|string|max:255',
        'password' => 'required|string|min:8',
    ];

    protected $listeners = [
        'openAddEmployeeModal' => 'open',
        'closeAddEmployeeModal' => 'close',
    ];

    public function open()
    {
        $this->isOpen = true;
    }

    public function close()
    {
        $this->reset(['name', 'email', 'phone_number', 'employee_number', 'birth_date', 'address', 'gender', 'password']);
        $this->isOpen = false;
    }

    public function addEmployee()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'employee_number' => $this->employee_number,
            'birth_date' => $this->birth_date,
            'address' => $this->address,
            'gender' => $this->gender,
            'password' => Hash::make($this->password),
        ]);

        session()->flash('message', 'Employee added successfully.');
        $this->reset();
        $this->close();
        $this->dispatch('employeeAdded'); // Emit diganti ke Dispatch
    }

    public function render()
    {
        return view('livewire.add-employee-modal');
    }
}
