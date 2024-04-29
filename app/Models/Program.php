<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_title',
        'program_code',
        'major',
        'degree',
        'degree_level',
        'num_credits',
    ];
}
