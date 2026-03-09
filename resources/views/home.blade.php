<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mini e-commerce
    </title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
 

    <x-layout>
        <x-slot:title>
            bem Vindo
        </x-slot:title>
        <form action="{{ route('carrinho.adicionar') }}" method="POST">
    @csrf
        Qual o nome do Cliente?<input type="text"  name="nome_cliente" required>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse ($produtos as $produto)
            <div class="card bg-base-100 shadow p-4 flex flex-col justify-between">
                <div>
                    <span class="font-bold">{{ $produto->nome_produto }}</span>
                    <p>{{ $produto->descricao }}</p>
                    <span class="text-sm text-gray-500">{{ $produto->categoria->nome_categoria }}</span>
                    <span class="block mt-2 font-semibold">R$ {{ number_format($produto->valor, 2, ',', '.') }}</span>
                </div>

                <div class="mt-4 flex items-center gap-2">
                    <label class="flex items-center gap-1">
                        <input type="checkbox" name="produtos[{{ $produto->id }}][selecionado]" value="1" class="checkbox">
                        Selecionar
                    </label>

                    <input type="number" name="produtos[{{ $produto->id }}][quantidade]" value="1" min="1" class="input input-bordered w-20">
                </div>
            </div>
        @empty
            <p>Nenhum produto disponível.</p>
        @endforelse
    </div>

    <div class="mt-6 text-right">
        <button type="submit" class="btn btn-primary">Adicionar ao carrinho</button>
    </div>
</form>
@foreach ($pedidos as $pedido)
<form action="{{ route('marcarcomopago', $pedido->id) }}" method="POST">
    @csrf
    <div class="card bg-base-200 shadow p-4 mb-4">
        <div class="flex justify-between">
            <span class="font-bold">{{ $pedido->nome_cliente }}</span>
            <span class="text-green-600 font-bold">
                Total: R$ {{ number_format($pedido->total, 2, ',', '.') }}
                <button type="submit" class="btn btn-primary">Pagar</button>
            </span>
        </div>
        <ul class="mt-2 text-sm">
            @foreach ($pedido->itens as $item)
                <li>{{ $item->produto->nome_produto }} ({{ $item->quantidade }}x)</li>
            @endforeach
        </ul>
    </div>
</form>
@endforeach
    </x-layout>
</body>
</html>