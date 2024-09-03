<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
class RentaController extends Controller
{
    public function index($id)
    {


        if(!Auth::check()){
            return redirect()->route('login.index');
        }

        $producto = Producto::findOrFail($id); // Obtiene el producto o lanza una excepción si no se encuentra

        $productosRelacionados = Producto::where('categoria_id', $producto->categoria_id)
        ->where('id', '!=', $producto->id) // Excluye el producto actual
        ->get();


        return view('renta.index', compact('producto', 'productosRelacionados'));

    }



}
