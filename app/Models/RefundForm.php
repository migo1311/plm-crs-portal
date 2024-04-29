<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefundForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessment_id',
        'type_of_refund',
        'rate_of_refund',
    ];
}
