<?php

namespace App\Http\Controllers;

use App\Models\ItemDetalhe;
use App\Models\ProdutoDetalhe;
use App\Models\Unidade;
use Illuminate\Http\Request;

class ProdutoDetalheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        echo 'Aqui é a pagina inicial de teste';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unidades = Unidade::all();
        return view('app.produto_detalhe.create', ['unidades' => $unidades]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $regras = [
            'produto_id' => 'exists:produtos,id',
            'comprimento' => 'required',
            'largura' => 'required',
            'altura' => 'required',
            'unidade_id' => 'exists:unidades,id'
        ];

        $feedback = [
            'required' => 'o campo :attribute deve ser preenchido',
            'produto_id.exists' => 'o Id informado não corresponde ao produto cadastrado',
            'unidade_id.exists' => 'a unidade de medida informada não existe'
        ];

        
        $request->validate($regras, $feedback);

        ProdutoDetalhe::create($request->all());
        echo 'cadastro realizado com sucesso';
        return redirect()->route('produto-detalhe.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $produtoDetalhe = ItemDetalhe::with(['item'])->find($id);
        $unidades = Unidade::all();
        return view('app.produto_detalhe.edit', ['produto_detalhe' => $produtoDetalhe, 'unidades' => $unidades]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProdutoDetalhe $produtoDetalhe)
    {
        $produtoDetalhe->update($request->all());
        echo 'atualizado com sucesso';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
