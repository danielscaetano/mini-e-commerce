<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use stdClass;


class HomeController extends Controller
{
    public function home()
    {
        $categoria = new stdClass();
             return view('home',[
            'categoria' => [$categoria],
        ]);
    }
}
