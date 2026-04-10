<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title . ' - Chirper' : 'Chirper' }}</title>

    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="d-flex flex-column min-vh-100 bg-light">

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a href="/" class="navbar-brand">🐦 mini e-commerce</a>

            <div class="d-flex align-items-center gap-2">

                {{ $navExtra ?? '' }}

                <a href="{{ route('loja.index') }}" class="btn btn-primary btn-sm">
                    Minha Loja
                </a>


                @auth
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            Sair
                        </button>
                    </form>
                @endauth

            </div>
        </div>
    </nav>

    @if ($errors->has('produto'))
        <div class="container mt-3">
            <div class="alert alert-danger">
                {{ $errors->first('produto') }}
            </div>
        </div>
    @endif


    <main class="flex-fill container py-4">
        {{ $slot }}
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <small>© {{ date('Y') }} mini e-commerce</small>
    </footer>

</body>

</html>
