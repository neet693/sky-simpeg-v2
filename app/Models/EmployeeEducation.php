<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeEducation extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_number',
        'institution',
        'degree',
        'field',
        'start_date',
        'end_date'
    ];

    protected $casts = ['start_date' => 'date', 'end_date' => 'date'];

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_number', 'employee_number');
    }
}
