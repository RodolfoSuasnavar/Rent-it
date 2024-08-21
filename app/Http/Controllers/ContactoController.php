<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ContactoController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('contacto.index', compact('user'));
    }


    public function create() {
        $user = Auth::user();
        return view('contacto.crear', compact('user'));

    }

    public function store(Request $request) {

        $request->validate([
            'comentario' => 'required|string|max:255',
        ]);

        $contacto = new Contacto();
        $contacto->user_id = Auth::id(); // Obtiene el ID del usuario autenticado
        $contacto->comentario = $request->comentario;

        $contacto->save();

        return redirect('/')->with('success', 'Comentario creado con éxito.');
    }

}
