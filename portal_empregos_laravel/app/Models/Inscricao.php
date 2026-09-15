<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model
{
    protected $table = 'inscricao';

    protected $fillable = [
        'id',
        'idCandidato',
        'idVaga',
        'idStatus',
    ];
}
