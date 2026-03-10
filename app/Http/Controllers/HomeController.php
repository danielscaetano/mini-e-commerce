<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Produto;

class HomeController extends Controller
{
    public function home()
    {
        $produtos = Produto::with('categoria')->get();

        $pedidos = Pedido::with('itens.produto')
            ->where('pago', false)
            ->get();

        foreach ($pedidos as $pedido) {
            $pedido->total = $pedido->itens->sum(function ($item) {
                return $item->produto->valor * $item->quantidade;
            });
        }

        return view('home', compact('produtos', 'pedidos'));
    }
}
