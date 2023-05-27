<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelefonoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\SendEmailController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/app', function() {
    return view('app');
});

// resource of telefono controller for CRUD
Route::resource('telefono', TelefonoController::class);

// resource of categoria controller for CRUD
Route::resource('categoria', CategoriaController::class);

// resource of pais controller for CRUD
Route::resource('pais', PaisController::class);

// resource of usuario controller for CRUD
Route::resource('usuario', UsuarioController::class);

// routes for send emails
Route::get('send-email', [SendEmailController::class, 'index']);
