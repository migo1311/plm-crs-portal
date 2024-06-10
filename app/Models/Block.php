<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $fillable = [
        'block_id',
        'program_id',
        'aysem_id',
        'year_level',
        'section'
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function aysem()
    {
        return $this->belongsTo(Aysem::class);
    }

    public function classes()
    {
        return $this->hasMany(Classes::class);
    }

    public function studentTerms()
    {
        return $this->hasMany(StudentTerm::class);
    }
}
