<!--Se llama a la plantilla empleado ya creada-->
@extends('plantillas.empleador')

@section('titulo')
<title>Empleador</title>
@stop

@section('contenidoPrincipal')
<!--Breadcrumb-->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li id="bread1" class="breadcrumb-item text-dark"><a href="/empleador"><i class="fas fa-home"></i> Inicio</a></li>
        <li id="bread2" class="breadcrumb-item active text-dark" aria-current="page">Bienvenido</li>
    </ol>
</nav>
<h3 class="fw-bold">Bienvenido a tu busqueda de equipos!!!</h3>
@stop
