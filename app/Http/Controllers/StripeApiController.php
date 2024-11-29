<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\PaymentLink;

class StripeApiController extends Controller
{
    public function createPaymentLink(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|integer',
            'currency' => 'required|string',
            'user_id' => 'required|integer',
        ]);

        try {
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            $price = \Stripe\Price::create([
                'unit_amount' => $validatedData['amount'],
                'currency' => $validatedData['currency'],
                'product_data' => [
                    'name' => 'Pago desde la app móvil',
                ],
            ]);

            $paymentIntent = PaymentIntent::create([
                'amount' => $validatedData['amount'],
                'currency' => $validatedData['currency'],
                'metadata' => [
                    'user_id' => $validatedData['user_id'],
                ],
                'payment_method_types' => ['card'],
            ]);

            $paymentLink = PaymentLink::create([
                'line_items' => [[
                    'price' => $price->id,
                    'quantity' => 1,
                ]],
            ]);

            return response()->json([
                'success' => true,
                'url' => $paymentLink->url,
                'paymentIntent' => $paymentIntent->client_secret,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 400);
        }
    }

}
