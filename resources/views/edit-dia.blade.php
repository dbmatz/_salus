@extends('layoult')

@section('tittle', 'create-dia')

@section('content')

    <div id="cabecalho">
        <h1>{{ date('d/m/Y', strtotime($dia)) }}</h1>
        <br>
    </div>

    <div class="create-novo">
        <form method="post" enctype="multipart/form-data" action="{{ route('dia-update') }}">
            @csrf
            @method('PUT')
            <input type="date" name="dia" value="{{ $dia }}" hidden>
            <div class="mb-3">
                <div id="emocoes-main">
                    @foreach ($emocoes as $emocao)
                        <div class="emocao">
                            <img src="/emocoes{{ $emocao->imagem }}" alt="">
                            <input type="radio" name="emocao_id" value="{{ $emocao->id }}"
                                {{ $usuario_emocao->emocao->id === $emocao->id ? 'checked' : '' }}>
                            <label for="emocao_id">{{ $emocao->nome }}</label>
                        </div>
                    @endforeach
                </div>

                <hr>

                <div id="parametro-index">
                    @forelse($usuario_parametros as $usuario_parametro)
                        <div class="parametro">
                            <input type="number" name="parametro_id" value="{{ $usuario_parametro->parametro->id }}"
                                hidden>
                            <label for="avaliacao">{{ $usuario_parametro->parametro->nome }}</label>
                            <br>
                            <input type="radio" name="avaliacao[{{ $usuario_parametro->parametro->id }}]" value="0"
                                hidden {{ $usuario_parametro->avaliacao === 0 ? 'checked' : '' }}>
                            <input type="radio" name="avaliacao[{{ $usuario_parametro->parametro->id }}]" value="1"
                                {{ $usuario_parametro->avaliacao === 1 ? 'checked' : '' }}>
                            <label for="avaliacao">1</label>
                            <input type="radio" name="avaliacao[{{ $usuario_parametro->parametro->id }}]" value="2"
                                {{ $usuario_parametro->avaliacao === 2 ? 'checked' : '' }}>
                            <label for="avaliacao">2</label>
                            <input type="radio" name="avaliacao[{{ $usuario_parametro->parametro->id }}]" value="3"
                                {{ $usuario_parametro->avaliacao === 3 ? 'checked' : '' }}>
                            <label for="avaliacao">3</label>
                            <input type="radio" name="avaliacao[{{ $usuario_parametro->parametro->id }}]" value="4"
                                {{ $usuario_parametro->avaliacao === 4 ? 'checked' : '' }}>
                            <label for="avaliacao">4</label>
                            <input type="radio" name="avaliacao[{{ $usuario_parametro->parametro->id }}]" value="5"
                                {{ $usuario_parametro->avaliacao === 5 ? 'checked' : '' }}>
                            <label for="avaliacao">5</label>
                            <input type="radio" name="avaliacao[{{ $usuario_parametro->parametro->id }}]" value="6"
                                {{ $usuario_parametro->avaliacao === 6 ? 'checked' : '' }}>
                            <label for="avaliacao">6</label>
                            <input type="radio" name="avaliacao[{{ $usuario_parametro->parametro->id }}]" value="7"
                                {{ $usuario_parametro->avaliacao === 7 ? 'checked' : '' }}>
                            <label for="avaliacao">7</label>
                            <input type="radio" name="avaliacao[{{ $usuario_parametro->parametro->id }}]" value="8"
                                {{ $usuario_parametro->avaliacao === 8 ? 'checked' : '' }}>
                            <label for="avaliacao">8</label>
                            <input type="radio" name="avaliacao[{{ $usuario_parametro->parametro->id }}]" value="9"
                                {{ $usuario_parametro->avaliacao === 9 ? 'checked' : '' }}>
                            <label for="avaliacao">9</label>
                            <input type="radio" name="avaliacao[{{ $usuario_parametro->parametro->id }}]" value="10"
                                {{ $usuario_parametro->avaliacao === 10 ? 'checked' : '' }}>
                            <label for="avaliacao">10</label>
                            <br>
                        </div>
                    @empty
                        @foreach ($parametros as $parametro)
                            <input type="number" name="parametro_id" value="{{ $parametro->id }}" hidden>
                            <label for="avaliacao">{{ $parametro->nome }}</label>
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
                        @endforeach
                    @endforelse
                </div>

                <hr>

                <div id="remedio-index">
                    @forelse($usuario_remedios as $usuario_remedio)
                        <div class="remedio-ind">
                            <input type="number" name="parametro_id" value="{{ $usuario_remedio->remedio->id }}"
                                hidden>
                            <label for="">{{ $usuario_remedio->remedio->nome }}</label>
                            <br>
                            <div class="parametros-sn-index">
                                <div class="parametro-sn">
                                    <label for="">Tomou</label>
                                    <input type="radio" name="status[{{ $usuario_remedio->remedio->id }}]"
                                        value="1" {{ $usuario_remedio->status === 1 ? 'checked' : '' }}>
                                </div>
                                <div class="parametro-sn">
                                    <label for="">Não tomou</label>
                                    <input type="radio" name="status[{{ $usuario_remedio->remedio->id }}]"
                                        value="0" {{ $usuario_remedio->status === 0 ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>
                        <br>
                    @empty
                        @forelse ($remedios as $remedio)
                            <input type="number" name="parametro_id" value="{{ $remedio->id }}" hidden>
                            <label for="">{{ $remedio->nome }}</label>
                            <label for="">Tomou</label>
                            <input type="radio" name="status[{{ $remedio->id }}]" value="1">
                            <label for="">Não tomou</label>
                            <input type="radio" name="status[{{ $remedio->id }}]" value="0" checked>
                            <br>
                        @empty
                            <br>
                        @endforelse
                    @endforelse
                </div>

                <hr>

                <label for="">Descreva um pouco do seu dia</label>
                <textarea name="descricao" rows="5" cols="175">{{ $usuario_emocao->descricao }}</textarea>

            </div>
            <a class="btn btn-info" href="{{ route('index') }}">Voltar</a>
            <button class="btn btn-primary" type="submit" name="button">Salvar</button>

    </div>
    </form>
    </div>

@endsection
