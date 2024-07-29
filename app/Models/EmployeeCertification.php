<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeCertification extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'organizer', 'issued_date', 'expired_date', 'credential_number', 'certificate_url', 'media', 'employee_number'];

    protected $casts = ['issued_date' => 'date', 'expired_date' => 'date'];

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_number', 'employee_number');
    }
}
