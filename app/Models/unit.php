<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unit extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function employmentDetails()
    {
        return $this->hasMany(EmploymentDetail::class, 'unit_id');
    }

    public function meetings()
    {
        return $this->belongsToMany(Meeting::class, 'meeting_unit');
    }
}
