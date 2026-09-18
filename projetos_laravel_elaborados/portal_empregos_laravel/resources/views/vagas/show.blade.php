<h1> {{ $vaga->titulo }} </h1>

<p>
    <strong>Status:</strong>
    {{ $vaga->statusVaga->status }}
</p>

<p>
    <strong>Descrição:</strong>
    {{ $vaga->descricao}}
</p>

<p>
    <strong>Localização:</strong>
    {{ $vaga->localizacao }}
</p>

<p>
    <strong>Salário:</strong>

    @if ($vaga->salario)
    R$ {{ number_format($vaga->salario, 2, ',', '.') }}
    @else
    Não informado
    @endif
</p>

<p>
    <strong>Data de criação:</strong>
    {{ $vaga->created_at }}
</p>

<a href="{{ route('vagas.index') }}">
    Voltar
</a>

<br>

<a href="{{ route('vagas.edit', $vaga) }}">
    Editar vaga
</a>

<br><br>

<form
    action="{{ route('vagas.fechar', $vaga) }}"
    method="POST">

    @csrf
    @method('PATCH')

    <button type="submit">
        Fechar vaga
    </button>
</form>


<form
    action="{{ route('vagas.destroy', $vaga) }}"
    method="POST"
    onsubmit="return confirm('Tem certeza que deseja excluir esta vaga?')">

    @csrf
    @method('DELETE')

    <button type="submit">
        Excluir vaga
    </button>
</form>