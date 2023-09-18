@extends('layoult')

@section('tittle', 'edit-usupar')

@section('content')

    <h1>edit-usupar</h1>
    <form method="post" enctype="multipart/form-data" action="{{ route('usurem-update', ['id' => $usuario_remedio->id]) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <input type="number" name="parametro_id" value="{{ $usuario_remedio->id }}" hidden>
            <label for="">{{ $usuario_remedio->remedio->nome }}</label>
            <br>
            <label for="">Tomou</label>
            <input type="radio" name="status[{{ $usuario_remedio->id }}]" value="1" {{ $usuario_remedio->status == 1 ? 'checked' : '' }}>
            <br>
            <label for="">Não tomou</label>
            <input type="radio" name="status[{{ $usuario_remedio->id }}]" value="0" {{ $usuario_remedio->status == 0 ? 'checked' : '' }}>
            <br>
            <button class="btn btn-primary" type="submit" name="button">Salvar</button>
        </div>
    </form>

@endsection
