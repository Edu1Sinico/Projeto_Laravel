<h1>Meu Currículo</h1>

{{-- Mensagens de sucesso ou erro --}}
@if (session('success'))
<p>{{ session('success') }}</p>
@endif

@if (session('error'))
<p>{{ session('error') }}</p>
@endif


{{-- Verifica se o currículo existe, caso contrário, solicita para cadastrar o currículo --}}
@if ($curriculo)

<p>
    Arquivo atual:
    {{ $curriculo->arquivoNome }}
</p>

{{-- Monta a URL pública do PDF --}}
<a href="{{ asset('storage/' .$curriculo->arquivoCaminho) }}" target="_blank">
    Visualizar currículo
</a>

@else

<p>Nenhum currículo cadastrado.</p>

<a href="{{ route('curriculos.create') }}">
    Enviar currículo
</a>

@endif

<br>

{{-- link para substituir o currículo --}}
<a href="{{ route('curriculos.create') }}">
    Substituir currículo
</a>

{{-- remover currículo --}}
<form
    action="{{ route('curriculos.destroy') }}"
    method="post"
    onsubmit="return confirm('Tem certeza que deseja remover seu currículo?')">

    @csrf
    @method('DELETE')

    <button type="submit">
        Remover currículo
    </button>

</form>