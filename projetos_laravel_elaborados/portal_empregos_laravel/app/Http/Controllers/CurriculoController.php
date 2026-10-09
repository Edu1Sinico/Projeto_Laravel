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
    public function show()
    {
        // Utiliza do método privado de busca do currículo.
        $curriculo = $this->buscarCurriculoUsuario();

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

        // Arquivo enviado pelo usuário
        $arquivo = $request->file('curriculo');

        // Busca o currículo atual do usuário, caso exista
        $curriculoExistente = $this->buscarCurriculoUsuario();

        // Salva o NOVO arquivo e retorna seu caminho
        $caminho = $arquivo->store('curriculos', 'public');

        // Se o curriculo existir, ele apaga o existente e substitui por um novo.
        if ($curriculoExistente) {

            // Salva o caminho do currículo antigo.
            $caminhoAntigo = $curriculoExistente->arquivoCaminho;

            // Atualiza para os novos dados do novo currículo
            $curriculoExistente->update([
                'arquivoCaminho' => $caminho,
                'arquivoNome' => $arquivo->getClientOriginalName(),
            ]);

            // Apaga o curriculo armazenado no caminho anterior
            Storage::disk('public')->delete($caminhoAntigo);
        } else {

            // Primeiro currículo do usuário
            Curriculo::create([
                'idUsuario' => Auth::id(),
                'arquivoCaminho' => $caminho,
                'arquivoNome' => $arquivo->getClientOriginalName(), // Método para buscar o nome original do arquivo
            ]);
        }

        // Redirecionando para a página do currículo com uma mensagem de sucesso.
        return redirect()
            ->route('curriculos.show')
            ->with('success', 'Currículo cadastrado com sucesso.');
    }

    // Função para remover o currículo
    public function destroy()
    {
        $curriculo = $this->buscarCurriculoUsuario();

        // Retorna para tela inicial do currículo com um erro, caso não encontre o currículo cadastrado.
        if (!$curriculo) {
            return redirect()
                ->route('curriculos.show')
                ->with('error', 'Nenhum currículo foi encontrado.');
        }

        // Realiza a remoção do currículo na pasta e também no banco.
        Storage::disk('public')->delete($curriculo->arquivoCaminho);

        $curriculo->delete();

        // Redireciona para página inicial com uma mensagem de sucesso.
        return redirect()
            ->route('curriculos.show')
            ->with('success', 'Currículo removido com sucesso.');
    }

    // FUNÇÕES PRIVADAS PARA EVITAR REDUNDÂNCIAS

    // Método responsável pelas buscas dos currículos para os usuários autenticados.
    private function buscarCurriculoUsuario()
    {
        return Curriculo::where('idUsuario', Auth::id())->first();
    }
}
