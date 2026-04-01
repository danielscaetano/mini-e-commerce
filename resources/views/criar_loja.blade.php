<x-layout>
    <x-slot:title>
        Mini E-commerce - Criar Loja
    </x-slot:title>
    <div class="max-w-2xl mx-auto">

        <h1 class="text-3xl font-bold mt-8">Criar Loja</h1>

        <form method="POST" id="formulario" action="{{ route('loja.store') }}">
            @csrf

            <div class="card bg-base-100 shadow mt-8">
                <div class="card-body">

                    <div class="form-control w-full">
                        <textarea 
                            name="nome_loja" 
                            placeholder="Qual o nome da loja?" 
                            class="textarea textarea-bordered w-full resize-none"
                            rows="4" 
                            maxlength="255" 
                            required></textarea>
                    </div>

                    <div class="mt-4 flex items-center justify-end">
                        <button id="salvar" type="submit" class="btn btn-primary btn-sm">
                            Criar loja
                        </button>
                    </div>

                </div>
            </div>
        </form>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const botao_salvar = document.getElementById('salvar');
            const formulario = document.getElementById('formulario');

            formulario.addEventListener('submit', function() {
                console.log("foi enviado");
                botao_salvar.disabled = true;
            });
        });
    </script>
</x-layout>