<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRestriction extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'scope',
        'restriction',
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }
}
