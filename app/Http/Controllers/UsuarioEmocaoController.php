<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Emocao;
use App\Models\User;
use App\Models\UsuarioEmocao;
use Auth;

class UsuarioEmocaoController extends Controller
{
    public function store(Request $request)
    {
        $usuario_emocao = new UsuarioEmocao();
        $usuario_emocao->usuario_id = Auth::user()->id;
        $usuario_emocao->emocao_id = $request->emocao_id;
        $usuario_emocao->descricao = $request->descricao;
        $usuario_emocao->dia = date('Y-m-d');

        try {
            $usuario_emocao->save();
            return 0;
        } catch (Exception $e) {
            dd($e->getMessage());
            return 1;
        }
    }

    public function edit($id)
    {
        $usuario_emocao = UsuarioEmocao::where('id', $id)->first();
        $emocoes = Emocao::all();
        if (!empty($usuario_emocao)) {
            return view('edit-dia', ['usuario_emocao' => $usuario_emocao, 'emocoes' => $emocoes]);
        } else {
            return redirect()
                ->route('index')
                ->withErrors('Não foi possivel encontrar o usuario_emocao.');
        }
    }

    public function update(Request $request, $id)
    {
        $data = [
            'emocao_id' => $request->emocao_id,
            'descricao' => $request->descricao,
        ];

        try {
            UsuarioEmocao::where('id', $id)->update($data);
            return redirect()
                ->route('index')
                ->with('status', 'UsuarioEmocao alterado!');
        } catch (Exception $e) {
            return redirect()
                ->route('index')
                ->withErrors('Não foi possivel alterar o UsuarioEmocao.');
        }
    }

    public function destroy($id)
    {
        try {
            UsuarioEmocao::where('id', $id)->delete();
            return redirect()
                ->route('index')
                ->with('status', 'UsuarioEmocao deletado!');
        } catch (Exception $e) {
            return redirect()
                ->route('index')
                ->withErrors('Não foi possivel deletar o UsuarioEmocao.');
        }
    }
}
