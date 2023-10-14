@extends('layoult')

@section('tittle', 'SALUS')

@section('content')

    <div class="create-novo">

        <h1>Novo parâmetro</h1>

        <form method="post" enctype="multipart/form-data" action="{{ route('parametro-store') }}">
            @csrf
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
                <br>
                <a class="btn btn-info" href="{{ route('index') }}">Voltar</a>
                <button class="btn btn-primary" type="submit" name="button">Salvar</button>
            </div>
        </form>

    </div>

@endsection
