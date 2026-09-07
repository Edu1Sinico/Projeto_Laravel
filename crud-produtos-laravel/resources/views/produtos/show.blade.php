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

<a href="{{ route('produtos.index') }}">
    Voltar
</a>