@extends('layoult')

@section('custom_head')
    {!! $lava->jsapi() !!}
@endsection

@section('content')
    <div id="cabecalho">
        <h1>{{ date('d/m', strtotime($data_inicial)) }} - {{ date('d/m', strtotime($data_final)) }}</h1>
    </div>
    <div class="create-novo">

        <div id="grafico-dias">
            @foreach ($dias_preenchidos as $dias)
                <div id="{{ $dias }}"></div>
                {!! $lava->render('CalendarChart', $dias, $dias) !!}
            @endforeach
        </div>

        <div id="graficos-emocao">
            @foreach ($emocoes_map as $emocao)
                <div>
                    <img src="/emocoes{{ $emocao['image'] }}" alt="">
                    <h5>{{ $emocao['nome'] }}</h5>
                    <p>{{ $emocao['qtd'] }}</p>
                </div>
            @endforeach
        </div>

        <div id="grafico-parametros">
            @foreach ($graficos_parametro as $grafico)
                <div id="{{ $grafico }}"></div>
                {!! $lava->render('LineChart', $grafico, $grafico) !!}
            @endforeach
        </div>

        <div id="graficos-remedio">
            @foreach ($graficos_pizza as $grafico)
                <div id="{{ $grafico }}"></div>
                {!! $lava->render('PieChart', $grafico, $grafico) !!}
            @endforeach
        </div>
    </div>
@endsection
