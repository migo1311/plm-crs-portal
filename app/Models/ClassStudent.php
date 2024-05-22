<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassStudent extends Model
{
    use HasFactory;

    protected $table = 'class_student';

    protected $fillable = ['class_id', 'student_id'];

    public function grade()
    {
        return $this->hasOne(Grade::class, 'class_student_id', 'class_student_id');
    }
}
