<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curriculo extends Model
{
    protected $fillable = [
        'id',
        'idUsuario',
        'arquivoCaminho',
        'arquivoNome',
    ];
}
