<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'fee_status'
    ];

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }
}
