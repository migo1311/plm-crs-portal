<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aysem extends Model
{
    use HasFactory;

    protected $fillable = [
        'academic_year_id',
        'year',
        'semester_index',
        'semester_code',
        'date_end',
        'date_start',
    ];

    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id', 'academic_year_id');
    }

    public function blocks(): HasMany
    {
        return $this->hasMany(Block::class, 'aysem_id', 'aysem_id');
    }

    public function classes(): HasMany
    {
        return $this->hasMany(TaClass::class, 'aysem_id', 'aysem_id');
    }

    public function course(): HasMany
    {
        return $this->hasMany(Course::class, 'aysem_id', 'aysem_id');
    }
}
