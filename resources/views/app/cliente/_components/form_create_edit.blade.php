@if(isset($cliente->id))
    <form action="{{ route('cliente.update', ['cliente' => $cliente ]) }}" method="POST">
        @csrf
        @method('PUT')
@else
    <form action="{{ route('cliente.store') }}" method="POST">
        @csrf
@endif

        <input type="text" name="nome" value="{{ $cliente->nome ?? old('nome') }}" placeholder="Nome cliente" class="borda-preta">
        {{ $errors->has('nome') ? $errors->first('nome') : '' }}

        <button class="borda-preta">cadastrar</button>
</form>