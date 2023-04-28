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
}
