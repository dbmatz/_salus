<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Emocao;
use App\Models\User;
use App\Models\UsuarioEmocao;
use Illuminate\Support\Facades\DB;
use Auth;

class UsuarioEmocaoController extends Controller
{
    public function store(Request $request)
    {
        $data = ['usuario_id' => Auth::user()->id, 'dia' => $request->dia];

        try {
            DB::table('usuario_emocaos')->updateOrInsert($data, ['emocao_id' => $request->emocao_id, 'descricao' => $request->descricao]);
            return 0;
        } catch (Exception $e) {
            redirect()
                ->route('index')
                ->withErrors('Não foi possível salvar o registro. Tente novamente mais tarde!');
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
                ->withErrors('Não foi possivel encontrar o registro.');
        }
    }

    public function update(Request $request)
    {
        $usuario_emocao = UsuarioEmocao::where('dia', $request->dia)
            ->where('usuario_id', Auth::user()->id)
            ->first();

        $data = [
            'emocao_id' => $request->emocao_id,
            'descricao' => $request->descricao,
        ];

        try {
            UsuarioEmocao::where('id', $usuario_emocao->id)->update($data);
            return '0';
        } catch (Exception $e) {
            return 1;
        }
    }

    public function destroy($id)
    {
        try {
            UsuarioEmocao::where('id', $id)->destroy();
            return redirect()
                ->route('index')
                ->with('status', 'Registro deletado!');
        } catch (Exception $e) {
            return redirect()
                ->route('index')
                ->withErrors('Não foi possivel deletar o registro.');
        }
    }
}
