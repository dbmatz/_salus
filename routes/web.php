<?php

use App\Http\Controllers\EmocaoController;
use App\Http\Controllers\ParametroController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RemedioController;
use App\Http\Controllers\UsuarioParametoController;
use App\Http\Controllers\UsuarioRemedioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioEmocaoController;
use App\Http\Controllers\DiaController;
use Carbon\Carbon;
use App\Models\Parametro;
use App\Models\Emocao;
use App\Models\Remedio;
use App\Models\UsuarioEmocao;
use App\Models\UsuarioParametro;
use App\Models\UsuarioRemedio;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landingPage', [
        'remedios' => [],
        'parametros' => [],
    ]);
})->name('landingPage');

Route::get('/dashboard', function () {
    $meses = [
        '1' => 'Janeiro',
        '2' => 'Fevereiro',
        '3' => 'Março',
        '4' => 'Abril',
        '5' => 'Maio',
        '6' => 'Junho',
        '7' => 'Julho',
        '8' => 'Agosto',
        '9' => 'Setembro',
        '10' => 'Outubro',
        '11' => 'Novembro',
        '12' => 'Dezembro',
    ];

    $mesNumero = Carbon::now()->month;
    $ano = Carbon::now()->year;

    $emocoes = Emocao::all();
    $parametros = Parametro::all()->where('usuario_id', Auth::user()->id);
    $remedios = Remedio::all()->where('usuario_id', Auth::user()->id);

    $usuario_emocaos = UsuarioEmocao::where('usuario_id', Auth::user()->id)
        ->where('dia', '<=', Carbon::createFromFormat('Y-m-d H:i:s', $ano.'-'.$mesNumero.'-31 00:00:00'))
        ->where('dia', '>=', Carbon::createFromFormat('Y-m-d H:i:s', $ano.'-'.$mesNumero.'-01 00:00:00'))
        ->orderBy('dia', 'asc')
        ->get();

    $usuario_parametros = UsuarioParametro::where('usuario_id', Auth::user()->id)
        ->where('dia', '<=', Carbon::createFromFormat('Y-m-d H:i:s', $ano.'-'.$mesNumero.'-31 00:00:00'))
        ->where('dia', '>=', Carbon::createFromFormat('Y-m-d H:i:s', $ano.'-'.$mesNumero.'-01 00:00:00'))
        ->get();

    $usuario_remedios = UsuarioRemedio::where('usuario_id', Auth::user()->id)
        ->where('dia', '<=', Carbon::createFromFormat('Y-m-d H:i:s', $ano.'-'.$mesNumero.'-31 00:00:00'))
        ->where('dia', '>=', Carbon::createFromFormat('Y-m-d H:i:s', $ano.'-'.$mesNumero.'-01 00:00:00'))
        ->get();

    $mes = Carbon::now();

    return view('index', [
        'mesNome' => $meses[$mesNumero],
        'mesNumero' => $mesNumero,
        'ano' => $ano,
        'parametros' => $parametros,
        'emocoes' => $emocoes,
        'remedios' => $remedios,
        'usuario_emocaos' => $usuario_emocaos,
        'usuario_parametros' => $usuario_parametros,
        'usuario_remedios' => $usuario_remedios,
    ]);
})
    ->middleware(['auth', 'verified'])
    ->name('index');

Route::get('/editar', function () {
    return view('profile.edit', ['user' => Auth::user()]);
});

