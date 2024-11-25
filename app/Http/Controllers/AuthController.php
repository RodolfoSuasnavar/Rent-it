<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Validator;
use JWTAuth;
use Google_Client;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
    
            return response()->json([
                'status' => 'success',
                'user' => $user,
                'token' => $token,
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Credenciales incorrectas. Intenta de nuevo.'], 401);
        }
    }


    public function googleLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'google_token' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Google token es requerido'], 400);
        }

        // Validate Google token
        $googleClient = new Google_Client(['client_id' => 'YOUR_GOOGLE_CLIENT_ID']);
        $payload = $googleClient->verifyIdToken($request->google_token);

        if ($payload) {
            $email = $payload['email'];
            $user = User::firstOrCreate(['email' => $email]);

            // Create JWT token for the user
            $token = JWTAuth::fromUser($user);

            return response()->json(['token' => $token, 'user' => $user]);
        }

        return response()->json(['error' => 'Google token inválido'], 400);
    }

    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'aPaterno' => 'required|string|max:255',
            'aMaterno' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);


        $user = User::create([
            'nombre' => $request->nombre,
            'aPaterno' => $request->aPaterno,
            'aMaterno' => $request->aMaterno,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        // Genera el token de autenticación para el usuario
        $token = $user->createToken('authToken')->plainTextToken;

        // Retornar la respuesta exitosa con el token y los datos del usuario
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    // public function register(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'nombre'=>'requiered|regex:/^[\pL\s]+$/u',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required|string|min:6',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['error' => 'Validación fallida'], 400);
    //     }

    //     $user = User::create([
    //         'nombre'=>$request->nombre,
    //         'email' => $request->email,
    //         'password'=>$request->password
    //         ]);
    //     }
}