<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categoria.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ], [
            'required' => 'El campo :attribute no es válido.',
            'max' => 'El campo :attribute no debe ser mayor a :max caracteres.',
        ]);

        // Crea una nueva categoría con los datos del formulario
        Categoria::create([
            'nombre' => $request->input('nombre'),
        ]);

        // Redirige a la lista de categorías con un mensaje de éxito
        return redirect()->route('admin.index')->with('success', 'Categoría agregada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.show', compact('categoria')); // Asegúrate de que esta vista exista
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Encuentra la categoría por ID
        $categoria = Categoria::findOrFail($id);

        // Pasa la categoría a la vista
        return view('categoria.edit', compact('categoria')); // Asegúrate de que esta vista exista
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
        ], [
            'required' => 'El campo :attribute no es válido.',
            'max' => 'El campo :attribute no debe ser mayor a :max caracteres.',
        ]);

        $categoria->nombre = $request->input('nombre');
        $categoria->save();

        return redirect()->route('admin.index')->with('success', 'Categoría actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->route('admin.index')->with('success', 'Categoría eliminada con éxito.');
    }
}
