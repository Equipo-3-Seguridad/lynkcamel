<!--Se llama a la plantilla empleado ya creada-->
@extends('plantillas.administrador')

@section('titulo')
<title>Administrador</title>
@stop

@section('contenidoPrincipal')
<!--Breadcrumb-->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li id="bread1" class="breadcrumb-item text-dark"><a href="/administrador"><i class="fas fa-home"></i> Inicio</a></li>
        <li id="bread2" class="breadcrumb-item active text-dark" aria-current="page">Bienvenido</li>
    </ol>
</nav>
<h3 class="fw-bold">Yo... Soy ¡Admiiiiiin!</h3>
@stop
