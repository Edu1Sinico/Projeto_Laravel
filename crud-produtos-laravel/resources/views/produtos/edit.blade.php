<h1>Editar Produto</h1>

{{-- Enviando o formulário para a rota 'produtos.update' usando o método PUT --}}
<form action="{{ route('produtos.update', $produto->id) }}" method="POST">
    {{-- Adicionando o token CSRF para proteger contra ataques CSRF --}}
    @csrf
    {{-- Especificando que o método HTTP é PUT para atualização do recurso --}}
    @method('PUT')

    <div>
        <label for="nome">Nome:</label><br>
        <input type="text" name="nome" id="nome" value="{{ $produto->nome }}">
    </div>

    <div>
        <label for="descricao">Descrição:</label><br>
        <textarea name="descricao" id="descricao">{{ $produto->descricao }}</textarea>
    </div>

    <div>
        <label for="preco">Preço:</label><br>
        <input type="number" name="preco" id="preco" step="0.01" value="{{ $produto->preco }}">
    </div>

    <div>
        <label for="quantidade">Quantidade:</label><br>
        <input type="number" name="quantidade" id="quantidade" value="{{ $produto->quantidade }}">
    </div>

    <br>

    <button type="submit">Atualizar</button>
</form>

<button>
    <a href="{{ route('produtos.index') }}" style="text-decoration: none; color: inherit;">
        Voltar
    </a>
</button>