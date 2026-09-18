<h1>Editar vaga</h1>

@if ($errors->any())
<div>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('vagas.update', $vaga) }}" method="post">
    @csrf
    @method('PUT')

    <div>
        <label for="titulo">Título:</label>

        <input
            type="text"
            name="titulo"
            id="titulo"
            value="{{ old('titulo', $vaga->titulo) }}">
    </div>

    <div>
        <label for="descricao">Descrição:</label>

        <textarea
            name="descricao"
            id="descricao">{{ old('descricao', $vaga->descricao) }}</textarea>
    </div>

    <div>
        <label for="localizacao">Localização:</label>

        <input
            type="text"
            name="localizacao"
            id="localizacao"
            value="{{ old('localizacao', $vaga->localizacao) }}">
    </div>

    <div>
        <label for="salario">Salário:</label>

        <input
            type="number"
            name="salario"
            id="salario"
            step="0.01"
            value="{{ old('salario', $vaga->salario) }}">
    </div>

    <button type="submit">
        Salvar alterações
    </button>
</form>