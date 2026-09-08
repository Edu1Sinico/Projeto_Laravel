<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- O @yield permite que cada página defina seu título. Se ela não definir, utilize CRUD de Produtos. --}}
    <title>@yield('title', 'CRUD de Produtos')</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body>
    <main class="container py-4">
        {{-- O @yield('content') é um espaço reservado onde o conteúdo específico de cada página será inserido. Cada página que estende este layout pode definir seu próprio conteúdo dentro da seção 'content' --}}
        @yield('content')
    </main>
</body>

</html>