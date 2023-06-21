<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function index(Request $request){
        
        $error =  $request->get('erro');
        return view('site.login', ['titulo' => 'Login', 'error' => $error]);
    }

    public function autenticar(Request $request) {


        $regras = [
            'usuario' => 'email',
            'senha' => 'required'
        ];

        $feedback = [
            'usuario.email' => 'o email preenchido não é válido',
            'senha.required' => 'O campo :attribute precisa ter preenchido'
        ];

        $request->validate($regras, $feedback);

        // recuperando os parametros do login
        $email = $request->get('usuario');
        $password = $request->get('senha');

        echo "usuario: $email | Senha: $password";
        print_r($request->all());

        $user = new User();

        $existe = $user->where('email', $email)
                ->where('password', $password)
                ->get()
                ->first();
        
        if(isset($existe->name)){
            echo "usuário existe";
        }else{
            return redirect()->route('site.login', ['error' => 1]);
        }
     
    }
}
