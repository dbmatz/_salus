@extends('layoult')

@section('content')

<div id="stocks-div" style="width: 100%; height: 400px;"></div>

    <!-- Outras marcações HTML ou conteúdo da página aqui -->

    <!-- Inclua o script para renderizar o gráfico -->
    {!! $lava->render('LineChart', 'Stocks', 'stocks-div') !!}

@endsection