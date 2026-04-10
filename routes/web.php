<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PedidoController;
use App\Http\Middleware\ConfirmacaodeAutenticacao;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->middleware(ConfirmacaodeAutenticacao::class);

include __DIR__ . '/app/login-route.php';
include __DIR__ . '/app/loja-route.php';
include __DIR__ . '/app/categoria-route.php';
include __DIR__ . '/app/produto-route.php';

Route::post('/marcarComoPago/{id}', [PedidoController::class, 'marcarComoPago'])
    ->name('marcarComoPago')
    ->middleware(ConfirmacaodeAutenticacao::class);
