<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'eq_units',
        'plm_email_address',
        'type_load'
    ];

    public function facultyDesignations()
    {
        return $this->hasMany(FacultyDesignation::class);
    }
}
