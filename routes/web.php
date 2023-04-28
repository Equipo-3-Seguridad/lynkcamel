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
//Rutas exteriores
Route::resource('/empleos', 'App\Http\Controllers\empleosController');
Route::view('/login', "login")->name('login');
Route::view('/backlog', "backlog")->name('backlog');
Route::view('/registro', "register")->name('registro');
//Ruta sin protección
/*Route::view('/privada', "secret")->name('privada');*/
//Rutas correspondientes a cada usuario
//Rutas del empleado
Route::view('/empleado/inicio', "empleado.index")->middleware(['auth', 'empleado'])->name('empleado');
Route::view('/empleado/politica-privacidad', "legalempleado.pprivacidad")->middleware(['auth', 'empleado'])->name('empleadoppriv');
Route::view('/empleado/aviso-privacidad', "legalempleado.aprivacidad")->middleware(['auth', 'empleado'])->name('empleadoapriv');
Route::view('/empleado/politica-uso', "legalempleado.puso")->middleware(['auth', 'empleado'])->name('empleadopuso');
Route::view('/empleado/conocenos', "legalempleado.misionvision")->middleware(['auth', 'empleado'])->name('empleadomisionvision');

Route::view('/empleador/inicio', "empleador.index")->middleware(['auth', 'empleador'])->name('empleador');
Route::view('/empleador/politica-privacidad', "legalempleador.pprivacidad")->middleware(['auth', 'empleador'])->name('empleadorppriv');
Route::view('/empleador/aviso-privacidad', "legalempleador.aprivacidad")->middleware(['auth', 'empleador'])->name('empleadorapriv');
Route::view('/empleador/politica-uso', "legalempleador.puso")->middleware(['auth', 'empleador'])->name('empleadorpuso');
Route::view('/empleador/conocenos', "legalempleador.misionvision")->middleware(['auth', 'empleador'])->name('empleadormisionvision');

Route::view('/administrador/inicio', "administrador.index")->middleware(['auth', 'administrador'])->name('administrador');
Route::view('/administrador/politica-privacidad', "legaladministrador.pprivacidad")->middleware(['auth', 'administrador'])->name('administradorppriv');
Route::view('/administrador/aviso-privacidad', "legaladministrador.aprivacidad")->middleware(['auth', 'administrador'])->name('administradorapriv');
Route::view('/administrador/politica-uso', "legaladministrador.puso")->middleware(['auth', 'administrador'])->name('administradorpuso');
Route::view('/administrador/conocenos', "legaladministrador.misionvision")->middleware(['auth', 'administrador'])->name('administradormisionvision');

Route::post('/validar-registro', [LoginController::class, 'register'])->name('validar-registro');

Route::post('/inicia-sesion', [LoginController::class, 'login'])->name('inicia-sesion');

Route::post('/inicia-back', [BacklogController::class, 'login'])->name('inicia-back');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/logout-back', [BacklogController::class, 'logout'])->name('logout-back');

//Verificando el correo
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware(['auth'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed', 'throttle:6,1'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


