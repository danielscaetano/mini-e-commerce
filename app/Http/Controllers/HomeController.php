<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function home()
    {
        $produtos =Produto ::all();

        return view("home",[
            "produtos" => $produtos
        ]);
    }
}
