<!--Se llama a la plantilla empleado ya creada-->
@extends('plantillas.empleado')

@section('titulo')
<title>Empleado</title>
@stop

@section('contenidoPrincipal')
<!--Breadcrumb-->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li id="bread1" class="breadcrumb-item text-dark"><a href="/empleado"><i class="fas fa-home"></i> Inicio</a></li>
        <li id="bread2" class="breadcrumb-item active text-dark" aria-current="page">Bienvenido</li>
    </ol>
</nav>
<h3 class="fw-bold">Bienvenido a tu nueva busqueda de empleo!!!</h3>
@stop
