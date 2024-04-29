<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $fillable = [
        'year_level',
        'section',
        'program_id',
        'aysem_id',
        'block_name',
        'block_code',
        'slots',
    ];
}
