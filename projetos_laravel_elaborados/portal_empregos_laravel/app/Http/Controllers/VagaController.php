<?php

namespace App\Http\Controllers;

use App\Models\Vaga;
use App\Models\Status_vaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VagaController
{
    // Exibe somente as vagas da empresa autenticada
    public function index()
    {
        // Filtra a vaga de acordo com o ID da empresa autenticada
        $vagas = Vaga::where('idEmpresa', Auth::id())->get();

        // retorna uma view com um resultado das vagas.
        return view('vagas.index', compact('vagas'));
    }

    // Exibe o formulário de cadastro das vagas
    public function create()
    {
        return view('vagas.create');
    }

    // Função para armazenado as vagas no banco
    public function store(Request $request)
    {
        // Validando os dados
        $dados = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'localizacao' => 'required|string|max:255',
            'salario' => 'nullable|numeric|min:0',
        ]);

        // Buscando o status padrão de uma nova vaga
        $statusDisponivel = Status_vaga::where('status', 'Disponível')->firstOrFail();

        // Verificando quantas vagas abertas a empresa possui
        $quantidadeVagas = Vaga::where('idEmpresa', Auth::id())
            ->where('idStatus', $statusDisponivel->id)
            ->count();

        // Regra: empresa pode possuir no máximo 10 vagas abertas simultaneamente
        if ($quantidadeVagas >= 10)
            return back()
                ->withInput()
                ->with('error', 'Você já possui o limite de 10 vagas abertas.');

        // Criando a vaga
        Vaga::create([
            'idEmpresa' => Auth::id(),
            'idStatus' => $statusDisponivel->id,
            'titulo' => $dados['titulo'],
            'descricao' => $dados['descricao'],
            'localizacao' => $dados['localizacao'],
            'salario' => $dados['salario'] ?? null,
        ]);

        return redirect()
            ->route('vagas.index')
            ->with('sucess', 'Vaga cadastrada com sucesso.');
    }

    // Exibir os dados da vaga única
    public function show(Vaga $vaga)
    {
        // Garante que outras empresas não acessem vagas que não pertencem a elas.
        if ($vaga->idEmpresa != Auth::id()) {
            abort(403, 'Acesso não autorizado.');
        }

        return view('vagas.show', compact('vaga'));
    }

    // Exibe o formulário para editar a vaga
    public function edit(Vaga $vaga)
    {
        // Garante que outras empresas não acessem vagas que não pertencem a elas.
        if ($vaga->idEmpresa != Auth::id()) {
            abort(403, 'Acesso não autorizado.');
        }

        return view('vagas.edit', compact('vaga'));
    }

    // Função de atualização da vaba
    public function update(Request $request, Vaga $vaga)
    {
        // Garante que outras empresas não acessem vagas que não pertencem a elas.
        if ($vaga->idEmpresa != Auth::id()) {
            abort(403, 'Acesso não autorizado.');
        }

        $dados = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'localizacao' => 'required|string|max:255',
            'salario' => 'nullable|numeric|min:0',
        ]);

        $vaga->update([
            'titulo' => $dados['titulo'],
            'descricao' => $dados['descricao'],
            'localizacao' => $dados['localizacao'],
            'salario' => $dados['salario'] ?? null,
        ]);

        return redirect()
            ->route('vagas.show', $vaga)
            ->with('success', 'Vaga atualizada com sucesso.');
    }

    // Função para remover a vaga
    public function destroy(Vaga $vaga)
    {
        // Garante que outras empresas não acessem vagas que não pertencem a elas.
        if ($vaga->idEmpresa != Auth::id()) {
            abort(403, 'Acesso não autorizado.');
        }

        $vaga->delete();

        return redirect()
            ->route('vagas.index')
            ->with('success', 'Vaga removida com sucesso.');
    }

    // Função para fechar uma vaga
    public function fechar(Vaga $vaga)
    {
        // Garante que outras empresas não acessem vagas que não pertencem a elas.
        if ($vaga->idEmpresa != Auth::id()) {
            abort(403, 'Acesso não autorizado.');
        }

        // Buscando o status de fechamento papra uma vaga existente
        $statusIndisponivel = Status_vaga::where('status', 'Indisponível')->firstOrFail();

        // Atualiza os status da vaga e sua data de fechamento
        $vaga->update([
            'idStatus' => $statusIndisponivel->id,
            'dataFechamento' => now(),
        ]);

        return redirect()
            ->route('vagas.show', $vaga)
            ->with('success', 'Vaga fechada com sucesso.');
    }
}
