<?php

use App\Http\Controllers\EmocaoController;
use App\Http\Controllers\ParametroController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RemedioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Models\Parametro;
use App\Models\Emocao;

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
    return view('landingPage');
})->name('landingPage');

Route::get('/dashboard', function () {
    $parametros = Parametro::all();

    $emocoes = Emocao::all();

    return view('index', ['parametros' => $parametros, 'emocoes' => $emocoes]);
})->middleware(['auth', 'verified'])->name('index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('emocao')->group(function () {
    Route::get('/', [EmocaoController::class, 'create'])->name('emocao-create');
    Route::post('/', [EmocaoController::class, 'store'])->name('emocao-store');
});

Route::prefix('parametro')->group(function() {
    Route::get('/', [ParametroController::class, 'create'])->name('parametro-create');
    Route::post('/', [ParametroController::class, 'store'])->name('parametro-store');
    Route::get('/{id}/edit', [ParametroController::class, 'edit'])->where('id', '[0-9]+')->name('parametro-edit');
    Route::put('/{id}', [ParametroController::class, 'update'])->where('id', '[0-9]+')->name('parametro-update');
    Route::delete('/{id}', [ParametroController::class, 'destroy'])->where('id', '[0-9]+')->name('parametro-destroy');
});

Route::prefix('remedio')->group(function() {
    Route::get('/', [RemedioController::class, 'create'])->name('remedio-create');
    Route::post('/', [RemedioController::class, 'store'])->name('remedio-store');
    Route::get('/{id}/edit', [RemedioController::class, 'edit'])->where('id', '[0-9]+')->name('remedio-edit');
    Route::put('/{id}', [RemedioController::class, 'update'])->where('id', '[0-9]+')->name('remedio-update');
    Route::delete('/{id}', [RemedioController::class, 'destroy'])->where('id', '[0-9]+')->name('remedio-destroy');
});

//Route::get('/dashboard', [UsuarioController::class, 'index'])->name('dashboard');

require __DIR__.'/auth.php';
