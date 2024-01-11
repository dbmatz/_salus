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
            @foreach ($dias_preenchidos as $dias)
                <div id="{{ $dias }}"></div>
                {!! $lava->render('CalendarChart', $dias, $dias) !!}
            @endforeach
        </div>

        <hr>
        <br>

        <div id="graficos-emocao">
            @foreach ($emocoes_map as $emocao)
                <div class="emocoes-relatorio">
                    <img src="/emocoes{{ $emocao['image'] }}" alt="{{ $emocao['nome'] }}" class="rel-img">
                    <h5>{{ $emocao['nome'] }}</h5>
                    <p class="qtd-emo">{{ $emocao['qtd'] }}</p>
                </div>
            @endforeach
        </div>

        <hr>
        <br>

        <div id="grafico-parametros">
            <h2>Parâmetros</h2>
            @forelse ($graficos_parametro as $grafico)
                <div id="{{ $grafico }}"></div>
                {!! $lava->render('LineChart', $grafico, $grafico) !!}
            @empty
                <p>Não possui parametros cadastrados.</p>
                <a class="dropdown-item" data-toggle="modal" data-target="#parametroModal">Novo
                    parâmetro</a>
            @endforelse
        </div>

        <hr>
        <br>

        <div id="rel-emo">
            <h2>Remédios</h2>
            <div id="graficos-remedio">
                @forelse ($graficos_pizza as $grafico)
                    <div id="{{ $grafico }}"></div>
                    {!! $lava->render('PieChart', $grafico, $grafico) !!}
                @empty
                    <p>Não possui remédios cadastrados</p>
                    <a class="dropdown-item" data-toggle="modal" data-target="#remedioModal">Novo remédio</a>
                @endforelse
            </div>
        </div>
    </div>
@endsection
