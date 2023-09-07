<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parametro;
use Auth;

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
            return redirect()->route('index')->with('status', 'parametro criada!');
        } catch (Exception $e) {
            return redirect()->route('index')->withErrors('erro. ' . $e);
        }
    }

    public function edit($id)
    {
        $parametro = Parametro::where('id', $id)->first();
        if (!empty($parametro)) {
            return view('edit-parametro', ['parametro' => $parametro]);
        } else {
            return redirect()->route('index')->withErrors('Não foi possivel encontrar o parametros.');
        }
    }

    public function update(Request $request, $id)
    {
        $data = [
            'nome' => $request->nome,
        ];
        if (Parametro::where('id', $id)->update($data)) {
            return redirect()->route('index')->with('status', 'Parametro alterado!');
        } else {
            return redirect()->route('index')->withErrors('Não foi possivel alterar o parametro.');
        }
    }

    public function destroy($id)
  {
    if (Parametro::where('id', $id)->delete()) {
      return redirect()->route('index')->with('status', 'Parametro deletado!');
    } else {
      return redirect()->route('index')->withErrors('Não foi possivel deletar o Parametro.');
    }
  }
}