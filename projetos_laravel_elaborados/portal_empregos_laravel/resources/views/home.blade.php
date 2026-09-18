<h1>Página Inicial para Testes</h1>

@if(session('success'))
<div class="">
    {{ session('success') }}
</div>
<br>
@endif

<form action="{{ route('usuarios.logout') }}" method="POST">
    @csrf

    <button type="submit">
        Sair
    </button>
</form>