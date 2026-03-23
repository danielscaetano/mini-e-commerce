<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home']);

Route::resource('produtos', ProdutoController::class);
Route::resource('pedido', PedidoController::class);

Route::resource('categorias', CategoriaController::class);

Route::post('/carrinho/adicionar', [ProdutoController::class, 'AdicionarAoCarrinho'])->name('carrinho.adicionar');
Route::post('/marcarComoPago/{id}', [PedidoController::class, 'marcarComoPago'])->name('marcarComoPago');
