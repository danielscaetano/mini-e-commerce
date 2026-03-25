<x-layout>
    <form method="POST" action="{{ route('produtos.store') }}" id="formulario">
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
                    <input type="number" step="0.01" name="valor" required>
                </td>
            </tr>
            <tr>
                <td>
                    <button id="salvar" type="submit">Salvar produto</button>
                </td>
            </tr>
        </table>
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
</x-layout>
