{{-- O @extends('layouts.app') indica que este arquivo Blade estende o layout definido em resources/views/layouts/app.blade.php. Isso significa que o conteúdo deste arquivo será inserido no layout principal, permitindo a reutilização de elementos comuns, como cabeçalhos e rodapés, em várias páginas da aplicação. --}}
@extends('layouts.app')

{{-- O @section('title','Produtos') define o título da página como "Produtos". Esse título será inserido na seção 'title' do layout principal, permitindo que cada página tenha um título específico. --}}
@section('title','Produtos')

{{-- O @section('content') inicia uma seção de conteúdo que será inserida na seção 'content' do layout principal. Todo o conteúdo entre @section('content') e @endsection será exibido na área designada do layout. --}}
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Produtos</h1>

    <a href="{{ route('produtos.create') }}" class="btn btn-success">
        Cadastrar Produto
    </a>
</div>

{{-- Exibe uma mensagem de sucesso se houver uma na sessão --}}
@if(session('success'))
<div class="alert alert-success">
    {{ session('success')}}
</div>
@endif

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Ações</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($produtos as $produto)
        <tr>
            <td>{{ $produto->nome }}</td>
            <td>{{ $produto->descricao }}</td>
            <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
            <td>{{ $produto->quantidade }}</td>

            <td>
                <a
                    href="{{ route('produtos.show', $produto->id) }}"
                    class="btn btn-info btn-sm">
                    Detalhes
                </a>

                <a
                    href="{{ route('produtos.edit', $produto->id) }}"
                    class="btn btn-primary btn-sm">
                    Editar
                </a>

                <form
                    action="{{ route('produtos.destroy', $produto->id) }}"
                    method="POST"
                    class="d-inline"
                    onsubmit="return confirm('Tem certeza que deseja excluir este produto?')">
                    {{-- O onsubmit é um evento JavaScript que é acionado quando o formulário é enviado. A função confirm exibe uma caixa de diálogo de confirmação para o usuário, perguntando se ele tem certeza de que deseja excluir o produto. Se o usuário clicar em "OK", o formulário será enviado; se clicar em "Cancelar", o envio do formulário será interrompido. --}}

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-danger btn-sm">
                        Excluir
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection