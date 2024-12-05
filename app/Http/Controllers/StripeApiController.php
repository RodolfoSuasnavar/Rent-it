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
            $price = \Stripe\Price::create([
                'unit_amount' => $validatedData['amount'],
                'currency' => $validatedData['currency'],
                'product_data' => [
                    'name' => 'Pago desde la app móvil',
                ],
            ]);

            $paymentLink = PaymentLink::create([
                'line_items' => [[
                    'price' => $price->id,
                    'quantity' => 1,
                ]],
                'metadata' => [
                    'user_id' => $validatedData['user_id'],
                ],
            ]);

            return response()->json([
                'success' => true,
                'url' => $paymentLink->url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 400);
        }
    }
}
