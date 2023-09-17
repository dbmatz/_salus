<?php

namespace App\Http\Controllers;

use App\Models\Remedio;
use Illuminate\Http\Request;
use Auth;
use Exception;

class RemedioController extends Controller
{
    public function create()
    {
        return view('create-remedio');
    }

    public function store(Request $request)
    {
        $remedio = new Remedio();
        $remedio->nome = $request->nome;
        $remedio->usuario_id = Auth::user()->id;

        try {
            $remedio->save();
            return redirect()
                ->route('index')
                ->with('status', 'Remedio criada!');
        } catch (Exception $e) {
            return redirect()
                ->route('index')
                ->withErrors('erro. ' . $e);
        }
    }

    public function edit($id)
    {
        $remedio = Remedio::where('id', $id)->first();
        if (!empty($remedio)) {
            return view('edit-remedio', ['remedio' => $remedio]);
        } else {
            return redirect()
                ->route('index')
                ->withErrors('Não foi possivel encontrar o remedio.');
        }
    }

    public function update(Request $request, $id)
    {
        $data = [
            'nome' => $request->nome,
        ];
        try {
            Remedio::where('id', $id)->update($data);
            return redirect()
                ->route('index')
                ->with('status', 'remedio alterado!');
        } catch (Exception $e) {
            return redirect()
                ->route('index')
                ->withErrors('Não foi possivel alterar o remedio.');
        }
    }

    public function destroy($id)
    {
        try {
            Remedio::where('id', $id)->delete();
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
