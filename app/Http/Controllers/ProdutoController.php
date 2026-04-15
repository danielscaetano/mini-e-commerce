<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Item;
use App\Models\Loja;
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
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
        $produtos = Produto::whereIn('id_categoria', $categorias->pluck('id'))->get();



        foreach ($produtos as $produto) {
            $produto->existePedido = Item::where('id_produto', $produto->id)->exists();
        }

        return view('listar_produto', compact('categorias', 'produtos', 'loja'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // Receba o $id da loja pela URL
    public function create($id)
    {
        $loja = Loja::where('id_user', auth()->id())
            ->where('id', $id)
            ->first();

        $categorias = Categoria::where('id_loja', $loja->id)->get();

        return view('criar_produto', compact('categorias', 'loja'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {


        $loja = Loja::where('id_user', auth()->id())
            ->where('id', $id)
            ->first();

        $validated = $request->validate([
            'nome_produto' => 'required|max:50',
            'descricao' => 'required|max:255',
            'valor' => 'required|numeric|min:0',
            'id_categoria' => 'required|exists:categorias,id',
        ]);

        Produto::create([
            'nome_produto' => $validated['nome_produto'],
            'descricao' => $validated['descricao'],
            'valor' => $validated['valor'],
            'id_categoria' => $validated['id_categoria'],
            'id_loja' => $loja->id,

        ]);
        return redirect()->route('loja.show', $loja->id)
            ->with('success', 'Produto criado!');
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
    public function edit($loja_id, Produto $produto)
    {
        $loja = Loja::where('id_user', auth()->id())
            ->where('id', $loja_id)
            ->first();

        $existePedido = Item::where('id_produto', $produto->id)->exists();

        if ($existePedido) {
            return back()->withErrors([
                'produto' => 'Não é possível alterar esse produto, pois existe um pedido com ele',
            ]);
        }

        return view('editar_produto', [
            'produto' => $produto,
            'categorias' => Categoria::where('id_loja', $loja->id)->get(), // Só categorias da loja
            'loja' => $loja
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $loja_id, Produto $produto)
    {


        $existePedido = Item::where('id_produto', $produto->id)->exists();

        if ($existePedido) {
            return back()->withErrors([
                'produto' => 'Não é possível alterar esse produto, pois existe um pedido com ele',
            ]);
        }

        $validated = $request->validate([
            'nome_produto' => 'required|max:50',
            'descricao' => 'required|max:255',
            'valor' => 'required|numeric|min:0',
            'id_categoria' => 'required|exists:categorias,id',
        ]);

        $produto->update($validated);
        return redirect()->route('loja.show', $loja_id)
            ->with('success', 'Produto atualizado!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($loja_id, Produto $produto)
    {
        $produto->delete();

        return redirect()->route('loja.show', $loja_id)
            ->with('success', 'Produto atualizado!');
    }

    public function AdicionarAoCarrinho(Request $request, $id)
    {

        
        $produtosSelecionados = collect($request->produtos ?? [])
            ->filter(fn ($item) => isset($item['selecionado']));

        if ($produtosSelecionados->isEmpty()) {
            return redirect()->back()->with('error', 'Nenhum produto selecionado!');
        }

       

        $pedido = Pedido::create([
            'id_loja' => $id,
            'nome_cliente' => auth()->user()->name,
        ]);

        foreach ($produtosSelecionados as $id_produto => $item) {
            Item::create([
                'id_produto' => $id_produto,
                'id_pedido' => $pedido->id,
                'quantidade' => $item['quantidade'],
                'id_loja' => $id,
            ]);
        }

        return redirect()->back()->with('success', 'Produtos adicionados ao pedido!');
    }
}
