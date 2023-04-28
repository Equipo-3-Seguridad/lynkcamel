<!--Se llama a la plantilla principal ya creada-->
@extends('plantillas.portada')

@section('titulo')
<title>Login</title>
@stop

@section('contenidoPrincipal')
<h3 class="fw-bold text-dark" style="text-align: center;">Login</h3>
<div class="container bg-secondary rounded-3 align-center p-4" style="width: 400px; margin-bottom: 15%;">
    <form action="{{ route('inicia-back') }}" method="post">
        @csrf
        <div class="mb-3">
            <h4 class="fw-bold text-dark"><center>Administrador</center></h4>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold" for="emailInput">Correo</label>
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
        <div class="mb-3 form-check">
            <input id="rememberCheck" class="form-check-input" name="remember" type="checkbox">
            <label class="form-check-label" for="rememberCheck">Recuerdame...</label>
        </div>
        <button class="btn btn-success" type="submit">Acceder</button>
        <a class="btn btn-dark" href="/">Volver</a>
    </form>
</div>
@stop
