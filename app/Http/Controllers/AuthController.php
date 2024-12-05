<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Google_Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;

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

    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'aPaterno' => 'required|string|max:255',
            'aMaterno' => 'required|string|max:255',
            'telefono' => 'required|digits:10',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);


        $user = User::create([
            'nombre' => $request->nombre,
            'aPaterno' => $request->aPaterno,
            'aMaterno' => $request->aMaterno,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        $token = $user->createToken('authToken')->plainTextToken;


        return response()->json([
            'status' => 'success',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'aPaterno' => 'required|string|max:255',
            'aMaterno' => 'required|string|max:255',
            'telefono' => 'required|digits:10',
            'email' => 'required',

        ]);


        $user->name = $request->name;
        $user->aPaterno = $request->aPaterno;
        $user->aMaterno = $request->aMaterno;
        $user->telefono = $request->telefono;
        $user->email = $request->email;
        $user->save();

        return response()->json([
            'status' => 'success',
            'user' => $user,
        ], 200);
    }

    public function logoutapi()
    {
        Auth::logout();
        return response()->json(['status' => 'success', 'message' => 'Sesión cerrada correctamente']);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['message' => __($status)], 200);
        }

        return response()->json(['error' => __($status)], 400);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json(['message' => __($status)], 200);
        }

        return response()->json(['error' => __($status)], 400);
    }
}
