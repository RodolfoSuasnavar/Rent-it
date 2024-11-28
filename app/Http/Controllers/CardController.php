<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CardController extends Controller
{
    public function toggleCart(Request $request)
    {
        Log::info('Datos recibidos:', $request->all());

        Log::info('User ID: ' . $request->input('user_id'));
        Log::info('Product ID: ' . $request->input('product_id'));
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'product_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Datos faltantes o inválidos',
                'errors' => $validator->errors(),
            ], 400);
        }

        try {
            $card = Card::where('user_id', $request->input('user_id'))
                ->where('product_id', $request->input('product_id'))
                ->first();
            if ($card) {
                $card->is_card = !$card->is_card;
                $card->save();

                $message = $card->is_card
                    ? 'Producto agregado al carrito.'
                    : 'Producto eliminado del carrito.';
            } else {
                $card = Card::create([
                    'user_id' => $request->input('user_id'),
                    'product_id' => $request->input('product_id'),
                    'is_card' => true,
                ]);

                $message = 'Producto agregado al carrito.';
            }

            return response()->json([
                'status' => 'success',
                'message' => $message,
                'data' => $card,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Hubo un problema al procesar la solicitud.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function cartUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
        ]);

        try {
            $cartItems = Card::with('product')
                ->where('user_id', $request->input('user_id'))
                ->where('is_card', true)
                ->get();
            $cartItems->each(function ($item) {
                $item->product->foto = url('imagen/' . $item->product->foto);
            });

            if ($cartItems->isEmpty()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'No hay productos en el carrito.',
                    'data' => [],
                ], 200);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Productos recuperados con éxito.',
                'data' => $cartItems,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al recuperar los productos del carrito.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
