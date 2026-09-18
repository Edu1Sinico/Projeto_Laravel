<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipo_usuario extends Model
{
    protected $table = 'tipo_usuario';

    protected $fillable =  [
        'id',
        'tipo'
    ];
}
