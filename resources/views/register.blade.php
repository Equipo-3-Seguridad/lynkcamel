<!--Se llama a la plantilla principal ya creada-->
@extends('plantillas.portada')

@section('titulo')
<title>Registro</title>
@stop

@section('contenidoStyles')

@stop

@section('contenidoPrincipal')
<h3 class="fw-bold text-dark" style="text-align: center;">Registro</h3>
<br>
<div class="container bg-secondary rounded-3 align-center p-3" style="width: 400px; margin-bottom: 15%;">
    <form action="{{ route('validar-registro') }}" method="post">
        @csrf
        <br>
        <div class="mb-3">
            <label class="form-label fw-bold mx-1" for="">Nombre</label>
            <input id="nameInput" name="name" class="form-control" type="text" required autocomplete="disable">
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold mx-1" for="">Apellido</label>
            <input id="lastnameInput" name="lastname" class="form-control" type="text" required autocomplete="disable">
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold mx-1" for="">Fecha de Nacimiento</label><br>
            <input class="form-control" type="date" name="birth" value="dd/mm/yyyy">
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold mx-1" for="">Sexo</label><br>
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-secondary">
                    <input type="radio" name="gender" id="option1" value="M" autocomplete="off"> Masculino
                </label>
                <label class="btn btn-secondary">
                    <input type="radio" name="gender" id="option2" value="F" autocomplete="off"> Femenino
                </label>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold mx-1" for="">Rol</label><br>
            <div class="form-group">
                <select class="form-control bg-secondary border-light text-light" id="role" name="role">
                    <option value="default">Elige tu Usuario</option>
                    <option value="empleado">Empleado</option>
                    <option value="empleador">Empleador</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold" for="emailInput">Correo</label>
            <input id="emailInput" name="email" type="email" class="form-control" required autocomplete="disable">
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold" for="passwordInput">Contraseña</label>
            <input id="passwordInput" name="password" class="form-control" type="password" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold" for="passwordInput">Comprueba tu Contraseña</label>
            <input id="passwordInput" name="password2" class="form-control" type="password" required>
        </div>
        <div class="">
            <button class="btn btn-success" type="submit">Registrarse</button>
            <a class="btn btn-dark text-light" href="/">Cancelar</a>
        </div>
        <br>
    </form>
</div>
@stop
