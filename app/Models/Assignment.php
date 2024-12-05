<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'assignment_date' => 'date:Y-m-d',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i'
    ];

    public function assigner()
    {
        return $this->belongsTo(EmploymentDetail::class, 'assigner_employee_number', 'employee_number')->with('user');
    }

    public function assignee()
    {
        return $this->belongsTo(EmploymentDetail::class, 'assignee_employee_number', 'employee_number')->with('user');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
