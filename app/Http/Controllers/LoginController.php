<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function register(Request $request){
        //validar los datos
        $user = new User();
        $user->name = $request->get('name');
        $user->lastname = $request->get('lastname');
        $user->birth = $request->get('birth');
        $user->gender = $request->get('gender');
        $user->role = $request->get('role');
        $user->email = $request->get('email');
        //cifrando contraseña
        $user->password = Hash::make($request->password);
        $user->save();
        Auth::login($user);
        if($user->role=="Empleador"){
            return redirect(route('empleador'));
        }
        return redirect(route('empleado'));
    }

    public function login(Request $request){
        //Validación
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
}
