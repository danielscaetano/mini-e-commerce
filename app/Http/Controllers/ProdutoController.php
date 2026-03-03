<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;
use App\Http\Requests\StoreCategoriaRequest;
use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\iten;


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
        'id_categoria' => 'required|exists:categorias,id', 
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
    $produto->load('categoria'); 
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


     public function adicionarAoCarrinho(Request $request)
    {
        $produtosSelecionados = collect($request->produtos ?? [])
            ->filter(fn($item) => isset($item['selecionado']));

        if ($produtosSelecionados->isEmpty()) {
            return redirect()->back()->with('error', 'Nenhum produto selecionado!');
        }

        // 1️⃣ Criar pedido
        $pedido = Pedido::create([
            'nome_cliente' => 'Cliente Exemplo', 
        ]);

        foreach ($produtosSelecionados as $id_produto => $item) {
            Item::create([
                'id_produto' => $id_produto,
                'id_pedido' => $pedido->id,
                'quantidade' => $item['quantidade'],
            ]);
        }

        return redirect()->back()->with('success', 'Produtos adicionados ao pedido!');
    }

    
}
