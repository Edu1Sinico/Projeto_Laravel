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

@if (!$inscricao)

<form action="{{ route('inscricoes.store', $vaga) }}" method="POST">
    @csrf

    <button type="submit">
        Candidatar-se
    </button>
</form>

@elseif ($inscricao->statusInscricao->status === 'Desistência')

<form action="{{ route('inscricoes.store', $vaga) }}" method="POST">
    @csrf

    <button type="submit">
        Candidatar-se novamente
    </button>
</form>

@else

<p>
    Você já possui uma candidatura para esta vaga.
</p>

<p>
    <strong>Status:</strong>
    {{ $inscricao->statusInscricao->status }}
</p>

@endif

<!-- 
 Ficaria da seguinte forma:

    Sem inscrição
    → Candidatar-se

    Desistência
    → Candidatar-se novamente

    Pendente
    → Já possui candidatura

    Aprovada
    → Já possui candidatura

    Rejeitada
    → Já possui candidatura
    
 -->

<a href="{{ route('vagas.disponiveis') }}">
    Voltar para vagas
</a>