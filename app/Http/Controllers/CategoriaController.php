<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Item;
use App\Models\Loja;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $loja = Loja::where('id_user', auth()->id())
            ->where('id', $id)
            ->first();
        $categorias = Categoria::where('id_loja', $loja->id)->get();
        foreach ($categorias as $categoria) {

            $categoria->existePedido = Item::whereHas('pedido')
                ->whereHas('produto', function ($q) use ($categoria) {
                    $q->where('id_categoria', $categoria->id);
                })
                ->exists();

        }


        return view("listar_categoria", compact('categorias', 'loja'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $loja = Loja::where('id_user', auth()->id())
            ->where('id', $id)
            ->first();

        return view('criar_categoria', compact('loja'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {

        $validated = $request->validate([
            'nome_categoria' => 'required|string|max:255',
        ]);


        $loja = Loja::where('id_user', auth()->id())
            ->where('id', $id)
            ->first();


        Categoria::create([
            'nome_categoria' => $validated['nome_categoria'],
            'id_loja' => $loja->id,
        ]);

        return redirect()->route('loja.show', $loja->id)
            ->with('success', 'Categoria criada!');
    }

    public function show(Categoria $categoria)
    {
        return $categoria;
    }

    public function edit($id_loja, Categoria $categoria)
    {
        $loja = Loja::where('id_user', auth()->id())
            ->where('id', $id_loja)
            ->first();

        $categoria->existePedido = Item::where('id_categoria', $categoria->id)
            ->whereHas('pedido')
            ->exists();

        return view('editar_categoria', compact('categoria', 'loja'));
    }


    public function update(Request $request, $loja_id, Categoria $categoria)
    {
        $validated = $request->validate([
            'nome_categoria' => 'required|max:50',
            'id_loja' => 'required|exists:lojas,id',
        ]);

        $categoria->update($validated);
        return redirect()->route('loja.show', $loja_id)
            ->with('success', 'Produto atualizado!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($loja_id, Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('loja.show', $loja_id)
            ->with('success', 'Produto atualizado!');
    }
}
