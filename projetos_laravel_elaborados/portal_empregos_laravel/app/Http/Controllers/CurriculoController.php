<?php

namespace App\Http\Controllers;

use App\Models\Curriculo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CurriculoController extends Controller
{
    // Exibe o formulário de currículo
    public function show(Curriculo $curriculo)
    {
        $curriculo = Curriculo::where('idUsuario', Auth::id())->first();

        return view('curriculos.show', compact('curriculo'));
    }

    // Exibe o formulário de criação do currículo
    public function create()
    {
        return view('curriculos.create');
    }

    // Função para cadastrar o currículo
    public function store(Request $request)
    {
        // validando o arquivo recebido
        $request->validate([
            'curriculo' => 'required|file|mimes:pdf|max:2048'
        ]);

        // Pegando o arquivo recebido em armazenando em uma variável
        $arquivo = $request->file('curriculo');

        // Realiza a busca do currículo a partir do ID do usuário autenticado, para ver se ele existe.
        $curriculoExistente = Curriculo::where(
            'idUsuario',
            Auth::id()
        )->first();

        // Ela salva fisicamente o PDF e retorna o caminho relativo
        $caminho = $arquivo->store('curriculos', 'public');

        // Se o curriculo existir, ele apaga o existente e substitui por um novo.
        if ($curriculoExistente) {
            // Apaga o curriculo armazenado no caminho anterior
            Storage::disk('public')->delete(
                $curriculoExistente->arquivoCaminho
            );

            // Atualiza para os novos dados do novo currículo
            $curriculoExistente->update([
                'arquivoCaminho' => $caminho,
                'arquivoNome' => $arquivo->getClientOriginalName()
            ]);
        } else {
            // Criação do currículo
            Curriculo::create([
                'idUsuario' => Auth::id(), // Pega o id do usuário a partir da autenticação
                'arquivoCaminho' => $caminho,
                'arquivoNome' => $arquivo->getClientOriginalName(), // Método para buscar o nome original do arquivo
            ]);
        }


        // Redirecionando para a página do currículo com uma mensagem de sucesso.
        return redirect()
            ->route('curriculos.create')
            ->with('success', 'Currículo cadastrado com sucesso.');
    }

    // Função para atualizar (substituir) o currículo
    public function update(Request $request) {}

    // Função para remover o currículo
    public function destroy(Curriculo $curriculo) {}
}