Route::get('/{tipo}/{mes}/{ano}', function ($tipo, $mes, $ano) {
    $meses = [
        '1' => 'Janeiro',
        '2' => 'Fevereiro',
        '3' => 'Março',
        '4' => 'Abril',
        '5' => 'Maio',
        '6' => 'Junho',
        '7' => 'Julho',
        '8' => 'Agosto',
        '9' => 'Setembro',
        '10' => 'Outubro',
        '11' => 'Novembro',
        '12' => 'Dezembro',
    ];

    if ($tipo == 1) {
        $mesNumero = $mes - 1;
    } else {
        $mesNumero = $mes + 1;
    }

    if ($mesNumero == 13 and $tipo == 2) {
        $ano++;
        $mesNumero = 1;
    }
    if ($mesNumero == 0 and $tipo == 1) {
        $ano--;
        $mesNumero = 12;
    }

    $emocoes = Emocao::all();

    $parametros = Parametro::all()->where('usuario_id', Auth::user()->id);

    $remedios = Remedio::all()->where('usuario_id', Auth::user()->id);

    $usuario_emocaos = UsuarioEmocao::where('usuario_id', Auth::user()->id)
        ->where('dia', '<=', Carbon::createFromFormat('Y-m-d H:i:s', $ano.'-'.$mesNumero.'-31 00:00:00'))
        ->where('dia', '>=', Carbon::createFromFormat('Y-m-d H:i:s', $ano.'-'.$mesNumero.'-01 00:00:00'))
        ->orderBy('dia', 'asc')
        ->get();

    $usuario_parametros = UsuarioParametro::where('usuario_id', Auth::user()->id)
        ->where('dia', '<=', Carbon::createFromFormat('Y-m-d H:i:s', $ano.'-'.$mesNumero.'-31 00:00:00'))
        ->where('dia', '>=', Carbon::createFromFormat('Y-m-d H:i:s', $ano.'-'.$mesNumero.'-01 00:00:00'))
        ->get();

    $usuario_remedios = UsuarioRemedio::where('usuario_id', Auth::user()->id)
        ->where('dia', '<=', Carbon::createFromFormat('Y-m-d H:i:s', $ano.'-'.$mesNumero.'-31 00:00:00'))
        ->where('dia', '>=', Carbon::createFromFormat('Y-m-d H:i:s', $ano.'-'.$mesNumero.'-01 00:00:00'))
        ->get();

    return view('index', [
        'mesNome' => $meses[$mesNumero],
        'mesNumero' => $mesNumero,
        'ano' => $ano,
        'parametros' => $parametros,
        'emocoes' => $emocoes,
        'remedios' => $remedios,
        'usuario_emocaos' => $usuario_emocaos,
        'usuario_parametros' => $usuario_parametros,
        'usuario_remedios' => $usuario_remedios,
    ]);
})
    ->where('tipo', '[1-2]')
    ->where('id', '[0-9]+')
    ->name('mudaMes');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*Route::prefix('emocao')->group(function () {
    Route::get('/', [EmocaoController::class, 'create'])->name('emocao-create');
    Route::post('/', [EmocaoController::class, 'store'])->name('emocao-store');
});*/

Route::prefix('dia')->group(function () {
    Route::get('/', [DiaController::class, 'create'])->name('dia-create');
    Route::post('/', [DiaController::class, 'store'])->name('dia-store');
    Route::get('/{id}', [DiaController::class, 'edit'])
        ->name('dia-edit')
        ->where('id', '[0-9]+');
    Route::put('/', [DiaController::class, 'update'])->name('dia-update');
    Route::post('/relatorio', [DiaController::class, 'relatorio'])->name('dia-relatorio');
    Route::get('/gerar-pdf/{lava}', [DiaController::class, 'gerarPDF'])->name('gerar-pdf');
});

Route::prefix('parametro')->group(function () {
    Route::post('/', [ParametroController::class, 'store'])->name('parametro-store');
    Route::delete('/{id}', [ParametroController::class, 'delete'])
        ->where('id', '[0-9]+')
        ->name('parametro-delete');
});

Route::prefix('remedio')->group(function () {
    Route::post('/', [RemedioController::class, 'store'])->name('remedio-store');
    Route::delete('/{id}', [RemedioController::class, 'delete'])
        ->where('id', '[0-9]+')
        ->name('remedio-delete');
});

require __DIR__ . '/auth.php';
