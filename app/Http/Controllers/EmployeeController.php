<?php

namespace App\Http\Controllers;

use App\Models\unit;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalEmployees = User::count();
        return view('employees.index', compact('totalEmployees'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($employee_number)
    {
        $employee = User::where('employee_number', $employee_number)
            ->with('employeeCertificates')
            ->firstOrFail();
        $units = unit::all();
        $users = User::all();
        return view('employees.show', compact('employee', 'units', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
