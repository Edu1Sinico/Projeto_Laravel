<h1>Meu Currículo</h1>

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