<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class inscricoes extends Model
{
    protected $fillable = [
        'id',
        'idCandidato',
        'idVaga',
        'idStatus',
    ];
}
