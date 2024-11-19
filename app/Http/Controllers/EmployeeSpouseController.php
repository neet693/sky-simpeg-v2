<?php

namespace App\Http\Controllers;

use App\Models\EmployeeSpouse;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeSpouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $employee_number)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string|max:255',
            'education' => 'nullable|string|max:255',
            'allowance_status' => 'nullable|string|max:255',
            'marriage_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $employee = User::where('employee_number', $employee_number)->firstOrFail();

        $employee->employeeSpouse()->create($request->all());

        return redirect()->back()->with('message', 'Education history added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeeSpouse $employeeSpouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmployeeSpouse $employeeSpouse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $employee_number, $id)
    {
        $request->validate([
            'spouse_name' => 'required|string|max:255',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string|max:255',
            'education' => 'nullable|string|max:255',
            'allowance_status' => 'nullable|string|max:255',
            'marriage_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $employeeSpouse = EmployeeSpouse::where('id', $id)->where('employee_number', $employee_number)->firstOrFail();

        $employeeSpouse->update($request->all());

        return redirect()->back()->with('message', 'Education history updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeSpouse $employeeSpouse)
    {
        //
    }
}
