<h1>Enviar Currículo</h1>

@if($errors->any())
<div>
    <ul>
        @foreach( $errors->all() as $error)
        <li> {{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session('success'))
<p>{{ session('success') }}</p>
@endif

{{-- O "enctype="multipart/form-data" permite com o navegador envie corretamente arquivos via formulário HTML --}}
<form action=" {{ route('curriculos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div>
        <label for="curriculo">Currículo em PDF:</label>

        <input
            type="file"
            name="curriculo"
            id="curriculo"
            accept=".pdf">
    </div>

    <button type="submit">
        Enviar currículo
    </button>

</form>