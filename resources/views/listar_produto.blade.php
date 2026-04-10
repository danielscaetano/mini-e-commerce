    <x-layout>
        <x-slot:title>
            Produtos
        </x-slot:title>
        <a href="{{ route('produtos.create', $loja->id) }}" class="btn btn-primary btn-sm">Criar produto</a>
        @forelse ($produtos as $produto)
            <div class="card bg-base-100 shadow p-4 flex flex-col justify-between">
                <div>
                    <span class="font-bold">{{ $produto->nome_produto }}</span>
                    <p>{{ $produto->descricao }}</p>
                    <span class="text-sm text-gray-500">{{ $produto->categoria->nome_categoria }}</span>
                    <span class="block mt-2 font-semibold">R$ {{ number_format($produto->valor, 2, ',', '.') }}</span>
                </div>
                <div class="border rounded-md p-4 mb-4 shadow-sm">
                    <div class="flex gap-2">
                        @if (!$produto->existePedido)
                            <a href="{{ route('produtos.edit', [$loja->id,$produto->id]) }}" class="btn btn-primary">Editar</a>
                            <form action="{{ route('produtos.destroy',[$loja->id, $produto->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Deletar</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p>Nenhum produto disponível.</p>
        @endforelse
    </x-layout>
