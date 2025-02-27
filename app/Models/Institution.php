<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Institution extends Model
{
    protected $fillable = [
        'sector_id',
        'name',
        'code',
        'responsableInstitution',
        'cargoInstitution',
        'direccionEntrega',
        'phone',
        'map_google'
    ];

    public function sector(): BelongsTo
    {
        return $this->belongsTo(Sector::class);
    }
}
