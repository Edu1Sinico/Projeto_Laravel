{{-- O @extends('layouts.app') indica que este arquivo Blade estende o layout definido em resources/views/layouts/app.blade.php. Isso significa que o conteúdo deste arquivo será inserido no layout principal, permitindo a reutilização de elementos comuns, como cabeçalhos e rodapés, em várias páginas da aplicação. --}}
@extends('layouts.app')

{{-- O @section('title','Produtos') define o título da página como "Produtos". Esse título será inserido na seção 'title' do layout principal, permitindo que cada página tenha um título específico. --}}
@section('title','Produtos')

{{-- O @section('content') inicia uma seção de conteúdo que será inserida na seção 'content' do layout principal. Todo o conteúdo entre @section('content') e @endsection será exibido na área designada do layout. --}}
@section('content')

<h1>Produtos</h1>

<a href="{{ route('produtos.create') }}">
    Cadastrar Produto
</a>

{{-- Exibe uma mensagem de sucesso se houver uma na sessão --}}
@if(session('success'))
<p>
    {{ session('success')}}
</p>
@endif

@foreach ($produtos as $produto)
<p>
    {{$produto->nome}}

    <br>

    <a href="{{ route('produtos.show', $produto->id) }}">
        Ver detalhes
    </a>

    <br>

    <a href="{{ route('produtos.edit', $produto->id) }}">
        Editar
    </a>


</p>

<form action="{{ route('produtos.destroy', $produto->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Excluir</button>
</form>
@endforeach

@endsection