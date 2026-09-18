@extends('layouts.app')

@section('title', 'Detalhes do Produto')

@section('content')

<h1>Detalhes do Produto</h1>

<p>
    <strong>Nome:</strong>
    {{ $produto->nome }}
</p>

<p>
    <strong>Descrição:</strong>
    {{ $produto->descricao }}
</p>

<p>
    <strong>Preço:</strong>
    {{ $produto->preco }}
</p>

<p>
    <strong>Quantidade:</strong>
    {{ $produto->quantidade }}
</p>

<a href="{{ route('produtos.index') }}" class="btn btn-secondary">
    Voltar
</a>

@endsection