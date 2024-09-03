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
            'certificado_confiabilidad' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $productos = $request->all();
        $productos['user_id'] = Auth::id();

        if ($imagen = $request->file('foto')) {
            $rutaGuardarImg = 'imagen/';
            $imagenProducto = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImg, $imagenProducto);
            $productos['foto'] = $imagenProducto;
        }

        if ($certificado = $request->file('certificado_confiabilidad')) {
            $rutaGuardarDoc = 'documento/';
            $certificadoNombre = date('YmdHis') . "." . $certificado->getClientOriginalExtension();
            $certificado->move($rutaGuardarDoc, $certificadoNombre);
            $productos['certificado_confiabilidad'] = $certificadoNombre;
        }

        Producto::create($productos);

        return redirect()->route('producto.index')->with('success', 'Producto registrado exitosamente.');
    }


    public function edit($id)
    {
        $categorias = Categoria::all();
        $producto = Producto::findOrFail($id); // Cambié 'productos' a 'producto' para reflejar una sola instancia del producto

        return view('producto.edit', compact('producto', 'categorias')); // Corregí la sintaxis de 'compact'
    }


    public function show($id)
    {
        $productos = Producto::findOrFail($id);
        return view("producto.eliminar", compact('productos'));
    }
    public function update(Request $request, $id)
    {
        // Encuentra el producto por ID
        $producto = Producto::findOrFail($id);

        // Valida los datos de la solicitud
        $request->validate([
            'nombre' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'categoria_id' => 'required|exists:categorias,id',
            'descripcion' => 'required|string',
            'precio_por_dia' => 'required|numeric|min:0',
            'certificado_confiabilidad' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Actualiza los datos del producto
        $producto->nombre = $request->input('nombre');
        $producto->descripcion = $request->input('descripcion');
        $producto->precio_por_dia = $request->input('precio_por_dia');
        $producto->categoria_id = $request->input('categoria_id');

        // Actualiza la imagen del producto si se proporciona una nueva
        if ($request->hasFile('foto')) {
            $rutaGuardarImg = 'imagen/';
            $imagen = $request->file('foto');
            $imagenProducto = date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImg, $imagenProducto);
            $producto->foto = $imagenProducto;
        }

        // Actualiza el certificado si se proporciona uno nuevo
        if ($request->hasFile('certificado_confiabilidad')) {
            $rutaGuardarDoc = 'documento/';
            $certificado = $request->file('certificado_confiabilidad');
            $certificadoNombre = date('YmdHis') . "." . $certificado->getClientOriginalExtension();
            $certificado->move($rutaGuardarDoc, $certificadoNombre);
            $producto->certificado_confiabilidad = $certificadoNombre;
        }

        // Guarda los cambios
        $producto->save();

        // Redirige con un mensaje de éxito
        return redirect()->route('producto.index')->with('success', 'Producto actualizado exitosamente.');
    }
    public function destroy($id)
    {
        $productos = Producto::find($id);
        $productos->delete();
        return redirect()->route("producto.index")->with("success", "Datos Eliminados exitosamente!");

    }
}
