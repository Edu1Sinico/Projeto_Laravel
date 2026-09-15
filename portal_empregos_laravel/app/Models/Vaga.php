<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaga extends Model
{
    protected $table = 'vaga';

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
