<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
// use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RentaController;
use App\Http\Controllers\PortafolioController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StripeApiController;
use App\Http\Controllers\StripeWebhookController;

//Auth::routes();

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
//Reset Password
// Ruta para mostrar el formulario de solicitud de enlace de restablecimiento
Route::get('password/reset', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [PasswordResetController::class, 'reset'])->name('password.update');



//API STRIPE

// Route::get('/payment', [StripeController::class, 'showPaymentForm'])->name('payment.form');
Route::post('/payment', [StripeController::class, 'processPayment'])->name('payment.process');

Route::get('/payment', function () {
    $total = 1000; // Supongamos que este es el monto en pesos
    return view('pago_stripe', compact('total'));
});
Route::get('/payment/success', [StripeController::class, 'success'])->name('payment.success');
Route::get('/payment/cancel', [StripeController::class, 'cancel'])->name('payment.cancel');


Route::get('/', [PortafolioController::class, 'index'])->name('welcome');

// Route::get('/admin', [AdminController::class, 'index'])
//     ->name('admin.index')
//     ->middleware('auth.admin');
Route::fallback([UserController::class, 'show404']);


Route::group(['middleware' => ['auth', 'auth.admin']], function () {
    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin.index');

    Route::get('/admin/categorias/{id}/productos', [AdminController::class, 'verProductos'])->name('admin.productos.ver');

    Route::get('/admin/categoria/create', [CategoriaController::class, 'create'])->name('categoria.crear');
    Route::post('/admin/categoria/create', [CategoriaController::class, 'store'])->name('categoria.store');
    Route::get('/admin/categoria/show/{id}', [CategoriaController::class, 'show'])->name('categoria.show');
    Route::get('/admin/categoria/edit/{id}', [CategoriaController::class, 'edit'])->name('categoria.edit');
    Route::put('/admin/categoria/update/{id}', [CategoriaController::class, 'update'])->name('categoria.update');
    Route::delete('/admin/categoria/destroy/{id}', [CategoriaController::class, 'destroy'])->name('categoria.destroy');
});

//usuarios
Route::group(['middleware' => ['auth', 'auth.user']], function () {
    Route::get('/user/productos', [ProductoController::class, 'index'])->name('producto.index');
    Route::get('/user/producto/create', [ProductoController::class, 'create'])->name('producto.crear');
    Route::post('/user/producto', [ProductoController::class, 'store'])->name('producto.store');

    Route::get('/user/producto/show/{id}', [ProductoController::class, 'show'])->name('producto.show');
    Route::get('/user/producto/edit/{id}', [ProductoController::class, 'edit'])->name('producto.edit');
    Route::put('/user/producto/update/{id}', [ProductoController::class, 'update'])->name('producto.update');
    Route::delete('/user/producto/destroy/{id}', [ProductoController::class, 'destroy'])->name('producto.destroy');

    //contacto
    Route::post('/contacto', [ContactoController::class, 'index'])->name('contacto.index');
    Route::get('/contacto/create', [ContactoController::class, 'create'])->name('contacto.crear');
    Route::post('/contacto', [ContactoController::class, 'store'])->name('contacto.store');

    //renta
    route::get('/renta/{id}', [RentaController::class, 'index'])->name('renta.index');
    Route::get('/mis-rentados', [RentaController::class, 'misRentados'])->name('renta.misRentados');
});



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

Route::get('/productos', [ProductApiController::class, 'productApi']);

//restablecer contraseña
Route::get('password/reset', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [PasswordResetController::class, 'reset'])->name('password.update');
Route::middleware('api')->get('user', function (Request $request) {
    return $request->user();  // Obtener datos del usuario autenticado

});

Route::middleware('api')->group(function () {
    Route::post('registerApi', [AuthController::class, 'register']);
    Route::post('loginApi', [AuthController::class, 'login']);
    Route::post('/logoutapi', [AuthController::class, 'logoutapi']);
    Route::get('/productos', [ProductApiController::class, 'productApi']);
    Route::get('category', [CategoryController::class, 'categoryApi']);
    Route::get('category-herramientas', [CategoryController::class, 'categoryHomeApi']);
    Route::get('category-rudo', [CategoryController::class, 'categoryHeavyApi']);
    Route::put('/profile/{id}', [AuthController::class, 'updateProfile']);
    Route::post('/card', [CardController::class, 'toggleCart']);
    Route::post('/stripe/payment', [StripeApiController::class, 'createPaymentLink']);
    Route::post('/stripe/webhook', [StripeWebhookController::class,'handleWebhook']);
});
