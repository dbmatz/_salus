<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parametro;
use Auth;
use Exception;

class ParametroController extends Controller
{
    public function create()
    {
        return view('create-parametro');
    }

    public function store(Request $request)
    {
        $parametro = new Parametro();
        $parametro->nome = $request->nome;
        $parametro->usuario_id = Auth::user()->id;

        try {
            $parametro->save();
            return redirect()
                ->route('index')
                ->with('status', 'parametro criada!');
        } catch (Exception $e) {
            return redirect()
                ->route('index')
                ->withErrors('erro. ' . $e);
        }
    }

    public function edit($id)
    {
        $parametro = Parametro::where('id', $id)->first();
        if (!empty($parametro)) {
            return view('edit-parametro', ['parametro' => $parametro]);
        } else {
            return redirect()
                ->route('index')
                ->withErrors('Não foi possivel encontrar o parametros.');
        }
    }

    public function update(Request $request, $id)
    {
        $data = [
            'nome' => $request->nome,
        ];

        try {
            Parametro::where('id', $id)->update($data);
            return redirect()
                ->route('index')
                ->with('status', 'Parametro alterado!');
        } catch (Exception $e) {
            return redirect()
                ->route('index')
                ->withErrors('Não foi possivel alterar o parametro.');
        }
    }

    public function destroy($id)
    {
        try {
            Parametro::where('id', $id)->delete();
            return redirect()
                ->route('index')
                ->with('status', 'Parametro deletado!');
        } catch (Exception $e) {
            return redirect()
                ->route('index')
                ->withErrors('Não foi possivel deletar o Parametro.');
        }
    }

    public function delete($id)
    {
        try {
            Parametro::find($id)->delete();
            return redirect()
                ->route('index')
                ->with('status', 'remedio deletado!');
        } catch (Exception $e) {
            return redirect()
                ->route('index')
                ->withErrors('Não foi possivel deletar o remedio.');
        }
    }
}
