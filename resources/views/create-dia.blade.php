@extends('layoult')

@section('tittle', 'create-dia')

@section('content')

    <h1>Dia</h1>


    <form method="post" enctype="multipart/form-data" action="{{ route('dia-store') }}">
        @csrf
        <div class="mb-3">
            <div id="emocoes">
                @foreach ($emocoes as $emocao)
                    <img src="/emocoes/{{ $emocao->imagem }}" alt="">
                    <input type="radio" name="emocao_id" value="{{ $emocao->id }}">
                    <label for="emocao_id">{{ $emocao->nome }}</label>
                @endforeach
                <br>
                <label for="">Descreva um pouco do seu dia</label>
                <input type="text" name="descricao" id="">
                <br>
                @foreach ($parametros as $parametro)
                    <input type="number" name="parametro_id" value="{{ $parametro->id }}" hidden>
                    <label for="avaliacao">{{ $parametro->nome }}</label>
                    <input type="radio" name="avaliacao[{{$parametro->id}}]" value="0" checked="checked">
                    <label for="avaliacao">0</label>
                    <input type="radio" name="avaliacao[{{$parametro->id}}]" value="1">
                    <label for="avaliacao">1</label>
                    <input type="radio" name="avaliacao[{{$parametro->id}}]" value="2">
                    <label for="avaliacao">2</label>
                    <input type="radio" name="avaliacao[{{$parametro->id}}]" value="3">
                    <label for="avaliacao">3</label>
                    <input type="radio" name="avaliacao[{{$parametro->id}}]" value="4">
                    <label for="avaliacao">4</label>
                    <input type="radio" name="avaliacao[{{$parametro->id}}]" value="5">
                    <label for="avaliacao">5</label>
                    <input type="radio" name="avaliacao[{{$parametro->id}}]" value="6">
                    <label for="avaliacao">6</label>
                    <input type="radio" name="avaliacao[{{$parametro->id}}]" value="7">
                    <label for="avaliacao">7</label>
                    <input type="radio" name="avaliacao[{{$parametro->id}}]" value="8">
                    <label for="avaliacao">8</label>
                    <input type="radio" name="avaliacao[{{$parametro->id}}]" value="9">
                    <label for="avaliacao">9</label>
                    <input type="radio" name="avaliacao[{{$parametro->id}}]" value="10">
                    <label for="avaliacao">10</label>
                @endforeach
            </div>
            <br>
            <button class="btn btn-primary" type="submit" name="button">Salvar</button>
        </div>
    </form>

@endsection
