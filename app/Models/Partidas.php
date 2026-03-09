<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Partidas extends Model
{
    protected $table = 'partidas';

    public function responsable(): BelongsTo
    {
        return $this->belongsTo(Usuarios::class, 'responsable_id');
    }

    public function diarios(): HasMany
    {
        return $this->hasMany(PartidaDiaria::class, 'partida_id');
    }

    // Trae TODOS los bienes de la partida (pasando por diarios)
    public function bienes(): HasManyThrough
    {
        return $this->hasManyThrough(
            PartidaBienes::class,   // final
            PartidaDiaria::class,   // intermedia
            'partida_id',           // FK en partida_diarias -> partidas
            'partida_diaria_id',    // FK en partida_bienes -> partida_diarias
            'id',                   // PK partidas
            'id'                    // PK partida_diarias
        );
    }
}
