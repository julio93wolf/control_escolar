<?php

namespace App\Http\Controllers\Auth;

use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    
    public function showLoginForm()
    {
        if(\Session::has('usuario')){
            return "Logueado";
        }
        return view('auth.login');
    }
    
    public function login(Request $req)
    {
        $usuario = Usuario::where('email',$req->email)->first();
        if($usuario){
            if(password_verify($req -> password,$usuario -> password)){
                \Session::put('usuario', $usuario);
                return redirect(route('showLoginForm'));
            }else{
                \Session::flash('msg','Tus credenciales son incorrectas. Favor de revisarlas e intente de nuevo.');        
            }
        }else{
            \Session::flash('msg','Usuario no registrado');    
        }
        return redirect(route('login'));
    }

    public function logout()
    {
        \Session::flush();
            \Session::flash('msg','Has terminado tu sesión.');
            return redirect('login');
    }
    
}
