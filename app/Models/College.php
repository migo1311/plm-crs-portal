<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    use HasFactory;

    protected $fillable = [
        'college_code',
        'college_name'
    ];

    public function instructor()
    {
        return $this->hasMany(Instructor::class);
    }

    public function programs()
    {
        return $this->hasMany(Program::class);
    }
}
