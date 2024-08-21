<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
// use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RentaController;
use App\Http\Controllers\PortafolioController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\PasswordResetController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PortafolioController::class, 'index'])->name('welcome');

// Route::get('/admin', [AdminController::class, 'index'])
//     ->name('admin.index')
//     ->middleware('auth.admin');

// Route::group(['middleware' => ['auth', 'auth.admin']], function () {
    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin.index')
        ->middleware('auth.admin');
// });





route::get('/register', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('register.index');

route::post('/register', [RegisterController::class, 'store'])
    ->middleware('guest')
    ->name('register.store');


route::get('/login', [SessionsController::class, 'create'])
    ->middleware('guest')
    ->name('login.index');

route::post('/login', [SessionsController::class, 'store'])
    ->name('login.store');


Route::get('/logout', [SessionsController::class, 'destroy'])->middleware('auth')
    ->name('login.destroy');



// Route::get('clientes/clientes', [ClienteController::class, 'index'])->name('clientes.clientes');

Route::get('password/reset', [PasswordResetController::class, 'request'])->name('password.request');
Route::post('password/email', [PasswordResetController::class, 'email'])->name('password.email');
Route::get('password/reset/{token}', [PasswordResetController::class, 'reset'])->name('password.reset');
Route::post('password/reset', [PasswordResetController::class, 'update'])->name('password.update');

// Route::get('clientes/create', [ClienteController::class, 'create'])->name('clientes.create');


//usuarios
Route::group(['middleware' => ['auth', 'auth.user']], function () {
Route::get('/user/productos', [ProductoController::class, 'index'])->name('producto.index');
Route::get('/user/producto/create', [ProductoController::class, 'create'])->name('producto.crear');
Route::post('/user/producto', [ProductoController::class, 'store'])->name('producto.store');

Route::get('/user/producto/show/{id}', [ProductoController::class, 'show'])->name('producto.show');
Route::get('/user/producto/edit/{id}', [ProductoController::class, 'edit'])->name('producto.edit');
Route::delete('/user/producto/destroy/{id}', [ProductoController::class, 'destroy'])->name('producto.destroy');

//contacto
Route::post('/contacto', [ContactoController::class, 'index'])->name('contacto.index');
Route::get('/contacto/create', [ContactoController::class, 'create'])->name('contacto.crear');
Route::post('/contacto', [ContactoController::class, 'store'])->name('contacto.store');

//renta
route::get('/renta/{id}', [RentaController::class, 'index'])->name('renta.index');


});



