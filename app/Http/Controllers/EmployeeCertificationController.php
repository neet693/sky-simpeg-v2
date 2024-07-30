<?php

namespace App\Http\Controllers;

use App\Models\EmployeeCertification;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeCertificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function store(Request $request, $employee_number)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'organizer' => 'required|string|max:255',
            'issued_date' => 'required|date',
            'expired_date' => 'nullable|date|after_or_equal:issued_date',
            'credential_number' => 'required|string|max:255',
            'certificate_url' => 'nullable|url',
            'media' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $employee = User::where('employee_number', $employee_number)->firstOrFail();

        $data = [
            'employee_number' => $employee->employee_number,
            'name' => $request->name,
            'organizer' => $request->organizer,
            'issued_date' => $request->issued_date,
            'expired_date' => $request->expired_date,
            'credential_number' => $request->credential_number,
            'certificate_url' => $request->certificate_url,
        ];

        if ($request->hasFile('media')) {
            $mediaPath = $request->file('media')->storeAs(
                'certifications',
                uniqid() . '.' . $request->file('media')->extension(),
                'public'
            );
            $data['media'] = $mediaPath;
        }

        EmployeeCertification::create($data);

        return redirect()->back()->with('message', 'Certification added successfully.');
    }

    public function update(Request $request, $employee_number, $certificate_name)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'organizer' => 'required|string|max:255',
            'issued_date' => 'required|date',
            'expired_date' => 'nullable|date|after_or_equal:issued_date',
            'credential_number' => 'required|string|max:255',
            'certificate_url' => 'nullable|url',
            'media' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Temukan karyawan berdasarkan employee_number
        $employee = User::where('employee_number', $employee_number)->firstOrFail();

        // Temukan sertifikat berdasarkan nama dan karyawan
        $certificate = $employee->employeeCertificates()->where('name', $certificate_name)->firstOrFail();

        $data = [
            'name' => $request->name,
            'organizer' => $request->organizer,
            'issued_date' => $request->issued_date,
            'expired_date' => $request->expired_date,
            'credential_number' => $request->credential_number,
            'certificate_url' => $request->certificate_url,
        ];

        if ($request->hasFile('media')) {
            $mediaPath = $request->file('media')->storeAs(
                'certifications',
                uniqid() . '.' . $request->file('media')->extension(),
                'public'
            );
            $data['media'] = $mediaPath;
        }

        // Update sertifikat
        $certificate->update($data);

        return redirect()->route('employee.show', $employee->employee_number)
            ->with('message', 'Certification updated successfully.');
    }



    public function storeOrUpdate(Request $request, $employee_number)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'organizer' => 'required|string|max:255',
            'issued_date' => 'required|date',
            'expired_date' => 'nullable|date|after_or_equal:issued_date',
            'credential_number' => 'required|string|max:255',
            'certificate_url' => 'nullable|url',
            'media' => 'nullable|image|',
        ]);

        $employee = User::where('employee_number', $employee_number)->firstOrFail();

        $data = [
            'name' => $request->name,
            'organizer' => $request->organizer,
            'issued_date' => $request->issued_date,
            'expired_date' => $request->expired_date,
            'credential_number' => $request->credential_number,
            'certificate_url' => $request->certificate_url,
        ];

        if ($request->hasFile('media')) {
            $mediaPath = $request->file('media')->store('certifications', 'public');
            $data['media'] = $mediaPath;
        }

        EmployeeCertification::updateOrCreate(
            ['employee_number' => $employee->employee_number],
            $data
        );

        return redirect()->route('employee.show', $employee_number)->with('message', 'Employment details updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeCertification $employeeCertification)
    {
        //
    }
}
