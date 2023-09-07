@extends('layoult')

@section('tittle', 'index')

@section('content')

<a href="{{route('emocao-create')}}">criar emocao</a>

<a href="{{route('parametro-create')}}">criar parametro</a>

<a href="{{route('remedio-create')}}">criar remedio</a>

<table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">id</th>
        <th scope="col">nome</th>
        <th scope="col">usuario_id</th>
        <th scope="col">editar</th>
        <th scope="col">excluir</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($parametros as $parametro)
      <tr>
        <th scope="row">{{$parametro->id}}</th>
        <td>{{$parametro->nome}}</td>
        <td>{{$parametro->usuario_id}}</td>
        <td><a href="{{route('parametro-edit', ['id'=>$parametro->id])}}">editar</a></td>
        <td>
        <form action="{{ route('parametro-destroy',['id'=>$parametro->id]) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit">excluir</button>
        </form>    
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <br>
  <br>

  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">id</th>
        <th scope="col">imagem</th>
        <th scope="col">nome</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($emocoes as $emocao)
      <tr>
        <th scope="row">{{$emocao->id}}</th>
        <td><img src="/emocoes/{{$emocao->imagem}}" alt=""></td>
        <td>{{$emocao->nome}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

@endsection