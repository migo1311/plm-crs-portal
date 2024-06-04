<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gwa extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_no',
        'gwa',
        'aysem_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_no');
    }

    public function aysem()
    {
        return $this->belongsTo(Aysem::class, 'aysem_id');
    }
}
