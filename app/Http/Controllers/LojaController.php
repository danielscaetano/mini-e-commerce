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
        $loja = Loja::where('id_user', auth()->id())
            ->where('id', $id)
            ->first();

        $produtos = Produto::where('id_loja', $loja->id)->get();

        $pedidosQuery = Pedido::where('id_loja', $loja->id);

        if ($request->filtro_pago) {
            $status = ($request->filtro_pago === 'pago') ? 1 : 0;
            $pedidosQuery->where('pago', $status);
        }

        if ($request->busca) {
            $pedidosQuery->where('nome_cliente', 'like', '%' . $request->busca . '%');
        }

        $pedidos = $pedidosQuery->paginate(5);

        $filtroStatusPagamento = [
            'pago' => 'Pago',
            'nao_pago' => 'Não pago',
        ];

        return view("minha_loja", compact('produtos', 'pedidos', 'filtroStatusPagamento', 'loja'));
    }


}
