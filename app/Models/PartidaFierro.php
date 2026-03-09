<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PartidaFierro extends Model
{
    protected $table = 'partida_fierro';

    protected $fillable = [
        'partida_bienes_id', 'medida_fierro_id', 'cantidad',
    ];

    protected $casts = [
        'cantidad' => 'decimal:3',
        'partida_bienes_id' => 'integer',
        'medida_fierro_id' => 'integer',
    ];

    public function bien(): BelongsTo
    {
        return $this->belongsTo(PartidaBien::class, 'partida_bienes_id');
    }

    public function medida(): BelongsTo
    {
        return $this->belongsTo(MedidaFierro::class, 'medida_fierro_id');
    }
}
