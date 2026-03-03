<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MiniController;
use App\Http\Controllers\ProdutoController;

Route::get('/', [HomeController::class, 'home']);

Route::resource('produtos', ProdutoController::class);

Route::resource('categorias', CategoriaController::class);

Route::post('/carrinho/adicionar', [ProdutoController::class, 'adicionarAoCarrinho'])->name('carrinho.adicionar');