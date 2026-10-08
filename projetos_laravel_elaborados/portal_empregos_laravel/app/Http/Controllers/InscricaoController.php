<?php

namespace App\Http\Controllers;

use App\Models\Inscricao;
use App\Models\Status_inscricao;
use App\Models\Status_vaga;
use App\Models\Vaga;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class InscricaoController extends Controller
{

    // FUNÇÕES DOS CANDIDATOS

    // Criação do método de inscrição para vaga
    public function store(Vaga $vaga)
    {
        // Verifica se a vaga está disponível
        $statusDisponivel = $this->buscarStatusVagas("Disponível");

        if ($vaga->idStatus != $statusDisponivel->id) {
            return back()
                ->with('error', 'Esta vaga não está disponível para candidatura.');
        }

        // Filtra o status "pendente" da tabela "status_inscricao"
        $statusPendente = $this->buscarStatusInscricao('Pendente');

        // Filtra o status de "desistência" da tabela "status_inscricao"
        $statusDesistencia = $this->buscarStatusInscricao('Desistência');

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
        $this->validarInscricaoCandidato($inscricao);

        // Garante que o usuário só cancelará as inscrições com status "pendentes"
        $statusPendente = $this->buscarStatusInscricao('Pendente');

        if ($inscricao->idStatus != $statusPendente->id) {
            return back()
                ->with('error', 'Esta candidatura não pode mais ser cancelada.');
        }

        $statusDesistencia = $this->buscarStatusInscricao('Desistência');

        $inscricao->update([
            'idStatus' => $statusDesistencia->id,
        ]);

        return redirect()
            ->route('inscricoes.index')
            ->with('success', 'Candidatura cancelada com sucesso.');
    }

    // FUNÇÃO DAS EMPRESAS

    // Busca todas as inscrições relacionadas à essa vaga
    public function inscricoesPorVaga(Vaga $vaga)
    {
        // Verifica se aquela vaga pertence à empresa
        $this->validarVagasEmpresa($vaga);

        // Busca todas as inscrições relacionadas a esta vaga
        $inscricoes = Inscricao::where('idVaga', $vaga->id)
            ->with(['statusInscricao', 'candidato.curriculo'])
            ->get();

        return view('inscricoes.empresa', compact('vaga', 'inscricoes'));
    }

    // Função de aprovar candidatura
    public function aprovar(Inscricao $inscricao)
    {
        $this->validarEmpresaDaInscricao($inscricao);

        $statusPendente = $this->buscarStatusInscricao('Pendente');

        // Garante que a empresa aprove inscrições com status "pendente"
        if ($inscricao->idStatus != $statusPendente->id) {
            return back()
                ->with('error', 'Somente candidaturas pendentes podem ser aprovadas.');
        }

        $statusAprovado = $this->buscarStatusInscricao('Aprovado');

        $inscricao->update([
            'idStatus' => $statusAprovado->id,
        ]);

        return back()
            ->with('success', 'Candidatura aprovada com sucesso.');
    }

    // Função de rejeitar candidatura
    public function rejeitar(Inscricao $inscricao)
    {
        $this->validarEmpresaDaInscricao($inscricao);

        $statusPendente = $this->buscarStatusInscricao('Pendente');

        // Garante que a empresa rejeitam inscrições com status "pendente"
        if ($inscricao->idStatus != $statusPendente->id) {
            return back()
                ->with('error', 'Somente candidaturas pendentes podem ser rejeitadas.');
        }

        $statusRejeitado = $this->buscarStatusInscricao('Rejeitado');

        $inscricao->update([
            'idStatus' => $statusRejeitado->id,
        ]);

        return back()
            ->with('success', 'Candidatura rejeitada com sucesso.');
    }

    // FUNÇÕES PRIVADAS PARA EVITAR REDUNDÂNCIAS

    // Validação de autenticação dos candidatos 
    private function validarInscricaoCandidato(Inscricao $inscricao): void
    {
        if ($inscricao->idCandidato != Auth::id()) {
            abort(403, 'Acesso não autorizado.');
        }
    }

    // Validação de autenticação das empresas (vagas)
    private function validarVagasEmpresa(Vaga $vaga): void
    {
        if ($vaga->idEmpresa != Auth::id()) {
            abort(403, 'Acesso não autorizado.');
        }
    }

    // Validação de autenticação da empresa (inscrição)
    private function validarEmpresaDaInscricao(Inscricao $inscricao): void
    {
        if ($inscricao->vaga->idEmpresa != Auth::id()) {
            abort(403, 'Acesso não autorizado.');
        }
    }

    // Realiza a busca dos status de acordo com o que for enviado
    private function buscarStatusInscricao(string $status)
    {
        return Status_Inscricao::where('status', $status)
            ->firstOrFail();
    }

    // Buscando o status padrão de uma nova vaga
    private function buscarStatusVagas(string $status)
    {
        return Status_vaga::where('status', $status)->firstOrFail();
    }
}
