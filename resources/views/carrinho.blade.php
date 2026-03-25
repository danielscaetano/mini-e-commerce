<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mini e-commerce
    </title>
    <link rel="preconnect" href="<https://fonts.bunny.net>">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body><x-layout>
        <x-slot:title>
            {{ $produto->nome_produto }}
        </x-slot:title>
        <form>
            <div class="card bg-base-100 shadow p-4">
                <h1 class="text-2xl font-bold">{{ $produto->nome_produto }}</h1>
                <p>Categoria: {{ $produto->categoria->nome_categoria }}</p>
                <p>{{ $produto->descrição }}</p>
                <p class="text-right font-bold">R$ {{ number_format($produto->valor, 2, ',', '.') }}</p>
                <label>Quantidade</label>
                <input type="number" step="1" name="quantidade">
                <button class="text-right font-bold" type="submit">Adicionar ao Carrinho</button>
            </div>
        </form>
    </x-layout>
</body>
