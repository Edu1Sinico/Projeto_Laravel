<h1>Minhas Candidaturas</h1>

@if (session('success'))
<p>{{ session('success') }}</p>
@endif

@if (session('error'))
<p>{{ session('error') }}</p>
@endif

@if ($inscricoes->isEmpty())

<p>Você ainda não realizou nenhuma candidatura.</p>

@else

@foreach ($inscricoes as $inscricao)

<div>
    <h2>{{ $inscricao->vaga->titulo }}</h2>

    <p>
        <strong>Localização:</strong>
        {{ $inscricao->vaga->localizacao }}
    </p>

    <p>
        <strong>Status da candidatura:</strong>
        {{ $inscricao->statusInscricao->status }}
    </p>

    <p>
        <strong>Data da candidatura:</strong>
        {{ $inscricao->created_at }}
    </p>
</div>

@endforeach

@endif