@extends('layoult')

@section('tittle', 'create-dia')

@section('content')

    <h1>Dia {{ date('d/m/Y', strtotime($dia)) }}</h1>


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
                <input type="text" name="descricao">

                <br>

                @foreach ($parametros as $parametro)
                    <input type="number" name="parametro_id" value="{{ $parametro->id }}" hidden>
                    <label for="avaliacao">{{ $parametro->nome }}</label>
                    <input type="radio" name="avaliacao[{{ $parametro->id }}]" value="0">
                    <label for="avaliacao">0</label>
                    <input type="radio" name="avaliacao[{{ $parametro->id }}]" value="1">
                    <label for="avaliacao">1</label>
                    <input type="radio" name="avaliacao[{{ $parametro->id }}]" value="2">
                    <label for="avaliacao">2</label>
                    <input type="radio" name="avaliacao[{{ $parametro->id }}]" value="3">
                    <label for="avaliacao">3</label>
                    <input type="radio" name="avaliacao[{{ $parametro->id }}]" value="4">
                    <label for="avaliacao">4</label>
                    <input type="radio" name="avaliacao[{{ $parametro->id }}]" value="5">
                    <label for="avaliacao">5</label>
                    <input type="radio" name="avaliacao[{{ $parametro->id }}]" value="6">
                    <label for="avaliacao">6</label>
                    <input type="radio" name="avaliacao[{{ $parametro->id }}]" value="7">
                    <label for="avaliacao">7</label>
                    <input type="radio" name="avaliacao[{{ $parametro->id }}]" value="8">
                    <label for="avaliacao">8</label>
                    <input type="radio" name="avaliacao[{{ $parametro->id }}]" value="9">
                    <label for="avaliacao">9</label>
                    <input type="radio" name="avaliacao[{{ $parametro->id }}]" value="10">
                    <label for="avaliacao">10</label>
                @endforeach

                <br>

                @foreach ($remedios as $remedio)
                    <input type="number" name="parametro_id" value="{{ $remedio->id }}" hidden>
                    <label for="">{{ $remedio->nome }}</label>
                    <label for="">Tomou</label>
                    <input type="radio" name="status[{{ $remedio->id }}]" value="1">
                    <label for="">Não tomou</label>
                    <input type="radio" name="status[{{ $remedio->id }}]" value="0">
                    <br>
                @endforeach

            </div>
            <br>
            <a class="btn btn-info" href="{{route('index')}}">Voltar</a>
            <button class="btn btn-primary" type="submit" name="button">Salvar</button>
        </div>
    </form>

@endsection
