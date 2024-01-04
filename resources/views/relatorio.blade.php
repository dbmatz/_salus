@extends('layoult')

@section('custom_head')
    {!! $lava->jsapi() !!}
@endsection

@section('content')
    

    <!-- Outras marcações HTML ou conteúdo da página aqui -->

    <!-- Inclua o script para renderizar o gráfico -->
    @foreach($nome_graficos as $grafico)
    <div id="{{$grafico}}" style="width: 100%; height: 400px;"></div>
    {!! $lava->render('PieChart', $grafico, $grafico) !!}
    @endforeach

@endsection