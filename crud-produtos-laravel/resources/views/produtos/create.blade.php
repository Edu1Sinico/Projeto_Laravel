@extends('layouts.app')

@section('title', 'Cadastrar Produto')

@section('content')

<h1>Criar Produto</h1>

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

{{-- Enviando o formulário para a rota 'produtos.store' usando o método POST --}}
<form action="{{ route('produtos.store') }}" method="POST">
    {{-- Adicionando o token CSRF para proteger contra ataques CSRF --}}
    @csrf

    <div>
        <label for="nome">Nome:</label><br>
        {{-- O old('nome') é usado para manter o valor do campo caso haja um erro de validação e a página seja recarregada (O mesmo vale para os outros) --}}
        <input type="text" name="nome" id="nome" value="{{ old('nome') }}">
    </div>

    <div>
        <label for="descricao">Descrição:</label><br>
        <textarea name="descricao" id="descricao">{{ old('descricao') }}</textarea>
    </div>

    <div>
        <label for="preco">Preço:</label><br>
        <input type="number" name="preco" id="preco" step="0.01" value="{{ old('preco') }}">
    </div>

    <div>
        <label for="quantidade">Quantidade:</label><br>
        <input type="number" name="quantidade" id="quantidade" value="{{ old('quantidade') }}">
    </div>

    <br>

    <button type="submit">Cadastrar</button>
</form>

<button>
    <a href="{{ route('produtos.index') }}" style="text-decoration: none; color: inherit;">
        Voltar
    </a>
</button>

@endsection