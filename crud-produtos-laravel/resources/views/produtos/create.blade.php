<h1>Criar Produto</h1>

{{-- Enviando o formulário para a rota 'produtos.store' usando o método POST --}}
<form action="{{ route('produtos.store') }}" method="POST">
    {{-- Adicionando o token CSRF para proteger contra ataques CSRF --}}
    @csrf

    <div>
        <label for="nome">Nome:</label><br>
        <input type="text" name="nome" id="nome">
    </div>

    <div>
        <label for="descricao">Descrição:</label><br>
        <textarea name="descricao" id="descricao"></textarea>
    </div>

    <div>
        <label for="preco">Preço:</label><br>
        <input type="number" name="preco" id="preco" step="0.01">
    </div>

    <div>
        <label for="quantidade">Quantidade:</label><br>
        <input type="number" name="quantidade" id="quantidade">
    </div>

    <br>

    <button type="submit">Cadastrar</button>
</form>

<button>
    <a href="{{ route('produtos.index') }}" style="text-decoration: none; color: inherit;">
        Voltar
    </a>
</button>