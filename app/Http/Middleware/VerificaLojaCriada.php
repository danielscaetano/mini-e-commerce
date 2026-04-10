<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerificaLojaCriada
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->loja) {
            return $next($request);
        }

        if (Auth::check()) {
            return redirect()->route('loja.create')->with('erro', 'Crie sua loja primeiro.');
        }

        return redirect()->route('login.index');
    }



}
