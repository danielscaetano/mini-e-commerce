<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
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
    public function create()
    {
                return view("criar_categoria");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $validated = $request->validate([
        'nome_categoria' => 'required|string|max:255',
    ]);
 
    \App\Models\Categoria::create([
        'nome_categoria' => $validated['nome_categoria'],
    ]);
 
    
    return redirect('/')->with('success', 'categoria criada!');
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
