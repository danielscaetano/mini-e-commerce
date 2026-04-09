<?php

use App\Http\Controllers\CadastroController;
use App\Http\Controllers\LoginController;

Route::get('logar', [LoginController::class, 'index'])->name('login.index');
Route::post('logar', [LoginController::class, 'store'])->name('login.store');
Route::post('cadastro', [CadastroController::class, 'store'])->name('cadastro.store');
Route::get('cadastro', [CadastroController::class, 'index'])->name('cadastro.index');
