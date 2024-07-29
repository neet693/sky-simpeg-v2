<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentDetail extends Model
{
    use HasFactory;

    protected $fillable = ['employee_number', 'unit_id', 'tahun_masuk', 'status_kepegawaian', 'tahun_sertifikasi'];


    protected $casts = [
        'tahun_masuk' => 'date',
        'tahun_sertifikasi' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_number', 'employee_number');
    }

    /**
     * Get the unit associated with the employment detail.
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
