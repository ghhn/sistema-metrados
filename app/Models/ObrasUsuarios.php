<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ObraUsuario extends Model
{
    protected $table = 'obra_usuario';

    protected $fillable = ['obra_id', 'usuario_id', 'rol', 'estado'];

    protected $casts = [
        'rol' => 'integer',
        'estado' => 'integer',
    ];

    public function obra(): BelongsTo
    {
        return $this->belongsTo(Obra::class, 'obra_id');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
