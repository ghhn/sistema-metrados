<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Periodo extends Model
{
    protected $table = 'periodos';

    protected $fillable = [
        'obra_id', 'anio', 'mes', 'fecha_inicio', 'fecha_fin', 'estado',
    ];

    protected $casts = [
        'anio' => 'integer',
        'mes' => 'integer',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'estado' => 'integer',
    ];

    public function obra(): BelongsTo
    {
        return $this->belongsTo(Obra::class, 'obra_id');
    }

    public function periodoPartidas(): HasMany
    {
        return $this->hasMany(PeriodoPartida::class, 'periodo_id');
    }

    public function diarios(): HasMany
    {
        return $this->hasMany(PartidaDiaria::class, 'periodo_id');
    }
}
