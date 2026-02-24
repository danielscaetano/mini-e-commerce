<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MiniController;
Route::get('/', function () {
    return view('home');
});
Route::get('c_categoria', function () {
    return view('c_categoria'); 
});Route::get('/', [MiniController::class, 'index']);