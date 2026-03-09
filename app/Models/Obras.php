<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Obras extends Model
{
    protected $table = 'obras';

    protected $fillable = [
        'nombre','meta','estado'
    ];

    protected $casts = [
        'estado' => 'integer',
    ];

    public function usuarios(): BelongsToMany
    {
        return $this->belongsToMany(Usuario::class, 'obra_usuario', 'obra_id', 'usuario_id')
            ->withPivot(['rol','estado'])
            ->withTimestamps();
    }

    public function partidas(): HasMany
    {
        return $this->hasMany(Partida::class, 'obra_id');
    }

    public function periodos(): HasMany
    {
        return $this->hasMany(Periodo::class, 'obra_id');
    }
}