<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Remark extends Model
{
    use HasFactory;

    protected $primaryKey = 'remark_id';

    protected $fillable = [
        'remark',
    ];

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class, 'remark_id', 'remark_id');
    }
}
