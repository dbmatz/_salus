<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Remedio;
use App\Models\User;
use App\Models\UsuarioRemedio;
use Illuminate\Support\Facades\DB;
use Auth;
use Exception;

class UsuarioRemedioController extends Controller
{
    public function store(Request $request)
    {
        $array = $request->status;
        $array_keys = array_keys($array);

        for ($i = 0; $i < count($array); ++$i) {
            $param = [
                'usuario_id' => Auth::user()->id,
                'remedio_id' => $array_keys[$i],
                'dia' => $request->dia,
            ];

            try {
                DB::table('usuario_remedios')->updateOrInsert($param, ['status' => $array[$array_keys[$i]]]);
            } catch (Exception $e) {
                //dd($e->getMessage());
                return 1;
            }
        }
        return 0;
    }

    public function edit($id)
    {
        $usuario_remedio = UsuarioRemedio::find($id);
        if (!empty($usuario_remedio)) {
            return view('edit-usurem', ['usuario_remedio' => $usuario_remedio]);
        } else {
            return redirect()
                ->route('index')
                ->withErrors('Não foi possivel encontrar o usuario_remedio.');
        }
    }

    /*public function update(Request $request)
    {
        $data = [];
        $array = $request->status;
        $array_keys = array_keys($array);

        for ($i = 0; $i < count($array); ++$i) {
            $param = [
                'status' => $array[$array_keys[$i]],
            ];

            $data[$i] = $param;

            try {
                UsuarioRemedio::where('usuario_id', Auth::user()->id)
                    ->where('remedio_id', $array_keys[$i])
                    ->where('dia', $request->dia)
                    ->update($param);
            } catch (Exception $e) {
                return 1;
            }
        }

        return 0;
    }*/

    public function destroy($id)
    {
        try {
            UsuarioRemedio::where('id', $id)->delete();
            return redirect()
                ->route('index')
                ->with('status', 'usuario_remedio deletado!');
        } catch (Exception $e) {
            return redirect()
                ->route('index')
                ->withErrors('Não foi possivel deletar o usuario_remedio.');
        }
    }
}
