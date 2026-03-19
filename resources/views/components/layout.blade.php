
<!DOCTYPE html>
<html lang="en" data-theme="lofi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title . ' - Chirper' : 'Chirper' }}</title>
    <link rel="preconnect" href="<https://fonts.bunny.net>">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col bg-base-200 font-sans">
    <nav class="navbar bg-base-100">
        <div class="navbar-start">
            <a href="/" class="btn btn-ghost text-xl">🐦 mini e-commerce</a>
        </div>
        <div class="navbar-end gap-2">
            <a href="{{ route ("categorias.create") }}" class="btn btn-primary btn-sm">Criar categoria</a>
            <a href="{{ route("produtos.index") }}" class="btn btn-primary btn-sm">Produtos</a>
            <a href="{{ route("cadastro.index") }}" class="btn btn-primary btn-sm">Cadastre-se</a>
            <a href="{{ route("login.index") }}" class="btn btn-primary btn-sm">Logar-se</a>
        </div>
    </nav>

    <main class="flex-1 container mx-auto px-4 py-8">
        {{ $slot }}
    </main>

    <footer class="footer footer-center p-5 bg-base-300 text-base-content text-xs">
        <div>
            <p>© {{ date('Y')}} mini e-commerce</p>
        </div>
    </footer>
</body>
</html>