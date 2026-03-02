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

 

<x-layout>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="{{   route('produtos.store') }}" >
        @csrf
    <table>
        <tr>
            <label>Categoria</a>
            <select name="id_categoria" required>
                <option value="">Selecione uma Opção</option>
                @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->nome_categoria }}</option>
                @endforeach
            </select>
            <td>
                <label>Nome do Produto</label>
                <input type="text" name="nome_produto" required>
            </td>
        </tr>
        <tr>    
            <td>
                <label>Nome do descrição</label>
                <input type="text" name="descricao">
            </td>
        </tr>
        <tr>    
            <td>
                <label>Valor do Produto</label>
                <input type="number" step="0.01"  name="valor">
            </td>
        </tr>
        <tr>    
            <td>
                <button type="submit">Salvar produto</button>
            </td>
        </tr>
    </table>
</form>
</body>
</html>

</x-layout>
</body>
</html>