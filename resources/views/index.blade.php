@extends('layoult')

@section('content')

    <div id="index-main">

        <br>

        <div id="cards-index">
            <div id="cards-border">
                <h1>{{ $mesNome }}</h1>
                <div id="cards-setas">
                <a href="{{ route('mudaMes', ['tipo' => 1, 'mes' => $mesNumero])}}" class="btn btn-outline-dark"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                        height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                    </svg></a>
                <a href="{{ route('mudaMes', ['tipo' => 2, 'mes' => $mesNumero])}}" class="btn btn-outline-dark"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                        height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                    </svg></a>
                </div>
            </div>
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
                    <div class="card card-emocao">
                        <a href="{{ route('dia-edit', ['id' => $usuario_emocao->id]) }}" class="card-content">
                            <img class="card-img-top" src="/emocoes{{ $usuario_emocao->emocao->imagem }}"
                                alt="{{$usuario_emocao->emocao->nome}}">
                            <div class="card-body">
                                <h5 class="card-title">{{ date('d/m', strtotime($usuario_emocao->dia)) }}</h5>
                                <p class="card-text card-descricao">{{ $usuario_emocao->descricao }}</p>
                            </div>
                        </a>
                    </div>
                @empty
                @endforelse
            </div>
        </div>

    @endsection
