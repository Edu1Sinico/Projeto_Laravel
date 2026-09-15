<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

// Para a autenticação funcionar, a classe de usuário precisa extender da classe "Authenticatable" (User)
class Usuario extends Authenticatable
{
    protected $fillable = [
        'id',
        'nome',
        'email',
        'senha',
        'idTipoUsuario',
    ];
}
