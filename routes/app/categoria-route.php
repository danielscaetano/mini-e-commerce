<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Middleware\ConfirmacaodeAutenticacao;

Route::middleware(ConfirmacaodeAutenticacao::class)->group(function () {



    Route::get('categorias/edit/{loja}/{categoria}', [CategoriaController::class, 'edit'])
        ->name('categorias.edit');
    Route::put('categorias/update/{loja}/{categoria}', [CategoriaController::class, 'update'])
        ->name('categorias.update');

    Route::get('categorias/create/{loja}', [CategoriaController::class, 'create'])
        ->name('categorias.create');

    Route::get('/categorias/{loja}', [CategoriaController::class, 'index'])
    ->name('categorias.index');
    Route::delete('categorias/destroy{categoria}', [CategoriaController::class, 'destroy'])
        ->name('categorias.destroy');
    Route::post('categorias/{loja}', [CategoriaController::class, 'store'])
        ->name('categorias.store');



});
