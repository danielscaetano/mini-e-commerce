    <x-layout>
        <x-slot:title>
            Produtos
        </x-slot:title>
        <a href="{{ route('categorias.create', $loja->id)}}" class="btn btn-primary btn-sm">Criar categoria</a>
        @forelse ($categorias as $categoria)
            <div class="card bg-base-100 shadow p-4 flex flex-col justify-between">
                <div>
                    <span class="font-bold">{{ $categoria->nome_categoria }}</span>
                </div>
                <div class="border rounded-md p-4 mb-4 shadow-sm">
                    <div class="flex gap-2">
                    @if (!$categoria->existePedido)
                            <a href="{{ route('categorias.edit', [$loja->id, $categoria->id]) }}" class="btn btn-primary">Editar</a>
                            <form action="{{ route('categorias.destroy', [$categoria->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Deletar</button>
                            </form>
                        @endif                            
                    </div>
                </div>
            </div>
        @empty
            <p>Nenhum uma categora disponível.</p>
        @endforelse
    </x-layout>
