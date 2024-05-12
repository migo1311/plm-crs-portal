<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Designation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'eq_units',
        'plm_email_address',
        'type_load',
    ];

    public function facultyDesignation(): HasMany
    {
        return $this->hasMany(FacultyDesignation::class, 'designation_id', 'designation_id');
    }
}
