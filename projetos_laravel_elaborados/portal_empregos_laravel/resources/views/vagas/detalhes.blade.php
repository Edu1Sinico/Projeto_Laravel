<h1>{{ $vaga->titulo }}</h1>

<p>
    <strong>Descrição:</strong>
    {{ $vaga->descricao }}
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
    <strong>Status:</strong>
    {{ $vaga->statusVaga->status }}
</p>

<form
    action="{{ route('inscricoes.store', $vaga) }}"
    method="POST">

    @csrf

    <button type="submit">
        Candidatar-se
    </button>
</form>

<a href="{{ route('vagas.disponiveis') }}">
    Voltar para vagas
</a>