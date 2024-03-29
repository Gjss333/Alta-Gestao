@extends('app.layouts.basico')

@section('titulo', 'Produto')

@section('conteudo')
    
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Listagem de produtos</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('produto.create') }}">Novo</a></li>
                <li><a href="">Consulta</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width: 90%; margin-left: auto; margin-right: auto; padding: 20px;">
                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Nome Fornecedor</th>
                            <th>Site do Fornecedor</th>
                            <th>Peso</th>
                            <th>Unidade ID</th>
                            <th>Comprimento</th>
                            <th>Altura</th>
                            <th>Largura</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($produtos as $produto)
                            <tr>
                                <td>{{ $produto->nome }}</td>
                                <td>{{ $produto->descricao }}</td>
                                <td>{{ $produto->fornecedor->nome }}</td>
                                <td>{{ $produto->fornecedor->site }}</td>
                                <td>{{ $produto->peso }}</td>
                                <td>{{ $produto->unidade_id }}</td>
                                <td>{{ $produto->itemDetalhe->comprimento ?? '' }}</td>
                                <td>{{ $produto->itemDetalhe->altura ?? ''}}</td>
                                <td>{{ $produto->itemDetalhe->largura ?? ''}}</td>
                                <td class="editar show"><a href="{{ route('produto.show', ['produto' => $produto->id]) }}">Visualizar</a></td>
                                <td class="editar"><a href="{{ route('produto.edit', ['produto' => $produto->id ]) }}">Editar</a></td>
                                <td class="excluir">
                                    <form id="form_{{$produto->id}}" action="{{ route('produto.destroy', ['produto' => $produto->id]) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        {{-- <button>Excluir</button> usar o botão é a forma mais segura--}}
                                        <a href="#" onclick="document.getElementById('form_{{$produto->id}}').submit()">Excluir</a>
                                    </form>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="12">
                                    <p>Pedidos</p>

                                    @foreach ($produto->pedidos as $pedido)
                                        <a href="{{ route('app.pedido-produto.create', ['pedido' => $pedido->id]) }}">
                                            {{ $pedido->id }}
                                        </a>
                                    @endforeach
                                </td>
                            </tr>
                            
                        @endforeach
                    </tbody>
                </table>
                
                {{ $produtos->appends($request)->links() }}
                <br>
                {{ $produtos->count() }} - Total de registro por pagina
                <br>
                {{ $produtos->firstItem() }} - Número do primeiro registro da página
                <br>
                {{ $produtos->lastItem() }} - Número do ultimo registro da página

            </div>
        </div>
    </div>
    
@endsection