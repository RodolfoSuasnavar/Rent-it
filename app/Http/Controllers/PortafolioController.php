<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

class PortafolioController extends Controller
{
    public function index(Request $request)
    {
        $categorias = Categoria::all();

        // Inicializa la consulta de productos
        $query = Producto::query();

        // Filtra por categoría si se ha seleccionado
        if ($request->filled('categoria')) {
            $query->where('categoria_id', $request->categoria);
        }

        // Obtiene los productos filtrados
        $productos = $query->get();
        return view('welcome', compact('productos', 'categorias'));
    }
}
