<h1>Produtos</h1>

<a href="{{ route('produtos.create') }}">
    Cadastrar Produto
</a>

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