@props(['produto'])

<div class="card bg-base-100 shadow">
    <div class="card-body">
        <div class="flex space-x-3">
            <div class="min-w-0">
                <p class="mt-1">
                    {{ $produto->nome_produto }}
                    {{ $produto->descrição }}
                    {{ $produto->categoria->nome_categoria }}
                    {{ $produto->valor }}
                </p>
            </div>
        </div>
    </div>
</div>
