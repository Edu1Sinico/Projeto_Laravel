<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- O @yield permite que cada página defina seu título. Se ela não definir, utilize CRUD de Produtos. --}}
    <title>@yield('title', 'CRUD de Produtos')</title>
</head>

<body>
    <main>
        {{-- O @yield('content') é um espaço reservado onde o conteúdo específico de cada página será inserido. Cada página que estende este layout pode definir seu próprio conteúdo dentro da seção 'content' --}}
        @yield('content')
    </main>
</body>

</html>