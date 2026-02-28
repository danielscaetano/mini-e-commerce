<div>
    <ul>
        @foreach ($categoria as $categorias)
            <li>{{ $categorias->nome_categoria }}</li>
        @endforeach
    </ul>
</div>
