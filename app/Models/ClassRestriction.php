<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassRestriction extends Model
{
    use HasFactory;

    protected $primaryKey = 'class_restriction_id';

    protected $fillable = [
        'class_id',
        'scope',
        'restriction',
    ];

    public function class(): BelongsTo
    {
        return $this->belongsTo(TaClass::class, 'class_id', 'class_id');
    }

}
