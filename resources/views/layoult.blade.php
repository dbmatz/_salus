<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css"
        integrity="sha512-T584yQ/tdRR5QwOpfvDfVQUidzfgc2339Lc8uBDtcp/wYu80d7jwBgAxbyMh0a9YM9F8N3tdErpFI8iaGx6x5g=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.min.js"
        integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="<?php echo asset('css/style.css'); ?>" type="text/css">
    <title>@yield('tittle')</title>
</head>

<style>
    img {
        width: 50px;
        height: 50px;
    }
</style>

<script src="../b"></script>

<body>
    <div id="navbarMain">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('landingPage') }}">SALUS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contato</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Quem somos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Cadastro</a>
                        </li>
                        <li class="nav-item nav-login">
                            <a class="nav-link href-login" href="{{ route('login') }}">Login</a>
                        </li>
                    @endguest
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index') }}">SALUS</a>
                    </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Olá,
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">Conta</a>
                                <a class="dropdown-item" href="#">Relatório</a>
                                <a class="dropdown-item" href="{{ route('parametro-create') }}">Novo parâmetro</a>
                                <a class="dropdown-item" href="{{ route('remedio-create') }}">Novo remédio</a>
                                <a class="dropdown-item">
                                    <form action="/logout" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item" aria-current="page">Sair</button>
                                    </form>
                                </a>
                            </div>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>
    </div>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <main class="main-container">
        <div>
            @yield('content')
        </div>
    </main>

    <br>

    <footer>
        footer
    </footer>
</body>

</html>
