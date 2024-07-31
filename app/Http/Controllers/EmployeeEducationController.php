<?php

namespace App\Http\Controllers;

use App\Models\EmployeeEducation;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeEducationController extends Controller
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

    public function store(Request $request, $employee_number)
    {
        $request->validate([
            'institution' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'field' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $employee = User::where('employee_number', $employee_number)->firstOrFail();

        $employee->educationHistories()->create($request->all());

        return redirect()->back()->with('message', 'Education history added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeeEducation $employeeEducation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmployeeEducation $employeeEducation)
    {
        //
    }

    public function update(Request $request, $employee_number, $id)
    {
        $request->validate([
            'institution' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'field' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $educationHistory = EmployeeEducation::where('id', $id)->where('employee_number', $employee_number)->firstOrFail();

        $educationHistory->update($request->all());

        return redirect()->back()->with('message', 'Education history updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeEducation $employeeEducation)
    {
        //
    }
}
