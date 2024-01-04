@extends('layoult')

@section('custom_head')
    {!! $lava->jsapi() !!}
@endsection

@section('content')

    @foreach ($graficos_pizza as $grafico)
        <div id="{{ $grafico }}" style="width: 100%; height: 400px;"></div>
        {!! $lava->render('PieChart', $grafico, $grafico) !!}
    @endforeach

@endsection
