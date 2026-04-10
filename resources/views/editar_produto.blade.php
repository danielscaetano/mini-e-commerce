<x-layout>

    <form method="POST" action="{{ route('produtos.update', [$loja->id,$produto->id]) }}" id="formulario" class="container mt-4">
        @csrf
        @method('PUT')

        <div class="card shadow">
            <div class="card-body">

                <h4 class="mb-4">Editar Produto</h4>

                <div class="mb-3">
                    <label class="form-label">Categoria</label>
                    <select name="id_categoria" class="form-select" required>
                        <option value="">Selecione uma opção</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}"
                                {{ $produto->id_categoria == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nome_categoria }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nome do Produto</label>
                    <input type="text" name="nome_produto" class="form-control"
                        value="{{ $produto->nome_produto }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <input type="text" name="descricao" class="form-control"
                        value="{{ $produto->descricao }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Valor do Produto</label>
                    <input type="number" step="0.01" name="valor" class="form-control"
                        value="{{ $produto->valor }}" required>
                </div>

                <div class="d-grid">
                    <button id="salvar" type="submit" class="btn btn-primary">
                        Atualizar produto
                    </button>
                </div>

            </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const botao_salvar = document.getElementById('salvar');
            const formulario = document.getElementById('formulario');

            formulario.addEventListener('submit', function() {
                botao_salvar.disabled = true;
            })
        })
    </script>

</x-layout>