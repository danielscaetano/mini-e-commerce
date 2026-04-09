<x-layout>
    <x-slot:navExtra>
        @if ($loja)
            <a href="{{ route('categorias.index', $loja->id) }}" class="btn btn-primary btn-sm">
                Criar categoria
            </a>
            <a href="{{ route('produtos.index', $loja->id) }}" class="btn btn-primary btn-sm">
                Produtos
            </a>
        @endif
    </x-slot:navExtra>
    <x-slot:title>

        bem Vindo
    </x-slot:title>

    <form action="{{ route('carrinho.adicionar',$loja->id ) }}" method="POST">

        @csrf
        Qual o nome do Cliente?
        <input type="text" name="nome_cliente" required>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse ($produtos as $produto)
                <div class="card bg-base-100 shadow p-4 flex flex-col justify-between">
                    <div>
                        <span class="font-bold">{{ $produto->nome_produto }}</span>
                        <p>{{ $produto->descricao }}</p>
                        <span class="text-sm text-gray-500">{{ $produto->categoria->nome_categoria }}</span>
                        <span class="block mt-2 font-semibold">R$
                            {{ number_format($produto->valor, 2, ',', '.') }}</span>
                    </div>

                    <div class="mt-4 flex items-center gap-2">
                        <label class="flex items-center gap-1">
                            <input type="checkbox" name="produtos[{{ $produto->id }}][selecionado]" value="1"
                                class="checkbox">
                            Selecionar
                        </label>

                        <input type="number" name="produtos[{{ $produto->id }}][quantidade]" value="1"
                            min="1" class="input input-bordered w-20">
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

    <br>

    <form action="{{ route('loja.show', $loja->id) }}" method="GET" class="row">
        <div class="col">
            <label>Status Pagamento:</label>
            <select name="filtro_pago" class="form-select">
                <option>Selecione uma opção</option>
                @foreach ($filtroStatusPagamento as $value => $descricao)
                    <option value="{{ $value }}" @selected(request()->filtro_pago === $value)>
                        {{ $descricao }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col">
            <label>Nome do cliente:</label>
            <input type="text" name="busca" placeholder="Pesquisar..." value="{{ request('busca') }}"
                class="form-control">
        </div>

        <div class="row mt-2">
            <button type="submit" class="form-control btn btn-primary">Filtrar</button>
        </div>
    </form>
    @foreach ($pedidos as $pedido)
        <div class="card bg-base-200 shadow p-4 mb-4">
            <div class="flex justify-between">
                <span class="font-bold">{{ $pedido->nome_cliente }}</span>
                <span class="text-green-600 font-bold">
                    Total: R$ {{ number_format($pedido->total(), 2, ',', '.') }}
                    @if ($pedido->pago === 0)
                        <form action="{{ route('marcarComoPago', $pedido->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Pagar</button>
                        </form>
                    @endif
                </span>
            </div>
            <ul class="mt-2 text-sm">
                @foreach ($pedido->itens as $item)
                    <li>{{ $item->produto->nome_produto }} ({{ $item->quantidade }}x)</li>
                @endforeach
            </ul>
        </div>
    @endforeach
    {{ $pedidos->links() }}
</x-layout>
