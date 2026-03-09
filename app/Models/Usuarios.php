<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Usuarios extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombres','dni','correo','telefono','password','estado','tipo'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'estado' => 'integer',
        
    ];

    // ✅ Auth usará este campo como contraseña
    public function getAuthPassword(): string
    {
        return $this->password;
    }

    // (Opcional pero recomendado) si quieres que el "username" del usuario sea dni:
    public function username(): string
    {
        return 'dni';
    }

    // RELACIONES (igual que las tuyas)
    public function obras(): BelongsToMany
    {
        return $this->belongsToMany(Obras::class, 'obra_usuario', 'usuario_id', 'obra_id')
            ->withPivot(['rol','estado'])
            ->withTimestamps();
    }

    public function partidasResponsable(): HasMany
    {
        return $this->hasMany(Partida::class, 'responsable_id');
    }

    public function metradosRegistrados(): HasMany
    {
        return $this->hasMany(PartidaDiaria::class, 'usuario_id');
    }

    public function metradosAuditados(): HasMany
    {
        return $this->hasMany(PartidaDiaria::class, 'auditado_por');
    }

    public function periodoPartidasAuditadas(): HasMany
    {
        return $this->hasMany(PeriodoPartida::class, 'auditado_por');
    }
}