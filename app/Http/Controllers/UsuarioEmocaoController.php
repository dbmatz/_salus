<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Emocao;
use App\Models\Usuario;
use App\Models\UsuarioEmocao;
use Auth;

class UsuarioEmocaoController extends Controller
{
    public function create()
  {
    $emocoes = Emocao::all();
    return view('create-dia', ['emocoes' => $emocoes]);
  }

  public function store(Request $request){
    $usuario_emocao = new UsuarioEmocao();
    $usuario_emocao->usuario_id = Auth::user()->id;
    $usuario_emocao->emocao_id = $request->emocao_id;
    $usuario_emocao->descricao = $request->descricao;

    try{
        $usuario_emocao->save();
        return redirect()->route('index')->with('status', 'usuario_emocao criada!');
    } catch (Exception $e){
        return redirect()->route('index')->withErrors('usuario_emocao não criada! '.$e);
    }

  }

  public function edit($id)
    {
        $usuario_emocao = UsuarioEmocao::where('id', $id)->first();
        $emocoes = Emocao::all();
        if (!empty($usuario_emocao)) {
            return view('edit-dia', ['usuario_emocao' => $usuario_emocao, 'emocoes' => $emocoes]);
        } else {
            return redirect()->route('index')->withErrors('Não foi possivel encontrar o usuario_emocao.');
        }
    }

    public function update(Request $request, $id)
    {
        $data = [
            'emocao_id' => $request->emocao_id,
            'descricao' => $request->descricao,
        ];

        if (UsuarioEmocao::where('id', $id)->update($data)) {
            return redirect()->route('index')->with('status', 'UsuarioEmocao alterado!');
        } else {
            return redirect()->route('index')->withErrors('Não foi possivel alterar o UsuarioEmocao.');
        }
    }

    public function destroy($id)
  {
    if (UsuarioEmocao::where('id', $id)->delete()) {
      return redirect()->route('index')->with('status', 'UsuarioEmocao deletado!');
    } else {
      return redirect()->route('index')->withErrors('Não foi possivel deletar o UsuarioEmocao.');
    }
  }
}
