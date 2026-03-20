<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $produtos = Produto::all();
        $pedido = Pedido::query();

        if ($request->filled('nome_cliente')) {
            $pedido->where('nome_cliente', 'like', '%' . $request->nome_cliente . '%');
        }
        $todosOsPedidosFiltrados = $pedido->latest()->get();

        $pedidos = (clone $pedido)->where('pago', false)
                                 ->latest()
                                 ->paginate(5, ['*'], 'pendentes');

        $pedidos_pago = (clone $pedido)->where('pago', true)
                                      ->latest()
                                      ->paginate(5, ['*'], 'pagos');

        return view('home', compact('produtos', 'pedidos', 'pedidos_pago'));
    }
    public function marcarComoPago($id)
    {
        $pedido = Pedido::find($id);

        if (! $pedido) {
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
    }

}
