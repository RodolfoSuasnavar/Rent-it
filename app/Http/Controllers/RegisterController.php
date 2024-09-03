<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\RegistroExitoso;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function create() {
        return view('auth.register');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'aPaterno' => 'required|string|max:255',
            'aMaterno' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|unique:users|digits:10',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'required' => 'El campo :attribute no es válido.',
            'email' => 'El campo :attribute debe ser una dirección de correo válida.',
            'max' => 'El campo :attribute no debe ser mayor a :max caracteres.',
            'unique' => 'El campo :attribute ya está registrado.',
            'confirmed' => 'Las contraseñas no coinciden.',
            'min' => 'El campo :attribute debe tener al menos :min caracteres.',
        ]);

        $user = new User();
        $user->nombre = $request->nombre;
        $user->aPaterno = $request->aPaterno;
        $user->aMaterno = $request->aMaterno;
        $user->email = $request->email;
        $user->direccion = $request->direccion;
        $user->telefono = $request->telefono;
        $user->password = bcrypt($request->password);

        $user->save();


        Log::info('Usuario creado: ' . $user->email);

        try {
            $user->notify(new RegistroExitoso());
            Log::info('Notificación enviada a: ' . $user->email);
        } catch (\Exception $e) {
            Log::error('Error al enviar el correo: ' . $e->getMessage());
        }
        auth()->login($user);

        return redirect()->to('/');


    }

}
