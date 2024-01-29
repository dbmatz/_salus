@extends('layoult')

@section('custom_head')
    {!! $lava->jsapi() !!}
@endsection

@section('content')
    <div id="cabecalho">
        <h1>{{ date('d/m', strtotime($data_inicial)) }} - {{ date('d/m', strtotime($data_final)) }}</h1>
    </div>
    <div class="corpo">

        <div id="grafico-dias">
            @forelse ($dias_preenchidos as $dias)
                <div id="{{ $dias }}"></div>
                {!! $lava->render('CalendarChart', $dias, $dias) !!}
            @empty
                <p class="empty-graficos">Não possui registros nesse periodo.</p>
            @endforelse
        </div>

        <hr>
        <br>

        <div id="graficos-emocao">
            @forelse ($emocoes_map as $emocao)
                <div class="emocoes-relatorio">
                    <img src="/emocoes{{ $emocao['image'] }}" alt="{{ $emocao['nome'] }}" class="rel-img">
                    <h5>{{ $emocao['nome'] }}</h5>
                    <p class="qtd-emo">{{ $emocao['qtd'] }}</p>
                </div>
            @empty
                <p class="empty-graficos">Não possui registros nesse periodo.</p>
            @endforelse
        </div>

        <hr>
        <br>

        <div id="relatorio-parametros">
            <h2>Parâmetros</h2>
            <div id="graficos-parametro">
                @forelse ($graficos_parametro as $grafico)
                    <div id="{{ $grafico }}"></div>
                    {!! $lava->render('LineChart', $grafico, $grafico) !!}
                @empty
                    <p class="empty-graficos">Não possui registro de parâmetros cadastrados. <a class="dropdown-item"
                            data-toggle="modal" data-target="#parametroModal">Novo
                            parâmetro</a></p>
                @endforelse
            </div>
        </div>

        <hr>
        <br>

        <div id="relatorio-remedio">
            <h2>Remédios</h2>
            <div id="graficos-remedio">
                @forelse ($graficos_pizza as $grafico)
                    <div id="{{ $grafico }}"></div>
                    {!! $lava->render('PieChart', $grafico, $grafico) !!}
                @empty
                    <p class="empty-graficos">Não possui registro de remédios cadastrados. <a class="dropdown-item"
                            data-toggle="modal" data-target="#remedioModal">Novo remédio</a></p>
                @endforelse
            </div>
        </div>
        <a class="btn btn-info" href="{{ route('index') }}">Voltar</a>
    </div>
@endsection
