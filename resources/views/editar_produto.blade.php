<x-layout>
<form method="POST" action="{{ route('produtos.update', $produto->id) }}" id="formulario">
    @csrf
    @method('PUT')

    <table>
        <tr>
            <td>
                <label>Categoria</label>
                <select name="id_categoria" required>
                    <option value="">Selecione uma Opção</option>

                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}"
                        {{ $produto->id_categoria == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nome_categoria }}
                        </option>
                    @endforeach

                </select>
            </td>
        </tr>

        <tr>
            <td>
                <label>Nome do Produto</label>
                <input type="text" name="nome_produto"
                       value="{{ $produto->nome_produto }}" required>
            </td>
        </tr>

        <tr>
            <td>
                <label>Descrição</label>
                <input type="text" name="descricao"
                       value="{{ $produto->descricao }}">
            </td>
        </tr>

        <tr>
            <td>
                <label>Valor do Produto</label>
                <input type="number" step="0.01"
                       name="valor"
                       value="{{ $produto->valor }}" required>
            </td>
        </tr>

        <tr>
            <td>
                <button id="salvar" type="submit">Atualizar produto</button>
            </td>
        </tr>
    </table>
</form>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const botao_salvar = document.getElementById('salvar');
    const formulario = document.getElementById('formulario');

    formulario.addEventListener('submit', function () {
        botao_salvar.disabled = true;
    })
})
</script>
</x-layout>