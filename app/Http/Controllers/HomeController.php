<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        $produtos = Produto::all();

        $pedidosQuery = Pedido::query();

        if ($request->filtro_pago !== null) {
            if ($request->filtro_pago === 'pago') {
                $pedidosQuery->where('pago', 1);
            }

            if ($request->filtro_pago === 'nao_pago') {
                $pedidosQuery->where('pago', 0);
            }
        }

        if ($request->busca !== null) {
            $pedidosQuery->whereLike('nome_cliente', '%' . $request->busca . '%');
        }

        $pedidos = $pedidosQuery->paginate(5)->withQueryString();

        $filtroStatusPagamento = [
            'pago' => 'Pago',
            'nao_pago' => 'Não pago',
        ];

        return view('home', compact('produtos', 'pedidos', 'filtroStatusPagamento'));
    }
}
