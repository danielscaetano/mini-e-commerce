<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home', compact('produtos', 'pedidos'));
    }

    public function marcarComoPago($id)
    {
        $pedido = Pedido::find($id);

        if (!$pedido) {
            return redirect()->back()->with('error', 'Pedido não encontrado.');
        }

        $pedido->update([
            'pago' => true,
        ]);

        return redirect()->back()->with('success', 'Pedido marcado como pago!');
    }


    /**
     * Show the form for creating a new resource.
     */
    
}
