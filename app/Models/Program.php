<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    use HasFactory;

    protected $primaryKey = 'program_id';

    protected $fillable = [
        'college_id',
        'program_title',
        'program_code',
        'major',
        'degree',
        'degree_level',
        'num_credits',
    ];

    public function college(): BelongsTo
    {
        return $this->belongsTo(College::class, 'college_id', 'college_id');
    }

    public function block(): HasMany
    {
        return $this->hasMany(Block::class, 'program_id', 'program_id');
    }

    public function student(): HasMany
    {
        return $this->hasMany(Student::class, 'program_id', 'program_id');
    }
}
