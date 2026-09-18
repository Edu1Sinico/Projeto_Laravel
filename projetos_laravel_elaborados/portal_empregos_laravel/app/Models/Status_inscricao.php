<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status_inscricao extends Model
{
    protected $table = 'status_inscricao';

    protected $fillable = [
        'id',
        'status'
    ];
}
