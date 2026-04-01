<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LojaController extends Controller
{
    public function index(Request $request)
    {

        $lojas = \App\Models\Loja::where('id_user', auth()->id())->get();

        return view('listar_loja', compact('lojas'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('criar_loja');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome_loja' => 'required|string|max:255',
        ]);

        \App\Models\Loja::create([
            'nome_loja' => $validated['nome_loja'],
            'id_user' => auth()->id(),
        ]);

        return redirect('/')->with('success', 'categoria criada!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $loja = Auth::user()->loja;

        $produtos = Produto::where('id_loja', $loja->id)->get();


        $pedidosQuery = Pedido::where('id_loja', $loja->id);

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

        $loja = \App\Models\Loja::where('id_user', auth()->id())
            ->where('id', $id)
            ->firstOrFail();


        return view("minha_loja", compact('produtos', 'pedidos', 'filtroStatusPagamento', 'loja'));

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
