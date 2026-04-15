<?php

namespace App\Http\Controllers;

use App\Models\Loja;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        
        $lojas = Loja::all();

        return view('home',compact('lojas'));
    }
}
