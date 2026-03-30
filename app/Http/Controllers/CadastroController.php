<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CadastroController extends Controller
{
    public function index()
    {
        return view('cadastro');

    }

    public function store(Request $request)
    {
        $existeEmail = User::where('email', $request->input('email'))->exists();

        if ($existeEmail) {
            return redirect()
                ->back()
                ->withErrors([
                    'email' => 'Não é possível editar um produto que já está em um pedido!',
                ])
                ->withInput();
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],

        ]);

        return redirect('/')->with('success', 'categoria criada!');
    }
}
