<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'peso',
        'unidade_id'
    ];

    public function produtoDetalhe(){
        //produto tem 1 produto-Detalhe
        //O ORM Vai entender que ele precisa procurar um registro
        //relacionado em produtoDetalhes com base na (fk -> produto_id)
        return $this->hasOne(ProdutoDetalhe::class);
    }
}
