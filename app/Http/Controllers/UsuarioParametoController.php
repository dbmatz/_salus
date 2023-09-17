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

    public function edit($id)
    {
        $usuario_parametro = UsuarioParametro::find($id);
        if (!empty($usuario_parametro)) {
            return view('edit-usupar', ['usuario_parametro' => $usuario_parametro]);
        } else {
            return redirect()
                ->route('index')
                ->withErrors('Não foi possivel encontrar o usuario_parametro.');
        }
    }

    public function update(Request $request, $id)
    {
        $data = [
            'avaliacao' => $request->avaliacao,
        ];

        try {
            UsuarioParametro::where('id', $id)->update($data);
            return redirect()
                ->route('index')
                ->with('status', 'usuario_parametro alterado!');
        } catch (Exception $e) {
            return redirect()
                ->route('index')
                ->withErrors('Não foi possivel alterar o usuario_parametro.');
        }
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
