<?php

namespace App\Http\Controllers;

use App\Models\Remedio;
use Illuminate\Http\Request;
use Auth;
use Exception;

class RemedioController extends Controller
{
    public function store(Request $request)
    {
        $remedio = new Remedio();
        $remedio->nome = $request->nome;
        $remedio->usuario_id = Auth::user()->id;

        try {
            $remedio->save();
            return redirect()
                ->route('index')
                ->with('status', 'Remédio criado!');
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
            Remedio::where('id', $id)->update($data);
            return redirect()
                ->route('index')
                ->with('status', 'Remédio alterado!');
        } catch (Exception $e) {
            return redirect()
                ->route('index')
                ->withErrors('Não foi possivel alterar o remédio.');
        }
    }

    public function delete($id)
    {
        try {
            Remedio::find($id)->delete();
            return redirect()
                ->route('index')
                ->with('status', 'Remédio deletado!');
        } catch (Exception $e) {
            return redirect()
                ->route('index')
                ->withErrors('Não foi possivel deletar o remédio.');
        }
    }
}
