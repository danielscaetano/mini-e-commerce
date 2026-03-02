<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;
use App\Http\Requests\StoreCategoriaRequest;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias =Categoria ::all();

        return view("criar_produto",[
            "categorias" => $categorias
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $validated = $request->validate([
        'nome_produto' => 'required|max:50',
        'descricao' => 'required|max:255',
        'valor' => 'required|numeric|min:0',
        'id_categoria' => 'required|exists:categorias,id', // Garante que o user existe
    ]);

   \App\Models\produto::create([
        'nome_produto' => $validated['nome_produto'],
        'descricao' => $validated['descricao'],
        'valor' => $validated['valor'],
        'id_categoria' => $validated['id_categoria'],

    ]);
 
    return redirect('/')->with('success', 'produto!');
    }
    
   


    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        //
    }
    
}
