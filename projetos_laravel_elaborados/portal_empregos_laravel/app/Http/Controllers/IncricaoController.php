<?php

namespace App\Http\Controllers;

use App\Models\Inscricao;
use App\Models\Status_inscricao;
use App\Models\Status_vaga;
use App\Models\Vaga;
use App\Models\StatusInscricao;
use App\Models\StatusVaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncricaoController
{
    // Criação do método de inscrição para vaga
    public function store(Vaga $vaga)
    {
        // Verifica se a vaga está disponível
        $statusDisponivel = Status_vaga::where('status', 'disponível')
            ->firstOrFail();

        if ($vaga->idStatus != $statusDisponivel->id) {
            return back()
                ->with('error', 'Esta vaga não está disponível para candidatura.');
        }

        // Verifica se o candidato já se inscreveu nesta vaga
        $inscricaoExistente = Inscricao::where('idCandidato', Auth::id())
            ->where('idVaga', $vaga->id)
            ->first();

        if ($inscricaoExistente) {
            return back()
                ->with('error', 'Você já se candidatou a esta vaga.');
        }

        // Busca o status inicial da inscrição
        $statusPendente = Status_inscricao::where('status', 'pendente');

        // Cria a inscrição
        Inscricao::create([
            'idCandidato' => Auth::id(),
            'idVaga' => $vaga->id,
            'idStatus' => $statusPendente->id,
        ]);

        return back()
            ->with('success','Candidatura realizada com sucesso.');
    }
}
