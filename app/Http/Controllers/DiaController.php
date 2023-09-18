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
        $dia = $request->dia;

        /*$usuario_emocao_q = UsuarioEmocao::all()
            ->where('dia', $dia)
            ->where('usuario_id', Auth::user()->id);*/
        $emocoes = Emocao::all();

        /*$usuario_parametro = UsuarioParametro::all()
            ->where('dia', $dia)
            ->where('usuario_id', Auth::user()->id);*/
        $parametros = Parametro::all()->where('usuario_id', Auth::user()->id);

        /*$usuario_remedio = UsuarioRemedio::all()
            ->where('dia', $dia)
            ->where('usuario_id', Auth::user()->id);*/
        $remedios = Remedio::all()->where('usuario_id', Auth::user()->id);

        /*if (empty($usuario_emocao_q)) {
            $usuario_emocao = new UsuarioEmocao();
            $usuario_emocao->id = $usuario_emocao_q[0]->id;
            $usuario_emocao->emocao_id = $usuario_emocao_q[0]->emocao_id;
            $usuario_emocao->usuario_id = $usuario_emocao_q[0]->usuario_id;
            $usuario_emocao->descricao = $usuario_emocao_q[0]->descricao;
            $usuario_emocao->dia = $usuario_emocao_q[0]->dia;
        } else {
            $usuario_emocao = 0;
        }*/

        //dd($usuario_emocao->emocao->id);

        return view('create-dia', [
            'emocoes' => $emocoes,
            'parametros' => $parametros,
            'remedios' => $remedios,
            /*'usuario_emocao' => $usuario_emocao,
            'usuario_parametro' => $usuario_parametro,
            'usuario_remedio' => $usuario_remedio,*/
            'dia' => $dia,
        ]);
    }

    public function store(Request $request)
    {
        if (!empty($request->status)) {
            $resposta = (new UsuarioRemedioController())->store($request);
            if ($resposta == 1) {
                return redirect()
                    ->route('index')
                    ->withErrors('usuario_remedio naõ salvo');
            }
        }

        if (!empty($request->avaliacao)) {
            $resposta = (new UsuarioParametoController())->store($request);
            if ($resposta == 1) {
                return redirect()
                    ->route('index')
                    ->withErrors('usuario_parametro naõ salvo');
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

        $usuario_remedio = UsuarioParametro::all()->where('usuario_id', Auth::user()->id);
        $remedios = Remedio::all()->where('usuario_id', Auth::user()->id);

        return view('edit-dia', [
            'emocoes' => $emocoes,
            'parametros' => $parametros,
            'remedios' => $remedios,
            'usuario_emocao' => $usuario_emocao,
            'usuario_parametro' => $usuario_parametro,
            'usuario_remedio' => $usuario_remedio,
            'dia' => $dia,
        ]);
    }

    public function update(Request $request, $id)
    {
        $resposta = (new UsuarioEmocaoController())->update($request, $id);
        if ($resposta == 1) {
            return redirect()
                ->route('index')
                ->withErrors('usuario_emocao naõ salvo');
        }

        $usuario_emocao = UsuarioEmocao::where('id', $id);
        $dia = $usuario_emocao->dia;
        
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

        return redirect()
            ->route('index')
            ->with('status', 'dia salvo');
    }
}
