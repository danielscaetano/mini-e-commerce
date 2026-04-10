<x-layout>
    <x-slot:title>
        Loja
    </x-slot:title>

    @forelse ($lojas as $loja)
    
    <div class="card bg-base-100 shadow p-4 flex flex-col justify-between">
        <div>
            <span class="font-bold">{{ $loja->nome_loja }}</span>
        </div>
        <div class="border rounded-md p-4 mb-4 shadow-sm flex gap-2">
            <a href="{{ route('loja.show', $loja->id) }}">Entrar na loja</a>
        </div>
    </div>
@empty
    <p>Nenhuma loja disponível.</p>
@endforelse
</x-layout>