<?php

namespace App\Http\Controllers;

use App\Models\MotivoContato;
use App\Models\SiteContato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function contato(Request $request){

        //usando o contructor
        // $contato = new SiteContato();
        // $contato->nome = $request->input('nome');
        // $contato->telefone = $request->input('telefone');
        // $contato->email = $request->input('email');
        // $contato->motivo_contato = $request->input('motivo_contato');
        // $contato->mensagem = $request->input('mensagem');
        // $contato->save();

        // $contato->fill($request->all());
        // $contato->save();

        // if($_SERVER["REQUEST_METHOD"] == "POST")
        // {
        //     $contato->fill($request->all());
 
        //     $contato->save();
        // }

        $motivo_contatos = MotivoContato::all();

        return view('site.contato', ['titulo' => 'Contato', 'motivo_contatos' => $motivo_contatos]);
    }


    public function salvar(Request $request){ 
        
        $request->validate([
            'nome' => 'required|min:3|max:40|unique:site_contatos',
            'telefone' => 'required',
            'email' => 'email',
            'mensagem' => 'required|max:2000',
            'motivo_contatos_id' => 'required'
        ]);
        
        SiteContato::create($request->all());


        return redirect()->route('site.index');

    }
}
