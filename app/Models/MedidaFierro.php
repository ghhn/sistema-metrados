<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MedidaFierro extends Model
{
    protected $table = 'medida_fierro';

    protected $fillable = [
        'codigo', 'detalle', 'estado',
    ];

    protected $casts = [
        'estado' => 'integer',
    ];

    public function partidasFierro(): HasMany
    {
        return $this->hasMany(PartidaFierro::class, 'medida_fierro_id');
    }
}
