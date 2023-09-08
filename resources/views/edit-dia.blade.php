@extends('layoult')

@section('tittle', 'edit-dia')

@section('content')

    <h1>edit-dia</h1>

    <form method="post" enctype="multipart/form-data" action="{{ route('dia-update', ['id' => $usuario_emocao->id]) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <div id="emocoes">
                @foreach ($emocoes as $emocao)
                    <img src="/emocoes{{ $emocao->imagem }}" alt="">
                    <input type="radio" name="emocao_id" value="{{ $emocao->id }}">
                    <label for="">{{ $emocao->nome }}</label>
                @endforeach
            </div>
            <br>
            <label for="">Descreva um pouco do seu dia</label>
            <input type="text" name="descricao" id="" value="{{ $usuario_emocao->descricao }}">
        </div>
        <br>
        <button class="btn btn-primary" type="submit" name="button">Salvar</button>
        </div>
    </form>

@endsection
