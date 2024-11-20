<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSpouse extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = ['birth_date' => 'date', 'marriage_date' => 'date'];

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_number', 'employee_number');
    }

    public function getAgeAttribute()
    {
        return $this->birth_date ? Carbon::parse($this->birth_date)->age : null;
    }
}
