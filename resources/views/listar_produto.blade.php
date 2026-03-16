<x-layout>
    <x-slot:title>
        Produtos
    </x-slot:title>
            <a href="{{ route("produtos.create") }}" class="btn btn-primary btn-sm">Criar produto</a>
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
                        <a href="{{ route('produtos.edit', $produto->id) }}"
                            class="input input-bordered w-20">
                            editar
                        </a>                 
                        <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST">
                            @csrf
                            <button type="submit" name="produtos[{{ $produto->id }}]" 
                            class="input input-bordered w-20">deletar</button>
                            @method('DELETE')
                        </form>
                    </div>produtos[{{ $produto->id }}]
                </div>
            @empty
            <p>Nenhum produto disponível.</p>
            @endforelse
</x-layout>
