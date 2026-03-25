<?php

use App\Http\Controllers\CadastroController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Middleware\ConfirmacaodeAutenticacao;
use Illuminate\Support\Facades\Route;

Route::get('logar', [LoginController::class, 'index'])->name('login.index');
Route::post('logar', [LoginController::class, 'store'])->name('login.store');
Route::post('cadastro', [CadastroController::class, 'store'])->name('cadastro.store');
Route::get('cadastro', [CadastroController::class, 'index'])->name('cadastro.index');

Route::middleware(ConfirmacaodeAutenticacao::class)->group(function () {
    Route::get('/', [HomeController::class, 'home']);

    Route::resource('produtos', ProdutoController::class);

    Route::resource('categorias', CategoriaController::class);

    Route::post('/carrinho/adicionar', [ProdutoController::class, 'AdicionarAoCarrinho'])
        ->name('carrinho.adicionar');

    Route::post('/marcarComoPago/{id}', [PedidoController::class, 'marcarComoPago'])
        ->name('marcarComoPago');

});



