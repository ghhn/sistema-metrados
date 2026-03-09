<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PartidaDiaria extends Model
{
    protected $table = 'partida_diarias';

    public function partida(): BelongsTo
    {
        return $this->belongsTo(Partidas::class, 'partida_id');
    }

    public function bienes(): HasMany
    {
        return $this->hasMany(PartidaBienes::class, 'partida_diaria_id');
    }
}
