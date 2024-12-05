<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Stripe\Webhook;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Stripe\Checkout\Session;

class StripeWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $payload = file_get_contents('php://input');

        if (!isset($_SERVER['HTTP_STRIPE_SIGNATURE'])) {
            Log::error('Missing Stripe signature header');
            return response()->json(['error' => 'Missing Stripe signature'], 400);
        }

        $sigHeader = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $secret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sigHeader,
                $secret
            );
        } catch (\Exception $e) {
            Log::error('Webhook signature verification failed', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'Webhook signature verification failed'], 400);
        }

        if ($event->type == 'checkout.session.completed') {
            /** @var Session */
            $session = $event->data->object;

            if (isset($session->metadata->user_id)) {
                $userId = $session->metadata->user_id;
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
            } else {
                Log::warning('Payment intent metadata missing user_id');
                return response()->json(['error' => 'Missing user ID in payment intent metadata'], 400);
            }
        } else {
            Log::info('Unhandled event type', ['type' => $event->type]);
        }

        return response()->json(['status' => 'success']);
    }
}
