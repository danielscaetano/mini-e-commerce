<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mini e-commerce
    </title>
    <link rel="preconnect" href="<https://fonts.bunny.net>">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>


    <form method="POST" id="formulario"action="{{ route('categorias.store', $loja->id)  }}">

        <x-layout>
            <x-slot:title>
                Home Feed
            </x-slot:title>
            <div class="max-w-2xl mx-auto">

                <h1 class="text-3xl font-bold mt-8">categoria</h1>

                <div class="card bg-base-100 shadow mt-8">
                    <div class="card-body">

                        @csrf
                        <div class="form-control w-full">
                            <textarea name="nome_categoria" placeholder="qual categoria?" class="textarea textarea-bordered w-full resize-none"
                                rows="4" maxlength="255" required></textarea>
                        </div>

                        <div class="mt-4 flex items-center justify-end">
                            <button id="salvar"type="submit" class="btn btn-primary btn-sm">
                                Categoria
                            </button>
                        </div>

                    </div>
                </div>

        </x-layout>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const botao_salvar = document.getElementById('salvar');
            const formulario = document.getElementById('formulario');

            formulario.addEventListener('submit', function() {
                console.log("foi enviadado");
                botao_salvar.disabled = true;
            })
        })
    </script>

</html>
