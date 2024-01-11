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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Old+Standard+TT&family=Playfair+Display&family=Ubuntu:wght@300&display=swap"
        rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    @yield('custom_head')
    <title>SALUS</title>
</head>

<style>
    img {
        width: 50px;
        height: 50px;
    }
</style>

<body>
    <div id="navbarMain">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" id="home" href="{{ route('landingPage') }}">SALUS</a>
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
                                <a class="dropdown-item" href="/editar">Conta</a>
                                <a class="dropdown-item" data-toggle="modal" data-target="#relatorioModal">Relatório</a>
                                <a class="dropdown-item" data-toggle="modal" data-target="#parametroModal">Novo
                                    parâmetro</a>
                                <a class="dropdown-item" data-toggle="modal" data-target="#remedioModal">Novo remédio</a>
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

    <div class="modal fade" id="parametroModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Novo parâmetro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" action="{{ route('parametro-store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                            <br>
                            <button class="btn btn-primary" type="submit" name="button">Salvar</button>
                        </div>
                    </form>

                    @forelse ($parametros as $parametro)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $parametro->nome }}</td>
                                    <th>
                                        <a type="button">
                                            <form action="{{ route('parametro-delete', $parametro->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger"
                                                    aria-current="page"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="16" height="16" fill="currentColor"
                                                        class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path
                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                        <path
                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                    </svg></button>
                                            </form>
                                        </a>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    @empty
                        <th>Nenhum parâmetro cadastrado.</th>
                    @endforelse

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="remedioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Novo remédio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" action="{{ route('remedio-store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                            <br>
                            <button class="btn btn-primary" type="submit" name="button">Salvar</button>
                        </div>
                    </form>
                    @forelse ($remedios as $remedio)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $remedio->nome }}</td>
                                    <th>
                                        <a type="button">
                                            <form action="{{ route('remedio-delete', $remedio->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger"
                                                    aria-current="page"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="16" height="16" fill="currentColor"
                                                        class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path
                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                        <path
                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                    </svg></button>
                                            </form>
                                        </a>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    @empty
                        <th>Nenhum remédio cadastrado.</th>
                    @endforelse
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="relatorioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Gerar relatório</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" action="{{ route('dia-relatorio') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="data_inicial" class="form-label">Período Inicial</label>
                            <input type="date" class="form-control" id="data_inicial" name="data_inicial"
                                required>
                            <label for="data_final" class="form-label">Período Final</label>
                            <input type="date" class="form-control" id="data_final" name="data_final" required
                                value=>
                            <br>
                            <button class="btn btn-primary" type="submit" name="button">Salvar</button>
                        </div>
                    </form>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach
    @endif

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <main class="main-container">
        <div>
            @yield('content')
        </div>
    </main>
</body>

</html>
