<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Productos extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'nombre', 'codigo', 'unidad_medida', 'estado',
    ];

    protected $casts = [
        'estado' => 'integer',
    ];

    public function bienes(): HasMany
    {
        return $this->hasMany(PartidaBien::class, 'producto_id');
    }
}
