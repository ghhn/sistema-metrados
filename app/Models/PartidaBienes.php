<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PartidaBienes extends Model
{
    protected $table = 'partida_bienes';

    protected $fillable = [
        'partida_diaria_id', 'producto_id',
        'cantidad', 'longitud', 'ancho', 'altura', 'n_veces',
        'total', 'observacion', 'ubicacion', 'bloque', 'nivel',
    ];

    protected $casts = [
        'cantidad' => 'decimal:3',
        'longitud' => 'decimal:3',
        'ancho' => 'decimal:3',
        'altura' => 'decimal:3',
        'n_veces' => 'decimal:3',
        'total' => 'decimal:3',
        'producto_id' => 'integer',
        'partida_diaria_id' => 'integer',
    ];

    public function diaria(): BelongsTo
    {
        return $this->belongsTo(PartidaDiaria::class, 'partida_diaria_id');
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Productos::class, 'producto_id');
    }

    public function fierros(): HasMany
    {
        return $this->hasMany(PartidaFierro::class, 'partida_bienes_id');
    }

    // ❌ NO PONGAS partida() usando partida_id si no existe esa columna
}
