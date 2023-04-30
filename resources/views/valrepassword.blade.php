<!--Se llama a la plantilla principal ya creada-->
@extends('plantillas.portada')

@section('titulo')
<title>Login</title>
@stop

@section('contenidoPrincipal')
<h3 class="fw-bold text-dark" style="text-align: center;">Recuperación de Contraseña</h3>
<div class="container bg-secondary rounded-3 align-center p-4" style="width: 400px; margin-bottom: 15%;">
    <form action="{{ route('inicia-sesion') }}" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-bold" for="emailInput">Correo Electronico</label>
            <input id="emailInput" name="email" class="form-control" type="email">
            @error('email')
            <br>
            <small style="color: white; font-weight: bold;">{{$message}}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold" for="passwordInput">Contraseña</label>
            <input id="passwordInput" name="password" class="form-control" type="password">
            @error('password')
            <br>
            <small style="color: white; font-weight: bold;">{{$message}}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold" for="passwordInput">Confirmar contraseña</label>
            <input id="passwordInput" name="password" class="form-control" type="password">
            @error('password')
            <br>
            <small style="color: white; font-weight: bold;">{{$message}}</small>
            @enderror
        </div>

        
        <button class="btn btn-success" type="submit">Restablecer contraseña</button>
        <a class="btn btn-dark" href="/">Volver</a>
    </form>
</div>
@stop