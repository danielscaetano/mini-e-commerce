<?php

use App\Http\Controllers\LojaController;
use App\Http\Middleware\VerificaLojaCriada;
use App\Http\Middleware\ConfirmacaodeAutenticacao;

Route::middleware(ConfirmacaodeAutenticacao::class)->group(function () {
    Route::get('loja/create', [LojaController::class, 'create'])->name('loja.create');
    Route::post('loja', [LojaController::class, 'store'])->name('loja.store');
       Route::get('loja/{loja}', [LojaController::class, 'painel'])->name('loja.show');

    Route::middleware(VerificaLojaCriada::class)->group(function () {
        Route::get('loja', [LojaController::class, 'index'])->name('loja.index');
     });
});
