@extends('layouts.app')

@section('title', 'Editar Produto')

@section('content')

<h1>Editar Produto</h1>

{{-- Exibe uma mensagem de erro se houver uma na sessão --}}
@if ($errors->any())
<div>
    <strong>Foram encontrados erros:</strong>

    <ul>
        {{-- Itera sobre todos os erros e exibe cada um em uma lista --}}
        @foreach ($errors->all() as $error)
        <li> {{ $error }} </li>
        @endforeach
    </ul>
</div>
@endif

{{-- Enviando o formulário para a rota 'produtos.update' usando o método PUT --}}
<form action="{{ route('produtos.update', $produto->id) }}" method="POST">
    {{-- Adicionando o token CSRF para proteger contra ataques CSRF --}}
    @csrf
    {{-- Especificando que o método HTTP é PUT para atualização do recurso --}}
    @method('PUT')

    <div>
        <label for="nome">Nome:</label><br>
        {{-- O old('nome', $produto->nome) é usado para manter o valor do campo caso haja um erro de validação e a página seja recarregada, ou para preencher com o valor atual do produto --}}
        <input type="text" name="nome" id="nome" value="{{ old('nome', $produto->nome) }}">
    </div>

    <div>
        <label for="descricao">Descrição:</label><br>
        <textarea name="descricao" id="descricao">{{ old('descricao', $produto->descricao) }}</textarea>
    </div>

    <div>
        <label for="preco">Preço:</label><br>
        <input type="number" name="preco" id="preco" step="0.01" value="{{ old('preco', $produto->preco) }}">
    </div>

    <div>
        <label for="quantidade">Quantidade:</label><br>
        <input type="number" name="quantidade" id="quantidade" value="{{ old('quantidade', $produto->quantidade) }}">
    </div>

    <br>

    <button type="submit">Atualizar</button>
</form>

<button>
    <a href="{{ route('produtos.index') }}" style="text-decoration: none; color: inherit;">
        Voltar
    </a>
</button>

@endsection