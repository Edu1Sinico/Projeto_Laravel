<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaga extends Model
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

    // Realiza o relacionamento entre o status e a vaga
    public function statusVaga()
    {
        return $this->belongsTo(Status_vaga::class, 'idStatus');
    }
}
