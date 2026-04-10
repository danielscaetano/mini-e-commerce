<x-layout>

    <form method="POST" action="{{ route('produtos.store', $loja->id) }}" id="formulario" class="container mt-4">
        @csrf

        <div class="card shadow">
            <div class="card-body">

                <h4 class="mb-4">Cadastrar Produto</h4>


                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Categoria</label>
                        <select name="id_categoria" class="form-select" required>
                            <option value="">Selecione uma opção</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">
                                    {{ $categoria->nome_categoria }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nome do Produto</label>
                        <input type="text" name="nome_produto" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <input type="text" name="descricao" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Valor do Produto</label>
                    <input type="number" step="0.01" name="valor" class="form-control" required>
                </div>

                <div class="d-grid">
                    <button id="salvar" type="submit" class="btn btn-success">
                        Salvar produto
                    </button>
                </div>

            </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const botaoSalvar = document.getElementById('salvar');
            const formulario = document.getElementById('formulario');

            formulario.addEventListener('submit', function() {
                console.log("foi enviado");
                botaoSalvar.disabled = true;
                botaoSalvar.innerText = "Salvando...";
            });
        });
    </script>

</x-layout>
