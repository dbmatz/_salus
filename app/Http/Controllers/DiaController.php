<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parametro;
use App\Models\Emocao;
use App\Models\Remedio;
use App\Models\User;
use App\Models\UsuarioParametro;
use Auth;
use Exception;
use Error;

class DiaController extends Controller
{
    public function create()
    {
        $emocoes = Emocao::all();
        $parametros = Parametro::all()->where('usuario_id', Auth::user()->id);
        $remedios = Remedio::all()->where('usuario_id', Auth::user()->id);
        return view('create-dia', [
            'emocoes' => $emocoes, 
            'parametros' => $parametros,
            'remedios' => $remedios,
        ]);
    }

    public function store(Request $request)
    {
        $resposta = (new UsuarioRemedioController)->store($request);
        if ($resposta == 1) {
            return redirect()->route('index')->withErrors('usuario_remedio naõ salvo');
        }

        $resposta = (new UsuarioParametoController)->store($request);
        if ($resposta == 1) {
            return redirect()->route('index')->withErrors('usuario_parametro naõ salvo');
        }

        $resposta = (new UsuarioEmocaoController)->store($request);
        if ($resposta == 1) {
            return redirect()->route('index')->withErrors('usuario_emocao naõ salvo');
        }

        return redirect()->route('index')->with('status', 'dia salvo');
    }

    public function edit($id)
    {

    }
}