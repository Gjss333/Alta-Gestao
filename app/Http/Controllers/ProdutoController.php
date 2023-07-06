<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Unidade;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $produtos = Produto::simplePaginate(10);

      return view('app.produto.index', ['produtos' => $produtos, 'request' => $request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unidades = Unidade::all();
        return view('app.produto.create', ['unidades' => $unidades]);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $regras = [
            'nome' => 'required|min:3|max:40',
            'descricao' => 'required|min:3|max:2000',
            'peso' => 'required|integer',
            'unidade_id' => 'exists:unidades,id'
        ];

        $feedback = [
            'required' => 'o campo :attribute deve ser preenchido',
            'nome.min' => 'o campo nome deve ter no mínimo 3 caracteres',
            'nome.max' => 'o campo nome deve ter no máximo 40 caracteres',
            'descricao.min' => 'o campo descricação deve ter no mínimo 3 caracteres',
            'descricao.max' => 'o campo descricao deve ter no máximo 2000 caracteres',
            'peso.interger' => 'o campo peso deve ser um número inteiro',
            'unidade_id.exists' => 'a unidade de medida informada não existe',
        ];

        $request->validate($regras, $feedback);

        Produto::create($request->all());
        return redirect()->route('produto.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        return view('app.produto.show', ['produto' => $produto]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        $unidades = Unidade::all();
        return view('app.produto.edit', ['produto' => $produto, 'unidades' => $unidades]);
        //return view('app.produto.create', ['produto' => $produto, 'unidades' => $unidades]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        $produto->update($request->all());

        return redirect()->route('produto.show', ['produto' => $produto->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();

        return redirect()->route('produto.index', ['produto' => $produto->id]);
    }
}
