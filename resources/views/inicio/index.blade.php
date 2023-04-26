<!--Se llama a la plantilla principal ya creada-->
@extends('plantillas.portada')

@section('titulo')
<title>Bienvenidos!!!</title>
@stop

@section('contenidoPrincipal')
<!--Breadcrumb-->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li id="bread1" class="breadcrumb-item active text-dark" aria-current="page"><i class="fas fa-home"></i> Inicio</li>
    </ol>
</nav>
<div class="">
    <h3 class="text-dark fw-bold m">Bienvenidos a Lynk Camel</h3>
    <p>Camel es un sitio web que permite a los usuarios que estan interesados en buscar empleo tanto como profesionistas asi como de oficio, esto conecta con usuarios con empleadores con el objetivo de que consigas un empleo digno de sus habilidades o talentos. </p>
    <a href="" class="btn btn-success" style="margin-left: 1%;">Empezar</a>
</div>
@stop
