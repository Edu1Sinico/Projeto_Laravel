<h1>Cadastrar Vaga</h1>

@if($errors->any())
<div>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(session('error'))
<p>{{session('error')}}</p>
@endif

<form action="{{ route('vagas.store') }}" method="post">
    @csrf

    <div>
        <label for="titulo">Título:</label>

        <input
            type="text"
            name="titulo"
            id="titulo"
            value="{{ old('titulo') }}">
    </div>

    <div>
        <label for="descricao">Descrição:</label>

        <textarea
            name="descricao"
            id="descricao">{{ old('descricao') }}</textarea>
    </div>

    <div>
        <label for="localizacao">Localização:</label>

        <input
            type="text"
            name="localizacao"
            id="localizacao"
            value="{{ old('localizacao') }}">
    </div>

    <div>
        <label for="salario">Salário:</label>

        <input
            type="number"
            name="salario"
            id="salario"
            step="0.01"
            value="{{ old('salario') }}">
    </div>

    <button type="submit">
        Cadastrar vaga
    </button>
</form>