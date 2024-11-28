<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\CategoryController;
use App\Models\User;

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

Route::middleware('api')->get('user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->group(function () {
Route::post('registerApi', [AuthController::class, 'register']);
Route::post('loginApi', [AuthController::class, 'login']);
Route::get('/productos', [ProductApiController::class,'productApi']);
Route::get('category',[CategoryController::class, 'categoryApi']);
Route::get('category-herramientas',[CategoryController::class, 'categoryHomeApi']);
Route::get('category-rudo',[CategoryController::class, 'categoryHeavyApi']);
Route::post('/profile/{id}', [AuthController::class, 'updateProfile']);
// Route::post('card',[CardController::class,'toggleCart']);
Route::post('/card', [CardController::class, 'toggleCart']);
Route::post('/cart/user', [CardController::class, 'cartUser']);

});



