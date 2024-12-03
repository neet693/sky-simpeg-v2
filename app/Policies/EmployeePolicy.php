<?php

namespace App\Policies;

use App\Models\User;

class EmployeePolicy
{
    /**
     * Menambahkan atau mengedit profil hanya jika user adalah pemilik atau memiliki role admin atau kepala.
     */
    public function addorEditProfile(User $user, $employee_number)
    {
        // Ambil data EmploymentDetail pegawai
        $employeeDetail = $user->employmentDetail;

        // Jika user adalah admin atau kepala, selalu boleh akses
        if ($user->role === 'admin' || $user->role === 'kepala') {
            return true;
        }

        // Jika user adalah pemilik employee_number, dia boleh mengakses
        return $employeeDetail && $employeeDetail->employee_number === $employee_number;
    }
}
