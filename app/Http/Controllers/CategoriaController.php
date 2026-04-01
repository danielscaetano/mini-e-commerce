<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Loja;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($lojaId)
    {
        $loja = Loja::where('id', $lojaId)
            ->where('id_user', auth()->id())
            ->firstOrFail();

        return view('criar_categoria', compact('loja'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $lojaId)
    {

        $validated = $request->validate([
            'nome_categoria' => 'required|string|max:255',
        ]);


        $loja = Loja::where('id', $lojaId)
            ->where('id_user', auth()->id())
            ->firstOrFail();


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

    public function edit(Categoria $categoria)
    {
    }

    public function update(Request $request, Categoria $categoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        //
    }
}
