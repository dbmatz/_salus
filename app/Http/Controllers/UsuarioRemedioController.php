<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Remedio;
use App\Models\User;
use App\Models\UsuarioRemedio;
use Auth;
use Exception;

class UsuarioRemedioController extends Controller
{
    public function store(Request $request)
    {
        $data = [];
        $array = $request->status;
        $array_keys = array_keys($array);

        for ($i = 0; $i < count($array); ++$i) {
            $param = [
                'usuario_id' => Auth::user()->id,
                'remedio_id' => $array_keys[$i],
                'status' => $array[$array_keys[$i]],
                'dia' => date('Y-m-d'),
            ];

            $data[$i] = $param;
        }

        try {
            UsuarioRemedio::insert($data);
            return 0;
        } catch (Exception $e) {
            dd($e->getMessage());
            return 1;
        }
    }

    public function edit($id)
    {
        $usuario_remedio = UsuarioRemedio::find($id);
        if (!empty($usuario_remedio)) {
            return view('edit-usurem', ['usuario_remedio' => $usuario_remedio]);
        } else {
            return redirect()->route('index')->withErrors('Não foi possivel encontrar o usuario_remedio.');
        }
    }

    public function update(Request $request, $id)
    {
        $status = $request->status;
        $data = [
            'status' => $status[$id],
        ];

        if (UsuarioRemedio::where('id', $id)->update($data)) {
            return redirect()
                ->route('index')
                ->with('status', 'usuario_remedio alterado!');
        } else {
            return redirect()
                ->route('index')
                ->withErrors('Não foi possivel alterar o usuario_remedio.');
        }
    }

    public function destroy($id)
    {
        if (UsuarioRemedio::where('id', $id)->delete()) {
            return redirect()->route('index')->with('status', 'usuario_remedio deletado!');
        } else {
            return redirect()->route('index')->withErrors('Não foi possivel deletar o usuario_remedio.');
        }
    }
}