@extends('layoult')

@section('content')
    <div id="cabecalho">
        <h1>{{ date('d/m/Y', strtotime($dia)) }}</h1>
        <br>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square"
                viewBox="0 0 16 16">
                <path
                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                <path fill-rule="evenodd"
                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
            </svg>
        </button>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alterar dia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="get" enctype="multipart/form-data" action="{{ route('dia-create') }}">
                            @csrf
                            <input type="date" name="dia">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="create-novo">
        <form method="post" enctype="multipart/form-data" action="{{ route('dia-store') }}">
            @csrf
            <input type="date" name="dia" value="{{$dia}}" hidden>
            <div class="mb-3">
                <p>Como você está se sentindo hoje?</p>
                <div id="emocoes-main">
                    @foreach ($emocoes as $emocao)
                        <div class="emocao">
                            <img src="/emocoes/{{ $emocao->imagem }}" alt="">
                            <input type="radio" name="emocao_id" value="{{ $emocao->id }}" required>
                            <label for="emocao_id">{{ $emocao->nome }}</label>
                        </div>
                    @endforeach
                </div>

                <hr>

                <div id="parametro-index">
                    @forelse ($parametros as $parametro)
                        <div class="parametro">
                            <input type="number" name="parametro_id" value="{{ $parametro->id }}" hidden>
                            <label for="avaliacao">{{ $parametro->nome }}</label>
                            <br>
                            <input type="radio" name="avaliacao[{{ $parametro->id }}]" value="0" hidden checked>
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
                            <br>
                        </div>
                    @empty
                    @endforelse
                </div>

                <hr>

                <div id="remedio-index">
                    @forelse ($remedios as $remedio)
                        <div class="remedio-ind">
                            <input type="number" name="parametro_id" value="{{ $remedio->id }}" hidden>
                            <label for="">{{ $remedio->nome }}</label>
                            <br>
                            <div class="parametros-sn-index">
                                <div class="parametro-sn">
                                    <label for="">Tomou</label>
                                    <input type="radio" name="status[{{ $remedio->id }}]" value="1">
                                </div>
                                <div class="parametro-sn">
                                    <label for="">Não tomou</label>
                                    <input type="radio" name="status[{{ $remedio->id }}]" value="0" checked>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>

            <hr>

            <label for="">Descreva um pouco do seu dia</label>
            <br>
            <textarea name="descricao" rows="5" cols="160" id="input-descricao"></textarea>

            <br>
            <a class="btn btn-info" href="{{ route('index') }}">Voltar</a>
            <button class="btn btn-primary" type="submit" name="button">Salvar</button>
    </div>
    </form>
    </div>

@endsection
