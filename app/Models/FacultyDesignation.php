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
        'schedule',
        'update_by',
    ];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
}
