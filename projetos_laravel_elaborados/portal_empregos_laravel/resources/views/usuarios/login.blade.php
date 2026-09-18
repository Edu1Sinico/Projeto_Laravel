<h1>Login</h1>

@if($errors->any())
<div class="">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('usuarios.login.entrar') }}" method="post">
    @csrf

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

    <button type="submit">
        Entrar
    </button>
</form>