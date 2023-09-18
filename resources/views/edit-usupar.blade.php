@extends('layoult')

@section('tittle', 'edit-usupar')

@section('content')

    <h1>edit-usupar</h1>


    <form method="post" enctype="multipart/form-data" action="{{ route('usupar-update') }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <input type="date" name="dia" for="dia" value="{{ $dia }}" hidden>
            @foreach ($usuario_parametros as $usuario_parametro)
                <input type="number" name="parametro_id" value="{{ $usuario_parametro->parametro->id }}" hidden>
                <label for="avaliacao[{{ $usuario_parametro->parametro->id }}]">{{ $usuario_parametro->parametro->nome }}</label>
                <input type="radio" name="avaliacao[{{ $usuario_parametro->parametro->id }}]" value="0"
                    {{ $usuario_parametro->avaliacao == 0 ? 'checked' : '' }}>
                <label for="avaliacao">0</label>
                <input type="radio" name="avaliacao[{{ $usuario_parametro->parametro->id }}]" value="1"
                    {{ $usuario_parametro->avaliacao == 1 ? 'checked' : '' }}>
                <label for="avaliacao">1</label>
                <input type="radio" name="avaliacao[{{ $usuario_parametro->parametro->id }}]" value="2"
                    {{ $usuario_parametro->avaliacao == 2 ? 'checked' : '' }}>
                <label for="avaliacao">2</label>
                <input type="radio" name="avaliacao[{{ $usuario_parametro->parametro->id }}]" value="3"
                    {{ $usuario_parametro->avaliacao == 3 ? 'checked' : '' }}>
                <label for="avaliacao">3</label>
                <input type="radio" name="avaliacao[{{ $usuario_parametro->parametro->id }}]" value="4"
                    {{ $usuario_parametro->avaliacao == 4 ? 'checked' : '' }}>
                <label for="avaliacao">4</label>
                <input type="radio" name="avaliacao[{{ $usuario_parametro->parametro->id }}]" value="5"
                    {{ $usuario_parametro->avaliacao == 5 ? 'checked' : '' }}>
                <label for="avaliacao">5</label>
                <input type="radio" name="avaliacao[{{ $usuario_parametro->parametro->id }}]" value="6"
                    {{ $usuario_parametro->avaliacao == 6 ? 'checked' : '' }}>
                <label for="avaliacao">6</label>
                <input type="radio" name="avaliacao[{{ $usuario_parametro->parametro->id }}]" value="7"
                    {{ $usuario_parametro->avaliacao == 7 ? 'checked' : '' }}>
                <label for="avaliacao">7</label>
                <input type="radio" name="avaliacao[{{ $usuario_parametro->parametro->id }}]" value="8"
                    {{ $usuario_parametro->avaliacao == 8 ? 'checked' : '' }}>
                <label for="avaliacao">8</label>
                <input type="radio" name="avaliacao[{{ $usuario_parametro->parametro->id }}]" value="9"
                    {{ $usuario_parametro->avaliacao == 9 ? 'checked' : '' }}>
                <label for="avaliacao">9</label>
                <input type="radio" name="avaliacao[{{ $usuario_parametro->parametro->id }}]" value="10"
                    {{ $usuario_parametro->avaliacao == 10 ? 'checked' : '' }}>
                <label for="avaliacao">10</label>
                <br>
            @endforeach
            <button class="btn btn-primary" type="submit" name="button">Salvar</button>
        </div>
    </form>

@endsection
