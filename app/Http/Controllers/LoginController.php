<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function index(Request $request){
        
        $erro  = '';

        if($request->get('erro') == 1){
            $erro = 'Usuário ou senha não existe';
        }
        
        if($request->get('erro') == 2){
            $erro = 'necessário realizar login para ter acesso a pagina';
        }
        
        return view('site.login', ['titulo' => 'Login', 'erro' => $erro]);
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

        $user = new User();

        $existe = $user->where('email', $email)
                ->where('password', $password)
                ->get()
                ->first();
        
        if(isset($existe->name)){

            session_start();
            $_SESSION['nome'] = $existe->name; 
            $_SESSION['email'] = $existe->email; 

            return redirect()->route('app.clientes');
        }else{
            return redirect()->route('site.login', ['erro' => 1]);
        }
     
    }
}
