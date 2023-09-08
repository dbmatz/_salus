@extends('layoult')

@section('tittle', 'index')

@section('content')

    @auth
        <a href="{{ route('emocao-create') }}">criar emocao</a>

        <a href="{{ route('parametro-create') }}">criar parametro</a>

        <a href="{{ route('remedio-create') }}">criar remedio</a>

        <a href="{{ route('dia-create') }}">entrada dia</a>
    @endauth

    <br>
    <br>

    <h3>Parametros</h3>
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
                    <th scope="row">{{ $parametro->id }}</th>
                    <td>{{ $parametro->nome }}</td>
                    <td>{{ $parametro->usuario_id }}</td>
                    <td><a href="{{ route('parametro-edit', ['id' => $parametro->id]) }}">editar</a></td>
                    <td>
                        <form action="{{ route('parametro-destroy', ['id' => $parametro->id]) }}" method="POST">
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

    <h3>Remedios</h3>
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
            @foreach ($remedios as $remedio)
                <tr>
                    <th scope="row">{{ $remedio->id }}</th>
                    <td>{{ $remedio->nome }}</td>
                    <td>{{ $remedio->usuario_id }}</td>
                    <td><a href="{{ route('remedio-edit', ['id' => $remedio->id]) }}">editar</a></td>
                    <td>
                        <form action="{{ route('remedio-destroy', ['id' => $remedio->id]) }}" method="POST">
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

    <h3>Emocoes</h3>
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
                    <th scope="row">{{ $emocao->id }}</th>
                    <td><img src="/emocoes/{{ $emocao->imagem }}" alt=""></td>
                    <td>{{ $emocao->nome }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <br>

    <h3>dia</h3>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">id</th>
                <th scope="col">Dia</th>
                <th scope="col">usuario</th>
                <th scope="col">emocao</th>
                <th scope="col">descricao</th>
                @foreach ($usuario_parametros as $usuario_parametro)
                    <th scope="col">parametro</th>
                    <th scope="col">avaliacao</th>
                @endforeach
                <th scope="col">editar</th>
                <th scope="col">excluir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuario_emocaos as $usuario_emocao)
                <tr>
                    <th scope="row">{{ $usuario_emocao->id }}</th>
                    <th>{{ $usuario_emocao->dia }}</th>
                    <td>{{ $usuario_emocao->usuario->name }}</td>
                    <td>{{ $usuario_emocao->emocao->nome }}</td>
                    <td>{{ $usuario_emocao->descricao }}</td>
            @endforeach
            @foreach ($usuario_parametros as $usuario_parametro)
                <td>{{ $usuario_parametro->parametro->nome }}</td>
                <td>{{ $usuario_parametro->avaliacao }}</td>
                <td><a href="{{ route('dia-edit', ['id' => Auth::user()->id]) }}">editar</a></td>
                <td>
                    <form action="{{ route('dia-destroy', ['id' => Auth::user()->id]) }}" method="POST">
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

    <h3>usuario_parametro</h3>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">id</th>
                <th scope="col">Dia</th>
                <th scope="col">usuario</th>
                <th scope="col">parametro</th>
                <th scope="col">avaliacao</th>
                <th scope="col">editar</th>
                <th scope="col">excluir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuario_parametros as $usuario_parametro)
                <tr>
                    <th scope="row">{{ $usuario_parametro->id }}</th>
                    <th>{{ $usuario_parametro->dia }}</th>
                    <td>{{ $usuario_parametro->usuario->name }}</td>
                    <td>{{ $usuario_parametro->parametro->nome }}</td>
                    <td>{{ $usuario_parametro->avaliacao }}</td>
                    <td><a href="{{ route('usupar-edit', ['id' => $usuario_parametro->id]) }}">editar</a></td>
                    <td>
                        <form action="{{ route('usupar-destroy', ['id' => $usuario_parametro->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit">excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


@endsection
