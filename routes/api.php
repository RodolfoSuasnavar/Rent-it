<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ProductApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/api/google-login', function (Request $request) {
    $googleToken = $request->input('token');
    $googleUser = Socialite::driver('google')->userFromToken($googleToken);
    $user = User::firstOrCreate(
        ['email' => $googleUser->getEmail()],
        ['name' => $googleUser->getName()]
    );
    $token = $user->createToken('authToken')->plainTextToken;

    // Devolver la respuesta con el token de acceso
    return response()->json([
        'status' => 'success',
        'token' => $token,
        'user' => $user,
    ]);
});
Route::post('register', [AuthController::class, 'register']);  
 
Route::middleware('api')->get('user', function (Request $request) {
    return $request->user();  
});
Route::post('login', [AuthController::class, 'login']);
Route::get('/productos', [ProductApiController::class,'productApi']);



