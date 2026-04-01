<?php

use App\Http\Controllers\CadastroController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LojaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Middleware\ConfirmacaodeAutenticacao;
use App\Http\Middleware\VerificaLojaCriada;
use Illuminate\Support\Facades\Route;

Route::get('logar', [LoginController::class, 'index'])->name('login.index');
Route::post('logar', [LoginController::class, 'store'])->name('login.store');
Route::post('cadastro', [CadastroController::class, 'store'])->name('cadastro.store');
Route::get('cadastro', [CadastroController::class, 'index'])->name('cadastro.index');
Route::get('loja/create', [LojaController::class, 'create'])->name('loja.create');
Route::post('loja', [LojaController::class, 'store'])->name('loja.store');

Route::resource('loja', LojaController::class)->middleware(VerificaLojaCriada::class)->except(['create', 'store']);

Route::middleware(ConfirmacaodeAutenticacao::class)->group(function () {
    Route::get('/', [HomeController::class, 'home']);
    Route::resource('produtos', ProdutoController::class)->except(['produtos']);
    Route::get('produtos/create/{loja}', [CategoriaController::class, 'produtos'])
        ->name('produtos.create');

    Route::get('categorias/create/{loja}', [CategoriaController::class, 'create'])
        ->name('categorias.create');

    Route::resource('categorias', CategoriaController::class)->except(['create', 'store']);
    Route::post('categorias/{loja}', [CategoriaController::class, 'store'])
        ->name('categorias.store');
    Route::post('/carrinho/adicionar', [ProdutoController::class, 'AdicionarAoCarrinho'])
        ->name('carrinho.adicionar');

    Route::post('/marcarComoPago/{id}', [PedidoController::class, 'marcarComoPago'])
        ->name('marcarComoPago');

});
