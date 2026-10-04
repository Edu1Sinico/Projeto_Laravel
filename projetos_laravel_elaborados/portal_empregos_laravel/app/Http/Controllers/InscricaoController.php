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

class InscricaoController
{
    // Criação do método de inscrição para vaga
    public function store(Vaga $vaga)
    {
        // Verifica se a vaga está disponível
        $statusDisponivel = Status_vaga::where('status', 'Disponível')
            ->firstOrFail();

        if ($vaga->idStatus != $statusDisponivel->id) {
            return back()
                ->with('error', 'Esta vaga não está disponível para candidatura.');
        }

        // Filtra o status "pendente" da tabela "status_inscricao"
        $statusPendente = Status_Inscricao::where('status', 'pendente')
            ->firstOrFail();

        // Filtra o status de "desistência" da tabela "status_inscricao"
        $statusDesistencia = Status_Inscricao::where('status', 'desistência')
            ->firstOrFail();

        // Verifica se o candidato já se inscreveu nesta vaga
        $inscricaoExistente = Inscricao::where('idCandidato', Auth::id())
            ->where('idVaga', $vaga->id)
            ->first();

        // Verifica se a inscrição existe
        if ($inscricaoExistente) {

            // Caso sim, ele verifica se o status da inscrição é igual a "desistência"
            if ($inscricaoExistente->idStatus == $statusDesistencia->id) {

                // Se for, ele permite realizar a inscrição novamente e atualiza seu status para "pendente".
                $inscricaoExistente->update([
                    'idStatus' => $statusPendente->id,
                ]);

                return back()
                    ->with('success', 'Candidatura realizada novamente com sucesso.');
            }
            
            // Caso a inscrição já existir e não estiver com status "desistência", ele retorna essa mensagem.
            return back()
                ->with('error', 'Você já possui uma candidatura para esta vaga.');
        }

        // Cria a inscrição
        Inscricao::create([
            'idCandidato' => Auth::id(),
            'idVaga' => $vaga->id,
            'idStatus' => $statusPendente->id,
        ]);

        return back()
            ->with('success', 'Candidatura realizada com sucesso.');
    }

    // Função para realizar as buscas das vagas candidatas dos candidatos
    public function index()
    {
        // Realiza a busca das vagas do candidato autenticado
        $inscricoes = Inscricao::where('idCandidato', Auth::id())
            ->with(['vaga', 'statusInscricao']) // Carrega também os relacionametos da classe "inscrição"
            ->get();

        return view('inscricoes.index', compact('inscricoes'));
    }

    // Função de cancelamento/desistência da vaga
    public function cancelar(Inscricao $inscricao)
    {
        // Validação do usuário autenticado
        if ($inscricao->idCandidato != Auth::id()) {
            abort(403, 'Acesso não autorizado');
        }

        // Filtra o id do status de "desistência" e depois atualiza no status da inscrição
        $statusCancelada = Status_Inscricao::where('status', 'desistência')
            ->firstOrFail();

        $inscricao->update([
            'idStatus' => $statusCancelada->id,
        ]);

        return redirect()
            ->route('inscricoes.index')
            ->with('success', 'Candidatura cancelada com sucesso.');
    }
}
