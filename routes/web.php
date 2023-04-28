<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BacklogController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('inicio.index');
});

Route::get('/conocenos', function () {
    return view('legal.misionvision');
});

Route::get('/empleos', function () {
    return view('empleos.index');
});

Route::get('/politica-privacidad', function () {
    return view('legal.pprivacidad');
});

Route::get('/politica-uso', function () {
    return view('legal.puso');
});

Route::get('/aviso-privacidad', function () {
    return view('legal.aprivacidad');
});

Route::get('/error-400', function () {
    abort(400, 'Bad request');
});

Route::get('/error-404', function () {
    abort(404, 'Not found');
});

Route::get('/error-500', function () {
    abort(500, 'Internal server error');
});

Route::resource('/empleos', 'App\Http\Controllers\empleosController');

Route::view('/login', "login")->name('login');
Route::view('/backlog', "backlog")->name('backlog');
Route::view('/registro', "register")->name('registro');
//Ruta sin protección
/*Route::view('/privada', "secret")->name('privada');*/
//Ruta con protección
Route::view('/empleado/inicio', "empleado.index")->middleware(['auth', 'empleado'])->name('empleado');

Route::view('/empleador/inicio', "empleador.index")->middleware(['auth', 'empleador'])->name('empleador');

Route::view('/administrador/inicio', "administrador.index")->middleware(['auth', 'administrador'])->name('administrador');

Route::post('/validar-registro', [LoginController::class, 'register'])->name('validar-registro');

Route::post('/inicia-sesion', [LoginController::class, 'login'])->name('inicia-sesion');

Route::post('/inicia-back', [BacklogController::class, 'login'])->name('inicia-back');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/logout-back', [BacklogController::class, 'logout'])->name('logout-back');

//Verificando el correo



