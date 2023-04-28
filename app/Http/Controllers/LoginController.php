<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Notifications\VerifyEmail;


class LoginController extends Controller
{
    public function register(Request $request){
        $user = new User();
        //validar los datos
        $datosValidados = $this->validar($request);
        //Se obtienen los valores de la vista
        $user->name = $request->get('name');
        $user->lastname = $request->get('lastname');
        $user->birth = $request->get('birth');
        $user->gender = $request->get('gender');
        $user->role = $request->get('role');
        $user->email = $request->get('email');
        //cifrando contraseña
        $user->password = Hash::make($request->password);
        $user->save();
        //Enviando correo de verificación
        $user->notify(new VerifyEmail);
        //Iniciando sesión
        Auth::login($user);
        if($user->role=="Empleador"){
            return redirect(route('empleador'));
        }
        return redirect(route('empleado'));
    }

    public function login(Request $request){
        //Validación
        $datosValidados = $this->validarLog($request);

        $credentials = [
            "role" => $request->get('role'),
            "email" => $request->get('email'),
            "password" => $request->get('password')
            //"active" => true
        ];

        $remember = ($request->has('remember') ? true:false);

        if(Auth::attempt($credentials, $remember)){
            $request->session()->regenerate();
            //dependiendo del rol
            if($credentials["role"]=='Empleado'){
                return redirect()->intended('/empleado/inicio');
            }else if($credentials["role"]=='Empleador'){
                return redirect()->intended('/empleador/inicio');
            }
        }else{
            return redirect('login');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'));
    }

    public function validar(Request $request){
        //Aqui se establecen las reglas de validacion y los mensajes personalizados
        //No olvides que las cadenas de regex deben ir delimitadas por diagonales, ej:
        //regex:/^[A-Za-z0-9áéíóúüñÑÁÉÍÓÚÜ\s]{2,30}$/
        $datosValidos = $request->validate([
            'name' => 'required|string|min:2|max:20|regex:/^[A-Za-z0-9áéíóúüñÑÁÉÍÓÚÜ\s]{2,30}$/',
            'lastname' => 'required|string|min:3|max:30|regex:/^[A-Za-z0-9áéíóúüñÑÁÉÍÓÚÜ\s]{2,30}$/',
            'birth' => 'required|string|min:8|max:10|regex:/^\d{4}-\d{2}-\d{2}$/',
            'gender' => 'required|string|min:1|max:1|regex:/^[MF]$/',
            'role' => 'required|string|min:2|max:12|regex:/^[A-Za-z0-9áéíóúüñÑÁÉÍÓÚÜ\s]{2,12}$/',
            'email' => 'required|string|min:5|max:20|regex:/^([a-zA-Z0-9._%+-]+)@([a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/',
            'password' => 'required|string|min:8|max:20|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,20}$/',
            'password2' => 'required|string|min:8|max:20|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,20}$/',
        ],//Personalizando los mensajes de error
        [
            'name.required' => 'El nombre es obligatorio',
            'name.string' => 'Solo se aceptan cadenas de texto',
            'name.min' => 'No se aceptan nombres de menos de 2 caracteres',
            'name.max' => 'No se aceptan nombres de más de 2 caracteres',
            'name.regex' => 'No se aceptan caracteres especiales',
            'lastname.required' => 'El apellido es obligatorio',
            'lastname.string' => 'Solo se aceptan cadenas de texto',
            'lastname.min' => 'No se aceptan apellidos de menos de 3 caracteres',
            'lastname.max' => 'No se aceptan apellidos de más de 30 caracteres',
            'lastname.regex' => 'No se aceptan caracteres especiales',
            'birth.required' => 'La fecha de nacimiento es obligatoria',
            'birth.string' => 'Solo se aceptan valores con estructura de fecha',
            'birth.min' => 'No se aceptan fechas de menos de 8 caracteres',
            'birth.max' => 'No se aceptan fechas de más de 10 caracteres',
            'birth.regex' => 'Solo se aceptan fechas con la siguiente estructura dd/mm/aaaa',
            'gender.required' => 'El genero es necesario',
            'gender.string' => 'Solo se acepta 1 caracter',
            'gender.min' => 'No se acepta menos de 1 caracter',
            'gender.max' => 'No se acepta más de 1 caracter',
            'gender.regex' => 'Solo se aceptan valores M o F',
            'role.required' => 'El rol es obligatorio',
            'role.string' => 'Solo se aceptan cadenas de texto',
            'role.min' => 'No se aceptan cadenas de menos de 2 caracteres',
            'role.max' => 'No se aceptan cadenas de más de 2 caracteres',
            'role.regex' => 'No se aceptan caracteres especiales',
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
            'password2.required' => 'La contraseña es obligatoria',
            'password2.string' => 'Solo se aceptan contraseñas',
            'password2.min' => 'No se aceptan contraseñas de menos de 8 caracteres',
            'password2.max' => 'No se aceptan contraseñas de más de 20 caracteres',
            'password2.regex' => 'La contraseña debe contener al menos 1 letra mayuscula, 1 minuscula, 1 número y 1 caracter especial',
        ]);
        return $datosValidos;
    }

    public function validarLog(Request $request){
        //Aqui se establecen las reglas de validacion y los mensajes personalizados
        //No olvides que las cadenas de regex deben ir delimitadas por diagonales, ej:
        //regex:/^[A-Za-z0-9áéíóúüñÑÁÉÍÓÚÜ\s]{2,30}$/
        $datosValidos = $request->validate([
            'role' => 'required|string|min:2|max:12|regex:/^[A-Za-z0-9áéíóúüñÑÁÉÍÓÚÜ\s]{2,12}$/',
            'email' => 'required|string|min:5|max:20|regex:/^([a-zA-Z0-9._%+-]+)@([a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/',
            'password' => 'required|string|min:8|max:20|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,20}$/',
        ],//Personalizando los mensajes de error
        [
            'role.required' => 'El rol es obligatorio',
            'role.string' => 'Solo se aceptan cadenas de texto',
            'role.min' => 'No se aceptan cadenas de menos de 2 caracteres',
            'role.max' => 'No se aceptan cadenas de más de 2 caracteres',
            'role.regex' => 'No se aceptan caracteres especiales',
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
