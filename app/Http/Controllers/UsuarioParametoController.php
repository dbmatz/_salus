<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parametro;
use App\Models\User;
use App\Models\UsuarioParametro;
use Auth;
use Exception;

class UsuarioParametoController extends Controller
{
    public function store(Request $request)
    {
        $data = [];
        $array = $request->avaliacao;
        $array_keys = array_keys($array);

        for ($i = 0; $i < count($array); ++$i) {
            $param = [
                'usuario_id' => Auth::user()->id,
                'parametro_id' => $array_keys[$i],
                'avaliacao' => $array[$array_keys[$i]],
                'dia' => date('Y-m-d'),
            ];

            $data[$i] = $param;
        }

        try {
            UsuarioParametro::insert($data);
            return 0;
        } catch (Exception $e) {
            //dd($e->getMessage());
            return 1;
        }
    }

    public function edit(Request $request)
    {
        $dia = $request->dia;

        $usuario_parametros = UsuarioParametro::all()
            ->where('dia', $dia)
            ->where('usuario_id', Auth::user()->id);
        if (!empty($usuario_parametros)) {
            return view('edit-usupar', ['usuario_parametros' => $usuario_parametros, 'dia' => $request->dia]);
        } else {
            return redirect()
                ->route('index')
                ->withErrors('Não foi possivel encontrar o usuario_parametro.');
        }
    }

    public function update(Request $request)
    {
        $data = [];
        $array = $request->avaliacao;
        $array_keys = array_keys($array);

        for ($i = 0; $i < count($array); ++$i) {
            $param = [
                'avaliacao' => $array[$array_keys[$i]],
            ];

            $data[$i] = $param;

            try {
                UsuarioParametro::where('usuario_id', Auth::user()->id)
                    ->where('parametro_id', $array_keys[$i])
                    ->where('dia', $request->dia)
                    ->update($param);
            } catch (Exception $e) {
                return redirect()
                    ->route('index')
                    ->withErrors('Não foi possivel alterar o usuario_parametro.');
            }
        }

        return redirect()
        ->route('index')
        ->with('status', 'usuario_parametro alterado.');
    }

    public function destroy($id)
    {
        try {
            UsuarioParametro::where('id', $id)->delete();
            return redirect()
                ->route('index')
                ->with('status', 'UsuarioParametro deletado!');
        } catch (Exception $e) {
            return redirect()
                ->route('index')
                ->withErrors('Não foi possivel deletar o UsuarioParametro.');
        }
    }
}
