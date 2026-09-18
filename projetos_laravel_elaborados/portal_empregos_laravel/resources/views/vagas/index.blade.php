<h1>Minhas Vagas</h1>

<a href="{{ route('vagas.create') }}">
    Cadastrar nova vaga
</a>

{{-- Verifica se a empresa possui vagas --}}
@if ($vagas->isEmpty())

<p>Nenhuma vaga cadastrada.</p>

@else
@foreach ($vagas as $vaga)

<div>
    <h2>{{ $vaga->titulo}}</h2>

    <p>
        <strong>Status:</strong>
        {{ $vaga->statusVaga->status }}
    </p>

    <p><strong>Localização:</strong> {{$vaga->localizacao}}</p>

    <p><strong>Salário:</strong>

        @if ($vaga->salario)
        R$ {{ number_format($vaga->salario, 2, ',', '.') }}
        @else
        Não informado
        @endif
    </p>

    <a href="{{ route('vagas.show', $vaga) }}">
        Visualizar
    </a>

    <br>

    <a href="{{ route('vagas.edit', $vaga) }}">
        Editar
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

</div>

@endforeach

@endif