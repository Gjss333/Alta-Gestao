@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')

@section('conteudo')
    
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Fornecedor - listar</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{  route('app.fornecedor.adicionar') }}">Novo</a></li>
                <li><a href="{{ route('app.fornecedor') }}">Consulta</a></li>
            </ul>2
        </div>

        <div class="informacao-pagina">
            <div style="width: 90%; margin-left: auto; margin-right: auto; padding: 20px;">
                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Site</th>
                            <th>UF</th>
                            <th>E-mail</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($fornecedores as $fornecedor)
                            <tr>
                                <td>{{ $fornecedor->nome }}</td>
                                <td>{{ $fornecedor->site }}</td>
                                <td>{{ $fornecedor->uf }}</td>
                                <td>{{ $fornecedor->email }}</td>
                                <td class="editar"><a href=" {{ route('app.fornecedor.editar', $fornecedor->id) }}">Editar</a></td>
                                <td class="excluir"><a href="{{ route('app.fornecedor.excluir', $fornecedor->id) }}">Excluir</a></td>
                            </tr>
                            
                        @endforeach
                    </tbody>
                </table>
                
                {{ $fornecedores->appends($request)->links() }}
                <br>
                {{ $fornecedores->count() }} - Total de registro por pagina
                <br>
                {{ $fornecedores->firstItem() }} - Número do primeiro registro da página
                <br>
                {{ $fornecedores->lastItem() }} - Número do ultimo registro da página

            </div>
        </div>
    </div>
    
@endsection