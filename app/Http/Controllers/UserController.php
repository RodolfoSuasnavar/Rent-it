<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function show404()
    {
        $userRole = Auth::check() ? Auth::user()->role : 'guest'; // Obtener el rol del usuario, si está autenticado

        return view('errors.404')->with('userRole', $userRole);
    }
}
