<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = [
        'id',
        'nome',
        'email',
        'senha',
        'idTipoUsuario',
    ];
}
