<h3>Fornecedor</h3>

@isset($fornecedores)

    @forelse ($fornecedores as $indece => $fornecedor)
    
        Iteração: {{$loop->iteration}}
        Fornecedor: {{ $fornecedor['nome'] }}
        <br>
        Status: {{ $fornecedor['status'] }}
        <br>
        CNPJ: {{ $fornecedor['cnpj'] ?? 'Dado não foi preenchido' }}
        <br>
        telefone: ({{ $fornecedor['ddd'] ?? '' }}) {{ $fornecedor['telefone'] ?? '' }}
        <hr>
        
        @empty 
            Não existem fornecedores cadastrados
    @endforelse

@endisset

