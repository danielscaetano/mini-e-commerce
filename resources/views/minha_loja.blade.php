<x-layout>
    <x-slot:navExtra>
        @if ($loja->id_user === auth()->id())
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

    <form action="{{ route('carrinho.adicionar', $loja->id) }}" method="POST">
        @csrf

        

        <div class="row g-3">
            @forelse ($produtos as $produto)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h6 class="fw-bold">{{ $produto->nome_produto }}</h6>
                                <p class="mb-1">{{ $produto->descricao }}</p>
                                <small class="text-muted">{{ $produto->categoria->nome_categoria }}</small>
                                <div class="mt-2 fw-semibold">
                                    R$ {{ number_format($produto->valor, 2, ',', '.') }}
                                </div>
                            </div>

                            <div class="mt-3 d-flex align-items-center gap-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        name="produtos[{{ $produto->id }}][selecionado]" value="1">
                                    <label class="form-check-label">Selecionar</label>
                                </div>

                                <input type="number" name="produtos[{{ $produto->id }}][quantidade]" value="1"
                                    min="1" class="form-control form-control-sm w-25">
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p>Nenhum produto disponível.</p>
            @endforelse
        </div>

        <div class="mt-4 text-end">
            <button type="submit" class="btn btn-primary">
                Adicionar ao carrinho
            </button>
        </div>
    </form>

    <hr class="my-4">

    <form action="{{ route('loja.show', $loja->id) }}" method="GET" class="row g-3">
        <div class="col-12 col-md-6">
            <label class="form-label">Status Pagamento:</label>
            <select name="filtro_pago" class="form-select">
                <option>Selecione uma opção</option>
                @foreach ($filtroStatusPagamento as $value => $descricao)
                    <option value="{{ $value }}" @selected(request()->filtro_pago === $value)>
                        {{ $descricao }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-12 col-md-6">
            <label class="form-label">Nome do cliente:</label>
            <input type="text" name="busca" placeholder="Pesquisar..." value="{{ request('busca') }}"
                class="form-control">
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary w-100">
                Filtrar
            </button>
        </div>
    </form>

    @foreach ($pedidos as $pedido)
        <div class="card shadow-sm p-3 mt-3">
            <div class="d-flex justify-content-between align-items-center">
                <span class="fw-bold">{{ $pedido->nome_cliente }}</span>

                <div class="text-success fw-bold d-flex align-items-center gap-2">
                    <span>
                        Total: R$ {{ number_format($pedido->total(), 2, ',', '.') }}
                    </span>

                    @if ($pedido->pago === 0)
                        <form action="{{ route('marcarComoPago', $pedido->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">
                                Pagar
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <ul class="mt-2 mb-0 small">
                @foreach ($pedido->itens as $item)
                    <li>{{ $item->produto->nome_produto }} ({{ $item->quantidade }}x)</li>
                @endforeach
            </ul>
        </div>
    @endforeach

    <div class="mt-3">
        {{ $pedidos->links() }}
    </div>
</x-layout>
