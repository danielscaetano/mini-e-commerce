<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use App\Models\Pedido;


class HomeController extends Controller
{
    public function home()
    {
         $produtos = Produto::with('categoria')->get();

        $pedidos = Pedido::with('itens.produto')->get();
        return view("home",[
            "produtos" => $produtos
            ,"pedidos"=> $pedidos
        ]);
        
    }
}
