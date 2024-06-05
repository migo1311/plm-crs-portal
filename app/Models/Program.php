<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'college_id',
        'program_title',
        'program_code',
        'major',
        'degree',
        'degree_level',
        'num_credits',
    ];

    public function college()
    {
        return $this->belongsTo(College::class, 'college_id');
    }

    public function blocks()
    {
        return $this->hasMany(Block::class);
    }

    public function studentTerms()
    {
        return $this->hasMany(StudentTerm::class);
    }
}
