<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

// Para a autenticação funcionar, a classe de usuário precisa extender da classe "Authenticatable" (User)
class Usuario extends Authenticatable
{
    protected $fillable = [
        'nome',
        'email',
        'senha',
        'idTipoUsuario',
    ];

    // Relacionamento com o currículo
    public function curriculo()
    {
        return $this->hasOne(Curriculo::class, 'idUsuario');
    }
}
