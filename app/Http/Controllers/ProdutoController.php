<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Item;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = Produto::all();

        $categorias = Categoria::all();
        foreach ($produtos as $produto) {
            $produto->existePedido = Item::where('id_produto', $produto->id)->exists();
        }

        return view('listar_produto', [
            'categorias' => $categorias,
            'produtos' => $produtos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $loja = auth()->user()->loja;

        $categorias = Categoria::where('id_loja', $loja->id)->get();

        return view('criar_produto', compact('categorias', 'loja'));
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

        \App\Models\Produto::create([
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

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        $existePedido = Item::where('id_produto', $produto->id)->exists();

        if ($existePedido) {
            return back()->withErrors([
                'produto' => 'Não é possivel alterar esse produto, pois existe um pedido com ele',
            ]);
        }

        $categorias = Categoria::all();

        return view('editar_produto', [
            'produto' => $produto,
            'categorias' => $categorias
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        $existePedido = Item::where('id_produto', $produto->id)->exists();

        if ($existePedido) {
            return back()->withErrors([
                'produto' => 'Não é possivel alterar esse produto, pois existe um pedido com ele',
            ]);
        }

        $validated = $request->validate([
            'nome_produto' => 'required|max:50',
            'descricao' => 'required|max:255',
            'valor' => 'required|numeric|min:0',
            'id_categoria' => 'required|exists:categorias,id',
        ]);

        $produto->update($validated);

        return redirect('/')->with('success', 'Produto atualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {

        $existePedido = Item::where('id_produto', $produto->id)->exists();


        $produto->delete();

        return redirect('/')->with('success', 'Produto excluído!');
    }

    public function AdicionarAoCarrinho(Request $request)
    {
        $produtosSelecionados = collect($request->produtos ?? [])
            ->filter(fn ($item) => isset($item['selecionado']));

        if ($produtosSelecionados->isEmpty()) {
            return redirect()->back()->with('error', 'Nenhum produto selecionado!');
        }

        $validated = $request->validate([
            'nome_cliente' => 'required|string|max:255',
        ]);

        $pedido = \App\Models\Pedido::create([
            'nome_cliente' => $validated['nome_cliente'],
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
