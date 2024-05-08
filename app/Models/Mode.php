<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mode extends Model
{
    use HasFactory;

    protected $fillable = [
        'mode_code',
        'mode_type',
    ];

    public function classSchedules(): HasMany
    {
        return $this->hasMany(ClassSchedule::class, 'mode_id', 'mode_id');
    }
}
