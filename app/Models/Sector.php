<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sector extends Model
{
    protected $fillable = [
        'name',
        'acronym'
    ];

    public function institutions(): HasMany
    {
        return $this->hasMany(Institution::class);
    }
}
