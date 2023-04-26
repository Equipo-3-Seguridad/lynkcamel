<?php

use Illuminate\Support\Facades\Route;

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
    return view('inicio.misionvision');
});

Route::get('/empleos', function () {
    return view('inicio.misionvision');
});

Route::get('/politica-privacidad', function () {
    return view('inicio.pprivacidad');
});

Route::get('/politica-uso', function () {
    return view('inicio.puso');
});

Route::get('/aviso-privacidad', function () {
    return view('inicio.aprivacidad');
});
