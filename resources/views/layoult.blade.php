<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>@yield('tittle')</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            @guest
            <li class="nav-item active">
              <a class="nav-link" href="{{route('index')}}">Inicio<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contato</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Quem somos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Cadastro</a>
              </li>
              @endguest
              @auth
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{Auth::user()->name}}
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{route('profile.edit')}}">Conta</a>
                <a class="dropdown-item" href="#">Relatório</a>
                <a class="dropdown-item" href="#">Novo parâmetro</a>
                <a class="dropdown-item" href="#">Novo remédio</a>
              </div>
            </li>
            @endauth
          </ul>
        </div>
      </nav>
</body>
</html>