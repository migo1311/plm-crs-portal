<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultyDesignation extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor_id',
        'designation_id',
        'description',
        'schedule',
        'update_by',
        'is_active',
    ];
}
