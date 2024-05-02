<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $fillable = [
        'block_id',
        'year_level',
        'section',
        'program_id',
        'aysem_id',
        'block_name',
        'block_code',
        'slots',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'program_id');
    }

    public function aysem()
    {
        return $this->belongsTo(Aysem::class, 'aysem_id', 'aysem_id');
    }

}
