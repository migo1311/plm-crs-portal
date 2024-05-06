<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_code',
        'subject_title',
        'course_number',
        'units',
        'class_code',
        'aysem_id'
    ];

    public function aysem():BelongsTo
    {
        return $this->belongsTo(Aysem::class, 'aysem_id', 'aysem_id');
    }

    public function classes(): HasMany
    {
        return $this->hasMany(TaClass::class, 'course_id', 'course_id');
    }
}
