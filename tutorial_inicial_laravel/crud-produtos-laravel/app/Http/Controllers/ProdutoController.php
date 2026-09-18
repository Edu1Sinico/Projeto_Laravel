<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    // Listagem de produtos
    public function index()
    {
        // Realiza a busca de todos os produtos no banco de dados (utilizando o Eloquent ORM)
        $produtos = Produto::all();

        // Retorna a view 'produtos.index' passando os produtos como variável
        return view('produtos.index', compact('produtos'));
    }

    // Exibe o formulário de criação de produto
    public function create()
    {
        // Retorna a view 'produtos.create' para exibir o formulário de criação de produto
        return view('produtos.create');
    }


    // Armazena um novo produto no banco de dados
    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $request->validate([
            'nome' => 'required',
            'descricao' => 'nullable',
            'preco' => 'required|numeric',
            'quantidade' => 'required|integer',
        ]);

        // Criação do produto utilizando Eloquent ORM
        Produto::create($request->all());

        // Redireciona para a listagem de produtos com uma mensagem de sucesso
        return redirect()
            ->route('produtos.index')
            ->with('success', 'Produto cadastrado com sucesso.');
    }

    // Exibe os detalhes de um produto específico
    public function show(Produto $produto)
    {
        return view('produtos.show', compact('produto'));
    }

    // Exibe o formulário de edição de um produto
    public function edit(Produto $produto)
    {
        return view('produtos.edit', compact('produto'));
    }

    // Atualiza um produto existente
    public function update(Request $request, Produto $produto)
    {
        // Validação dos dados recebidos
        $request->validate([
            'nome' => 'required',
            'descricao' => 'nullable',
            'preco' => 'required|numeric',
            'quantidade' => 'required|integer',
        ]);

        // Atualiza o produto utilizando Eloquent ORM
        $produto->update($request->all());

        // Redireciona para a listagem com uma mensagem de sucesso
        return redirect()
            ->route('produtos.index')
            ->with('success', 'Produto atualizado com sucesso.');
    }

    // Exclui um produto do banco de dados
    public function destroy(Produto $produto)
    {
        // Exclui o produto utilizando Eloquent ORM
        $produto->delete();

        // Redireciona para a listagem de produtos com uma mensagem de sucesso
        return redirect()
            ->route('produtos.index')
            ->with('success', 'Produto excluído com sucesso.');
    }
}
