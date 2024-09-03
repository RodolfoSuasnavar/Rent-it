<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Producto;
use App\Models\Renta;
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
    public function misRentados()
    {
        if (!Auth::check()) {
            return redirect()->route('login.index');
        }

        $user = Auth::user();

        // Obtener las rentas del usuario
        $rentas = Renta::where('user_id', $user->id)->get();

        // Obtener los IDs de los productos que el usuario ha rentado
        $productoIds = $rentas->pluck('producto_id');

        // Obtener los productos que el usuario ha rentado
        $productosRentados = Producto::whereIn('id', $productoIds)->get();

        // Pasar los datos a la vista
        return view('renta.misRentados', compact('productosRentados', 'rentas'));
    }


}
