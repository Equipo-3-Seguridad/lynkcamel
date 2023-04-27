<!--Se llama a la plantilla principal ya creada-->
@extends('plantillas.portada')

@section('titulo')
<title>Privado</title>
@stop

@section('contenidoPrincipal')
<h3 class="fw-bold text-dark" style="text-align: center;">Página Privada</h3>
<div class="container">
    <label class="text-dark fw-bold">Página Privada</label>
    <a class="btn btn-outline-danger" href="{{ route('logout') }}">Salir</a><br>
    <label class="fw-bold" for="">Usuario: @auth {{ Auth::user()->name }} @endauth</label>
    <h3 class="fw-bold" style="margin-left: 0%; margin-top: 1%;">Bienvenido...</h3>
</div>
@stop
