@extends('layoult')

@section('tittle', 'create-dia')

@section('content')

<h1>parametro</h1>


<form method="post" enctype="multipart/form-data" action="{{route('dia-store')}}">
    @csrf
    <div class="mb-3">
        <div id="emocoes">
      @foreach ($emocoes as $emocao)
          <img src="/emocoes/{{$emocao->imagem}}" alt="">
          <input type="radio" name="emocao_id" value="{{$emocao->id}}">
          <label for="emocao_id">{{$emocao->nome}}</label>
      @endforeach
      <br>
      <label for="">Descreva um pouco do seu dia</label>
      <input type="text" name="descricao" id="">
    </div>
      <br>
      <button class="btn btn-primary" type="submit" name="button">Salvar</button>
    </div>
  </form>

@endsection