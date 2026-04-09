<?php

use App\Http\Controllers\ProdutoController;
use App\Http\Middleware\ConfirmacaodeAutenticacao;

Route::middleware(ConfirmacaodeAutenticacao::class)->group(function () {
    // Route::resource('produtos', ProdutoController::class)->except(['produtos', 'index', 'show']);

    Route::get('produtos', [ProdutoController::class, 'index']);

    Route::get('produtos/create/{loja}', [ProdutoController::class, 'create'])
        ->name('produtos.create');
    Route::post('produtos/store/{loja}', [ProdutoController::class, 'store'])
        ->name('produtos.store');
    Route::get('produtos/edit/{loja}/{produto}', [ProdutoController::class, 'edit'])
        ->name('produtos.edit');
    Route::put('produtos/update/{loja}/{produto}', [ProdutoController::class, 'update'])
        ->name('produtos.update');
    Route::delete('produtos/destroy/{produto}', [ProdutoController::class, 'destroy'])
        ->name('produtos.destroy');
    Route::get('/produtos/{loja}', [ProdutoController::class, 'index'])
        ->name('produtos.index');
        
    Route::post('/carrinho/{id}', [ProdutoController::class, 'AdicionarAoCarrinho'])
    ->name('carrinho.adicionar');

});
