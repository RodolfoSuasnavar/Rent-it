<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use Illuminate\Support\Facades\Session;
use App\Models\Renta;
use App\Models\Pago;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProductRented;



// use Illuminate\Http\Request;
// use Stripe\Stripe;
// use Stripe\PaymentIntent;
// use Illuminate\Support\Facades\DB; // Asegúrate de importar DB

class StripeController extends Controller
{
    // public function showPaymentForm()
    // {
    //     return view('pago_stripe');
    // }

    public function processPayment(Request $request)
    {
        // Configura la clave secreta de Stripe
        Stripe::setApiKey(config('services.stripe.secret'));

        // Recupera los datos del formulario
        $producto_id = $request->input('producto_id');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $total = $request->input('total');

        // Verifica si el producto ya está rentado en las fechas seleccionadas
        $existingRenta = Renta::where('producto_id', $producto_id)
            ->where(function($query) use ($start_date, $end_date) {
                $query->whereBetween('fecha_inicio', [$start_date, $end_date])
                      ->orWhereBetween('fecha_final', [$start_date, $end_date])
                      ->orWhere(function ($query) use ($start_date, $end_date) {
                          $query->where('fecha_inicio', '<=', $start_date)
                                ->where('fecha_final', '>=', $end_date);
                      });
            })
            ->first();

        // Si ya existe una renta en ese periodo, mostramos un error
        if ($existingRenta) {
            Session::flash('error', 'Este producto ya está rentado en las fechas seleccionadas.');
            return redirect()->back();
        }

        try {
            // Crea un cliente en Stripe
            $customer = Customer::create([
                'email' => $request->email,
                'source' => $request->stripeToken,
            ]);

            // Crea un cargo en Stripe
            $charge = Charge::create([
                'customer' => $customer->id,
                'amount' => $request->amount * 100, // El monto en centavos
                'currency' => 'mxn', // Pesos mexicanos
                'description' => 'Pago por productos',
            ]);

            $renta = Renta::create([
                'user_id' => Auth::id(),
                'producto_id' => $request->input('producto_id'), // ID del producto
                'fecha_inicio' => $request->input('start_date'), // Fecha de inicio
                'fecha_final' => $request->input('end_date'), // Fecha final
                'precio_total' => $request->amount, // Total en pesos
            ]);

            Pago::create([
                'renta_id' => $renta->id,
                'fecha_pago' => now(),
                'tipo_pago' => 'Stripe', // Tipo de pago
                // 'stripe_charge_id' => $charge->id, // Omitido
            ]);


            //colocado
            $producto = Producto::find($producto_id);


            // Enviar correo al dueño del producto
            Mail::to($producto->user->email)->send(new ProductRented($renta));



            // Si todo va bien, puedes redirigir con un mensaje de éxito
            Session::flash('success', 'Pago realizado con éxito');
            return redirect()->route('payment.success');

        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return redirect()->route('payment.cancel');
        }



    }

    public function success()
    {
        // Lógica después de un pago exitoso
        return view('payment.success');
    }

    public function cancel()
    {
        // Lógica si el usuario cancela el pago
        return view('payment.cancel');
    }


}
