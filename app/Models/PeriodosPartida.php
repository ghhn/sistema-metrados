<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PeriodoPartida extends Model
{
    protected $table = 'periodo_partida';

    protected $fillable = [
        'periodo_id', 'partida_id',
        'anterior_acumulado', 'acumulado_al_cierre', 'saldo_al_cierre',
        'estado_aprobacion', 'auditado_por', 'auditado_en', 'observacion',
    ];

    protected $casts = [
        'anterior_acumulado' => 'decimal:3',
        'acumulado_al_cierre' => 'decimal:3',
        'saldo_al_cierre' => 'decimal:3',
        'estado_aprobacion' => 'integer',
        'auditado_por' => 'integer',
        'auditado_en' => 'datetime',
    ];

    public function periodo(): BelongsTo
    {
        return $this->belongsTo(Periodo::class, 'periodo_id');
    }

    public function partida(): BelongsTo
    {
        return $this->belongsTo(Partida::class, 'partida_id');
    }

    public function auditor(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'auditado_por');
    }
}
