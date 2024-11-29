<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Stripe\Webhook;
use App\Models\User;

class StripeWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $payload = file_get_contents('php://input');
        $sigHeader = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $secret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = Webhook::constructEvent(
                $payload, $sigHeader, $secret
            );
        } catch (\Exception $e) {
            return response()->json(['error' => 'Webhook signature verification failed'], 400);
        }

        if ($event->type == 'payment_intent.succeeded') {
            $paymentIntent = $event->data->object;

            $userId = $paymentIntent->metadata->user_id;
            $user = User::find($userId);

            if ($user) {
                $cartItems = Card::where('user_id', $userId)
                                     ->where('is_card', true)
                                     ->get();

                foreach ($cartItems as $cartItem) {
                    $cartItem->is_card = false;
                    $cartItem->save();
                }
            }
        }

        return response()->json(['status' => 'success']);
    }
}
