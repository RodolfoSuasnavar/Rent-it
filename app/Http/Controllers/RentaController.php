<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
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

    // Obtener todas las fechas ocupadas para el producto
    $fechasOcupadas = Renta::where('producto_id', $producto->id)
        ->get(['fecha_inicio', 'fecha_final'])
        ->map(function ($renta) {
            $dates = [];
            $start = Carbon::parse($renta->fecha_inicio);
            $end = Carbon::parse($renta->fecha_final);
            while ($start <= $end) {
                $dates[] = $start->format('Y-m-d');
                $start->addDay();
            }
            return $dates;
        })
        ->flatten()
        ->unique()
        ->values()
        ->toArray();

        return view('renta.index', compact('producto', 'productosRelacionados', 'fechasOcupadas'));

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

    public function verificarDisponibilidad(Request $request)
    {
        $productoId = $request->input('producto_id');
        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('end_date'));

        // Verificar si existe una reserva para este producto en las fechas seleccionadas
        $rentaExistente = Renta::where('producto_id', $productoId)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('fecha_inicio', [$startDate, $endDate])
                      ->orWhereBetween('fecha_final', [$startDate, $endDate])
                      ->orWhere(function ($query) use ($startDate, $endDate) {
                          $query->where('fecha_inicio', '<=', $startDate)
                                ->where('fecha_final', '>=', $endDate);
                      });
            })
            ->exists();

        return response()->json(['available' => !$rentaExistente]);
    }

}
