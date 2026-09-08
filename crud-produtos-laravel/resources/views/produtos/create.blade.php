@extends('layouts.app')

@section('title', 'Cadastrar Produto')

@section('content')

<h1 class="mb-4">Criar Produto</h1>

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

{{-- Enviando o formulário para a rota 'produtos.store' usando o método POST --}}
<form action="{{ route('produtos.store') }}" method="POST">
    {{-- Adicionando o token CSRF para proteger contra ataques CSRF --}}
    @csrf

    <div class="mb-3">
        <label for="nome" class="form-label">Nome:</label>
        {{-- O old('nome') é usado para manter o valor do campo caso haja um erro de validação e a página seja recarregada (O mesmo vale para os outros) --}}
        <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome') }}">
    </div>

    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição:</label>
        <textarea name="descricao" id="descricao" class="form-control" rows="4">{{ old('descricao') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="preco" class="form-label">Preço:</label>
        <input type="number" name="preco" id="preco" class="form-control" step="0.01" value="{{ old('preco') }}">
    </div>

    <div class="mb-3">
        <label for="quantidade" class="form-label">Quantidade:</label>
        <input type="number" name="quantidade" class="form-control" id="quantidade" value="{{ old('quantidade') }}">
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <button type="submit" class="btn btn-success">
            Cadastrar
        </button>

        <a href="{{ route('produtos.index') }}" class="btn btn-secondary">
            Voltar
        </a>
    </div>
</form>



@endsection