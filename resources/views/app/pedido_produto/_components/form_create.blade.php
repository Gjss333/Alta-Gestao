<form action="{{ route('app.pedido-produto.store', ['pedido' => $pedido]) }}" method="POST">
    @csrf
  
    <select name="produto_id"> 
        <option>Selecione um produto</option>

        @foreach ($produtos as $produto)
            <option value="{{ $produto->id }}" {{  old('produto_id') == $produto->id ? 'selected' : '' }} >{{ $produto->nome }}</option>
        @endforeach
    </select> 
    {{ $errors->has('produto_id') ? $errors->first('produto_id') : '' }}

    <button class="borda-preta">cadastrar</button>
</form>