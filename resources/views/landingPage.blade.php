@extends('layoult')

@section('tittle', 'landing')

@section('content')

<br>

<div id="salus-init">
    salus-init
    <img src="<?php echo asset('css/flor-maracuja.png'); ?>" id="flor-maracuja">
</div>

<br>

<div id="salus-sobre">
    salus-sobre
</div>

<br>

<div id="salus-perguntas">
    salus-perguntas

    <div id="cards-sobre">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Como a SALUS funciona?</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>

          <br>

          <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Qual o custo?</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>

          <br>

          <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Como os dados são armazenados</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>
    </div>
</div>


@endsection
