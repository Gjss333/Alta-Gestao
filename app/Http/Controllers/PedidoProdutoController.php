<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\PedidoProduto;
use App\Models\Produto;
use Illuminate\Http\Request;

class PedidoProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create(Pedido $pedido)
    {
        $produtos = Produto::all();
        $pedido->produtos;
        return view('app.pedido_produto.create', ['pedido' => $pedido, 'produtos' => $produtos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Pedido $pedido)
    {
        $regras = [
            'produto_id' => 'exists:produtos,id',
            'quantidade' => 'required'
        ];

        $feedback = [
            'produto_id.exists' => 'O Produto informado não existe',
            'required' => 'O campo :attribute deve possuir um valor válido'
        ];

        $request->validate($regras, $feedback);
        
        /* 
         $pedidoProduto = new PedidoProduto();
         $pedidoProduto->pedido_id = $pedido->id;     
         $pedidoProduto->produto_id = $request->get('produto_id');
         $pedidoProduto->quantidade = $request->get('quantidade');
         $pedidoProduto->save();
         
         dd($request->all());
         PedidoProduto::create([
             'pedido_id' => $pedido->id,
             'produto_id' => $request->get('produto_id')]
            );
            
            tentar depois
            PedidoProduto::create($request->all($request->get('produto_id')));
        */
        
        //a funcão attach permite adicionar as informações que devem ser inseridas na tabela
        //que guarda o relacionamento N para N, entre os models no contexto
        $pedido->produtos()->attach(
            $request->get('produto_id'),
            ['quantidade' =>$request->get('quantidade')]
        );

        return redirect()->route('app.pedido-produto.create', ['pedido' => $pedido->id]);

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PedidoProduto $pedidoProduto, $pedido_id)
    {
        // PedidoProduto::where(['pedido_id' => $pedido->id, 'produto_id' => $produto->id])->delete();
        
        // faz o delete utilizando o relacionamento belongtoMany
        $pedidoProduto->delete();

        return redirect()->route('app.pedido-produto.create', ['pedido' => $pedido_id]);
    }
}
