<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class curriculos extends Model
{
    protected $fillable = [
        'id',
        'idUsuario',
        'arquivoCaminho',
        'arquivoNome',
    ];
}
