@extends('layoult')

@section('tittle', 'edit-remedio')

@section('content')

<h1>remedio</h1>


<form action="{{ route('remedio-update', ['id'=>$remedio->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label for="nome" class="form-label">Nome</label>
      <input type="text" class="form-control" id="nome" name="nome" value="{{$remedio->nome}}">
      <br>
      <button class="btn btn-primary" type="submit" name="button">Salvar</button>
    </div>
  </form>

@endsection