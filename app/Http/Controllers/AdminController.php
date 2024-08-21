<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Contacto;
use App\Models\Producto;
use App\Models\Renta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class AdminController extends Controller
{
    public function index(){

        $userCount = User::count();
        $productoCount = Producto::count();
        $rentaCount = Renta::count();
        $categoriaCount = Categoria::count();
        $comentarioCount = Contacto::count();

        $usuarios = User::all();
        $productos = Producto::all();
        $rentas = Renta::all();
        $contactos = Contacto::all();
        $categorias = Categoria::all();

        return view('admin.index', [
            'userCount' => $userCount,
            'productoCount' => $productoCount,
            'rentaCount' => $rentaCount,
            'categoriaCount' => $categoriaCount,
            'comentarioCount' => $comentarioCount

        ], compact('usuarios', 'productos', 'rentas', 'contactos', 'categorias'));
    }
}
