<?php

namespace App\Http\Controllers;

use App\Models\Loja;
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;

class LojaController extends Controller
{
    public function index(Request $request)
    {
        $lojas = Loja::where('id_user', auth()->id())->get();

        return view('listar_loja', compact('lojas'));
    }

    public function create(Request $request)
    {
        return view('criar_loja');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome_loja' => 'required|string|max:255',
        ]);

        Loja::create([
            'nome_loja' => $validated['nome_loja'],
            'id_user' => auth()->id(),
        ]);

        return redirect('/')->with('success', 'categoria criada!');
    }

    public function painel(Request $request, $id)
{
    $loja = Loja::findOrFail($id);

    $produtos = Produto::where('id_loja', $loja->id)->get();

    $pedidosQuery = Pedido::where('id_loja', $loja->id);

    if (auth()->id() != $loja->id_user) {
        $pedidosQuery->where('id_user', auth()->id());
    }

    if ($request->filtro_pago) {
        $pedidosQuery->where('pago', $request->filtro_pago === 'pago' ? 1 : 0);
    }

    if ($request->busca) {
        $pedidosQuery->where('nome_cliente', 'like', '%' . $request->busca . '%');
    }

    $pedidos = $pedidosQuery->paginate(5);

    $pedidos->appends([
        'filtro_pago' => $request->filtro_pago,
        'busca' => $request->busca,
    ]);

    $filtroStatusPagamento = [
        'pago' => 'Pago',
        'nao_pago' => 'Não pago',
    ];

    return view("minha_loja", compact('produtos', 'pedidos', 'filtroStatusPagamento', 'loja'));
}

}
