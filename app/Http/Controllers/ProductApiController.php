<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductApiController extends Controller
{
    public function productApi()
    {
        $productos = Producto::all()->map(function ($producto) {
            $producto->foto = url('imagen/' . $producto->foto);
            return $producto;
        });

        return response()->json([
            'success' => true,
            'productos' => $productos,
        ]);
    }
}
