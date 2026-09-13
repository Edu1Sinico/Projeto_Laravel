<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vagas extends Model
{
    protected $fillable = [
        'id',
        'idEmpresa',
        'idStatus',
        'titulo',
        'descricao',
        'localizacao',
        'salario',
        'dataFechamento'
    ];
}
