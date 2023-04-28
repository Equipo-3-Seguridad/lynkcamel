<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class BacklogController extends Controller
{
    public function login(Request $request){
        //Validación
        $datosValidados = $this->validar($request);

        $credentials = [
            "role" => 'Admin',
            "email" => $request->get('email'),
            "password" => $request->get('password')
            //"active" => true
        ];

        $remember = ($request->has('remember') ? true:false);

        if(Auth::attempt($credentials, $remember)){
            $request->session()->regenerate();
            return redirect()->intended('/administrador/inicio');
        }else{
            return redirect('backlog');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('backlog'));
    }

    public function validar(Request $request){
        //Aqui se establecen las reglas de validacion y los mensajes personalizados
        //No olvides que las cadenas de regex deben ir delimitadas por diagonales, ej:
        //regex:/^[A-Za-z0-9áéíóúüñÑÁÉÍÓÚÜ\s]{2,30}$/
        $datosValidos = $request->validate([
            'email' => 'required|string|min:5|max:20|regex:/^([a-zA-Z0-9._%+-]+)@([a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/',
            'password' => 'required|string|min:8|max:20|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,20}$/',
        ],//Personalizando los mensajes de error
        [
            'email.required' => 'El correo electrónico es obligatorio',
            'email.string' => 'Solo se aceptan correos electrónicos',
            'email.min' => 'No se aceptan correos electrónicos de menos de 5 caracteres',
            'email.max' => 'No se aceptan correos electronicos de más de 20 caracteres',
            'email.regex' => 'Solo se aceptan correos electrónicos que cumplan con la estructura adecuada',
            'password.required' => 'La contraseña es obligatoria',
            'password.string' => 'Solo se aceptan contraseñas',
            'password.min' => 'No se aceptan contraseñas de menos de 8 caracteres',
            'password.max' => 'No se aceptan contraseñas de más de 20 caracteres',
            'password.regex' => 'La contraseña debe contener al menos 1 letra mayuscula, 1 minuscula, 1 número y 1 caracter especial',
        ]);
        return $datosValidos;
    }
}
