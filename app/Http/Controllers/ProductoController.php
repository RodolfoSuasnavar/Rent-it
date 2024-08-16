<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $productos = Producto::where('user_id', $user->id)->get();
        return view('producto.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('producto.crear', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'categoria_id' => 'required|exists:categorias,id',
            'descripcion' => 'required|string',
            'precio_por_dia' => 'required|numeric|min:0',
            'certificado_confiabilidad' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $productos = $request->all();
        $productos['user_id'] = Auth::id();

        if($imagen = $request->file('foto')){
            $rutaGuardarImg = 'imagen/';
            $imagenProducto = date('YmdHis'). "." . $imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImg, $imagenProducto);
            $productos['foto'] = "$imagenProducto";
        }

        if ($certificado = $request->file('certificado_confiabilidad')) {
            $rutaGuardarDoc = 'documento/';
            $certificadoNombre = date('YmdHis') . "." . $certificado->getClientOriginalExtension();
            $certificado->move($rutaGuardarDoc, $certificadoNombre);
            $productos['certificado_confiabilidad'] = "$certificadoNombre";
        }

        Producto::create($productos);
        return redirect()->route('producto.index');
    }

    public function edit($id)
    {
        $categorias = Categoria::all();
        $productos = Producto::find($id);
        return view("producto.actualizar", compact('productos'));

    }

    public function show($id)
    {
        $productos = Producto::findOrFail($id);
        return view("producto.eliminar", compact('productos'));
    }
    public function update(Request $request, $id)
    {
        $productos = Producto::find($id);
        $productos->Foto = $request->post('Foto');
        $productos->producto = $request->post('producto');
        $productos->Tipo = $request->post('Tipo');
        $productos->Caracteristicas = $request->post('Caracteristicas');
        $productos->Precio_dia = $request->post('Precio_dia');
        $productos->Descripcion = $request->post('Descripcion');
        $productos->Calendario_inicio = $request->post('Calendario_inicio');
        $productos->Calendario_fin = $request->post('Calendario_fin');
        $productos->Certificado = $request->post('Certificado');

        $productos->save();
        return redirect()->route("productos.productos")->with("success", "Datos Actualizados exitosamente!");

    }
    public function destroy($id)
    {
        $productos = Producto::find($id);
        $productos->delete();
        return redirect()->route("producto.index")->with("success", "Datos Eliminados exitosamente!");

    }
}
