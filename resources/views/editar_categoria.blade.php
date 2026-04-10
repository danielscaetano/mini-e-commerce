<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mini e-commerce</title>

    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <x-layout>
        <x-slot:title>
            Home Feed
        </x-slot:title>

        <div class="max-w-2xl mx-auto mt-8">

            <h1 class="text-3xl font-bold mb-4">Categoria</h1>

            <form method="POST" id="formulario"
                action="{{ route('categorias.update', [$loja->id, $categoria->id]) }}">
                @csrf
                @method('PUT')

                <input type="hidden" name="id_loja" value="{{ $loja->id }}">

                <div class="card bg-base-100 shadow">
                    <div class="card-body">

                        <div class="form-control w-full">
                            <textarea name="nome_categoria"
                                class="textarea textarea-bordered w-full resize-none"
                                rows="4"
                                maxlength="255"
                                required>{{ old('nome_categoria', $categoria->nome_categoria) }}</textarea>
                        </div>

                        <div class="mt-4 flex justify-end">
                            <button id="salvar" type="submit" class="btn btn-primary btn-sm">
                                Categoria
                            </button>
                        </div>

                    </div>
                </div>

            </form>

        </div>
    </x-layout>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const botao_salvar = document.getElementById('salvar');
            const formulario = document.getElementById('formulario');

            formulario.addEventListener('submit', function() {
                console.log("foi enviado");
                botao_salvar.disabled = true;
            })
        })
    </script>

</body>

</html>