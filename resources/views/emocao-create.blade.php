@extends('layoult')

@section('tittle', 'emocao')

@section('content')

<form method="post" enctype="multipart/form-data" action="{{route('emocao-store')}}">
  @csrf
  <div class="mb-3">
    <label for="nome" class="form-label">Nome</label>
    <input type="text" class="form-control" id="nome" value="" name="nome" required>
    <label for="foto" class="form-label">Imagem</label>
    <input type="file" accept="image/jpeg" class="form-control" id="imagem" name="imagem">
    <br>
    <button class="btn btn-primary" type="submit" name="button">Salvar</button>
  </div>
</form>

@endsection