@extends('layoult')

@section('tittle', 'index')

@section('content')

    <div id="index-main">

        <div id="index-resumo">
            <div>
                {{ Auth::user()->name }}
            </div>
            <div>
                <a class="btn btn-pencil">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-pencil" viewBox="0 0 16 16">
                        <path
                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                    </svg>
                </a>
            </div>
        </div>

        @auth
            <div id="botoes">
                <a class="btn btn-info" href="{{ route('emocao-create') }}">Criar emocao</a>
                <br>
                <h4>editar usuapar</h4>
                <form method="GET" action="{{ route('usupar-edit') }}">
                    @csrf
                    <input type="date" name="dia" required>
                    <button class="btn btn-primary" type="submit" name="button">editar</button>
                </form>
                <br>
                <h3>Dia</h3>
                <form method="POST" action="{{ route('dia-create') }}">
                    @csrf
                    <input type="date" name="dia" required>
                    <button class="btn btn-primary" type="submit" name="button">Criar</button>
                </form>
            </div>
        @endauth

        <br>
        <br>

        <br>
        <br>

        <div id="cards">
            <div class="card">
                <a href="{{ route('dia-create') }}">
                    <div class="card-body ">
                        <div id="card-add">
                            <svg xmlns="http://www.w3.org/2000/svg" width="130" height="130" fill="currentColor"
                                class="bi bi-plus" viewBox="0 0 16 16">
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
            @forelse ($usuario_emocaos as $usuario_emocao)
                <div class="card">
                    <a href="{{ route('dia-edit', ['id' => $usuario_emocao->id]) }}">
                        <img class="card-img-top" src="/emocoes{{ $usuario_emocao->emocao->imagem }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ date('d/m', strtotime($usuario_emocao->dia)) }}</h5>
                            <p class="card-text">{{ $usuario_emocao->descricao }}</p>
                        </div>
                    </a>
                </div>
            @empty
                <p>vazio</p>
            @endforelse
        </div>

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

        <h3>usuario_remedio</h3>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Dia</th>
                    <th scope="col">usuario</th>
                    <th scope="col">remedio</th>
                    <th scope="col">status</th>
                    <th scope="col">editar</th>
                    <th scope="col">excluir</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuario_remedios as $usuario_remedio)
                    <tr>
                        <th scope="row">{{ $usuario_remedio->id }}</th>
                        <th>{{ $usuario_remedio->dia }}</th>
                        <td>{{ $usuario_remedio->usuario->name }}</td>
                        <td>{{ $usuario_remedio->remedio->nome }}</td>
                        <td>{{ $usuario_remedio->status }}</td>
                        <td><a href="{{ route('usurem-edit', ['id' => $usuario_remedio->id]) }}">editar</a></td>
                        <td>
                            <form action="{{ route('usurem-destroy', ['id' => $usuario_remedio->id]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit">excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection
