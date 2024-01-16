<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parametro;
use Auth;
use Exception;

class ParametroController extends Controller
{
    public function store(Request $request)
    {
        $parametro = new Parametro();
        $parametro->nome = $request->nome;
        $parametro->usuario_id = Auth::user()->id;

        try {
            $parametro->save();
            return redirect()
                ->route('index')
                ->with('status', 'Parametro criado!');
        } catch (Exception $e) {
            return redirect()
                ->route('index')
                ->withErrors('erro. ' . $e);
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

    public function delete($id)
    {
        try {
            Parametro::find($id)->delete();
            return redirect()
                ->route('index')
                ->with('status', 'Parametro deletado!');
        } catch (Exception $e) {
            return redirect()
                ->route('index')
                ->withErrors('Não foi possivel deletar o Parametro.');
        }
    }
}
