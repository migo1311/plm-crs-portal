<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RefundForm extends Model
{
    use HasFactory;

    protected $primaryKey = 'refund_form_id';

    protected $fillable = [
        'assessment_id',
        'type_of_refund',
        'rate_of_refund',
    ];

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(Assessment::class);
    }
}
