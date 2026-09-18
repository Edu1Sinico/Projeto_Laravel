<h1>Registro</h1>

@if ($errors->any())
<div class="">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error}}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('usuarios.registro.salvar') }}" method="post">
    @csrf
    
    <div>
        <label for="nome">Nome:</label>
        <input
            type="text"
            name="nome"
            id="nome"
            value="{{ old('nome') }}">
    </div>

    <div>
        <label for="email">E-mail:</label>
        <input
            type="email"
            name="email"
            id="email"
            value="{{ old('email') }}">
    </div>

    <div>
        <label for="senha">Senha:</label>
        <input
            type="password"
            name="senha"
            id="senha">
    </div>

    <div>
        <label for="senha_confirmation">Confirmar senha:</label>
        <input
            type="password"
            name="senha_confirmation"
            id="senha_confirmation">
    </div>

    <div>
        <label for="id_tipo_usuario">Tipo de usuário:</label>

        <select name="id_tipo_usuario" id="id_tipo_usuario">
            <option value="">Selecione</option>

            <option value="1">Candidato</option>
            <option value="2">Empresa</option>
        </select>
    </div>

    <button type="submit">
        Cadastrar
    </button>
</form>