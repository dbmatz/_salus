<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parametro;
use App\Models\Emocao;
use App\Models\Remedio;
use App\Models\UsuarioParametro;
use App\Models\UsuarioEmocao;
use App\Models\UsuarioRemedio;
use Auth;
use Exception;
use Error;

class DiaController extends Controller
{
    public function create(Request $request)
    {
        $dia = date('y-m-d');

        $usuario_emocao = UsuarioEmocao::where('dia', $dia)->where('usuario_id', Auth::user()->id)->first();

        if (!empty($usuario_emocao)) {
            return redirect()->route('dia-edit', ['id' => $usuario_emocao->id]);
        }

        $emocoes = Emocao::all();

        $parametros = Parametro::all()->where('usuario_id', Auth::user()->id);

        $remedios = Remedio::all()->where('usuario_id', Auth::user()->id);

        return view('create-dia', [
            'emocoes' => $emocoes,
            'parametros' => $parametros,
            'remedios' => $remedios,
            'dia' => $dia,
        ]);
    }

    public function store(Request $request)
    {
        if (!empty($request->avaliacao)) {
            $resposta = (new UsuarioParametoController())->store($request);
            if ($resposta == 1) {
                return redirect()
                    ->route('index')
                    ->withErrors('usuario_parametro naõ salvo');
            }
        }

        if (!empty($request->status)) {
            $resposta = (new UsuarioRemedioController())->store($request);
            if ($resposta == 1) {
                return redirect()
                    ->route('index')
                    ->withErrors('usuario_remedio naõ salvo');
            }
        }

        $resposta = (new UsuarioEmocaoController())->store($request);
        if ($resposta == 1) {
            return redirect()
                ->route('index')
                ->withErrors('usuario_emocao naõ salvo');
        }

        return redirect()
            ->route('index')
            ->with('status', 'dia salvo');
    }

    public function edit($id)
    {
        $usuario_emocao = UsuarioEmocao::where('id', $id)->first();
        $dia = $usuario_emocao->dia;
        $emocoes = Emocao::all();

        $usuario_parametro = UsuarioParametro::all()
            ->where('dia', $dia)
            ->where('usuario_id', Auth::user()->id);
        $parametros = Parametro::all()->where('usuario_id', Auth::user()->id);

        $usuario_remedio = UsuarioRemedio::all()
            ->where('dia', $dia)
            ->where('usuario_id', Auth::user()->id);
        $remedios = Remedio::all()->where('usuario_id', Auth::user()->id);

        return view('edit-dia', [
            'emocoes' => $emocoes,
            'parametros' => $parametros,
            'remedios' => $remedios,
            'usuario_emocao' => $usuario_emocao,
            'usuario_parametros' => $usuario_parametro,
            'usuario_remedios' => $usuario_remedio,
            'dia' => $dia,
        ]);
    }

    public function update(Request $request)
    {
        if (!empty($request->emocao_id)) {
            $resposta = (new UsuarioEmocaoController())->update($request);
            if ($resposta == 1) {
                return redirect()
                    ->route('index')
                    ->withErrors('usuario_parametro naõ salvo');
            }
        }

        if (!empty($request->status)) {
            $resposta = (new UsuarioRemedioController())->update($request);
            if ($resposta == 1) {
                return redirect()
                    ->route('index')
                    ->withErrors('usuario_remedio naõ salvo');
            }
        }

        if (!empty($request->avaliacao)) {
            $resposta = (new UsuarioParametoController())->update($request);
            if ($resposta == 1) {
                return redirect()
                    ->route('index')
                    ->withErrors('usuario_parametro naõ salvo');
            }
        }

        dd($resposta);

        return redirect()
            ->route('index')
            ->with('status', 'dia salvo');
    }
}
