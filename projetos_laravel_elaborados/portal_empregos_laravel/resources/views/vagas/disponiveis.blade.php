<h1>Vagas Disponíveis</h1>


@foreach ($vagas as $vaga)

<div>
    <h2>{{ $vaga->titulo}}</h2>

    <p>
        <strong>Status:</strong>
        {{ $vaga->statusVaga->status }}
    </p>

    <p>
        <strong>Descrição:</strong>
        {{ $vaga->descricao}}
    </p>


    <p><strong>Localização:</strong> {{$vaga->localizacao}}</p>

    <p><strong>Salário:</strong>

        @if ($vaga->salario)
        R$ {{ number_format($vaga->salario, 2, ',', '.') }}
        @else
        Não informado
        @endif
    </p>

    <p>
        <strong>Data de publicação:</strong>
        {{ $vaga->created_at }}
    </p>

    <form
        action="{{ route('inscricoes.store', $vaga) }}"
        method="POST">

        @csrf

        <button type="submit">
            Candidatar-se
        </button>
    </form>

</div>

@endforeach