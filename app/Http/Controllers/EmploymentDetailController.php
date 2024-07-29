<?php

namespace App\Http\Controllers;

use App\Models\EmploymentDetail;
use App\Models\User;
use Illuminate\Http\Request;

class EmploymentDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store dan Update the specified resource in storage.
     */
    public function storeOrUpdate(Request $request, $employee_number)
    {
        $request->validate([
            'tahun_masuk' => 'required|date',
            'unit_id' => 'required|exists:units,id',
            'status_kepegawaian' => 'required|string|max:255',
            'tahun_sertifikasi' => 'required|date',
        ]);

        $employee = User::where('employee_number', $employee_number)->firstOrFail();

        EmploymentDetail::updateOrCreate(
            ['employee_number' => $employee->employee_number],
            [
                'tahun_masuk' => $request->tahun_masuk,
                'unit_id' => $request->unit_id,
                'status_kepegawaian' => $request->status_kepegawaian,
                'tahun_sertifikasi' => $request->tahun_sertifikasi ? $request->tahun_sertifikasi : null,
            ]
        );

        return redirect()->route('employee.show', $employee_number)->with('message', 'Employment details updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmploymentDetail $employmentDetail)
    {
        //
    }
}
