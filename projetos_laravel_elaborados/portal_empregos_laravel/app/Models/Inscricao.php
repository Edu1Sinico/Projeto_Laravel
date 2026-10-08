<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vaga;
use App\Models\Status_Inscricao;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inscricao extends Model
{
    protected $fillable = [
        'idCandidato',
        'idVaga',
        'idStatus',
    ];

    // Realiza os relacionamentos entre as classes

    // Relacionando o atributo "idVaga" com a classe "vaga"
    public function vaga(): BelongsTo
    {
        return $this->belongsTo(Vaga::class, 'idVaga');
    }

    // Relacionando o atributo "idStatus" com a classe "status_inscricao"
    public function statusInscricao(): BelongsTo
    {
        return $this->belongsTo(Status_Inscricao::class, 'idStatus');
    }

    // Relacionando o atributo "idCandidato" com a classe "usuario"
    public function candidato(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'idCandidato');
    }
}
