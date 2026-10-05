<h1>Candidaturas - {{ $vaga->titulo }}</h1>

@if ($inscricoes->isEmpty())

<p>Nenhuma candidatura encontrada.</p>

@else

@foreach ($inscricoes as $inscricao)

<div>

    <h2>{{ $inscricao->candidato->nome }}</h2>

    <p>
        <strong>E-mail:</strong>
        {{ $inscricao->candidato->email }}
    </p>

    <p>
        <strong>Status:</strong>
        {{ $inscricao->statusInscricao->status }}
    </p>

    <p>
        <strong>Data da candidatura:</strong>
        {{ $inscricao->created_at }}
    </p>

    @if ($inscricao->candidato->curriculo)

    <a
        href="{{ asset('storage/' . $inscricao->candidato->curriculo->arquivoCaminho) }}"
        target="_blank">

        Visualizar currículo
    </a>

    @else

    <p>Candidato sem currículo cadastrado.</p>

    @endif

    @if ($inscricao->statusInscricao->status === 'pendente')

    <form
        action="{{ route('inscricoes.aprovar', $inscricao) }}"
        method="POST">

        @csrf
        @method('PATCH')

        <button type="submit">
            Aprovar
        </button>
    </form>

    <form
        action="{{ route('inscricoes.rejeitar', $inscricao) }}"
        method="POST">

        @csrf
        @method('PATCH')

        <button type="submit">
            Rejeitar
        </button>
    </form>

    @endif

</div>

<hr>

@endforeach

@endif