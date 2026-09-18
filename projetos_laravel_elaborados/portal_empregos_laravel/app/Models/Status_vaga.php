<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status_vaga extends Model
{
    protected $table = 'status_vaga';

    protected $fillable = [
        'id',
        'status'
    ];
}
