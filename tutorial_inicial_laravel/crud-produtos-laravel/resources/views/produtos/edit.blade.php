@extends('layouts.app')

@section('title', 'Editar Produto')

@section('content')

<h1 class="mb-4">Editar Produto</h1>

{{-- Exibe uma mensagem de erro se houver uma na sessão --}}
@if ($errors->any())
<div class="alert alert-danger">
    <strong>Foram encontrados erros:</strong>

    <ul class="mb-0">
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

    <div class="mb-3">
        <label for="nome" class="form-label">Nome:</label>
        {{-- O old('nome', $produto->nome) é usado para manter o valor do campo caso haja um erro de validação e a página seja recarregada, ou para preencher com o valor atual do produto --}}
        <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $produto->nome) }}">
    </div>

    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição:</label>
        <textarea name="descricao" id="descricao" class="form-control" rows="4">{{ old('descricao', $produto->descricao) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="preco" class="form-label">Preço:</label>
        <input type="number" name="preco" id="preco" class="form-control" step="0.01" value="{{ old('preco', $produto->preco) }}">
    </div>

    <div class="mb-3">
        <label for="quantidade" class="form-label">Quantidade:</label>
        <input type="number" name="quantidade" id="quantidade" class="form-control" value="{{ old('quantidade', $produto->quantidade) }}">
    </div>

    <br>

    <div class="d-flex justify-content-between align-items-center">
        <button type="submit" class="btn btn-success">
            Atualizar
        </button>

        <a href="{{ route('produtos.index') }}" class="btn btn-secondary">
            Voltar
        </a>
    </div>
</form>



@endsection