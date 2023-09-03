<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function index()
  {
    $usuarios = Usuario::orderBy('id')->get();
    return view('usuario.index', ['usuarios' => $usuarios]);
  }

  /*public function create()
  {
    return view('usuario.create');
  }*/

  
  public function store(Request $request)
  {
    $usuario = new Usuario();
    $usuario->nome = $request->input('nome');

    if ($usuario->save()) {
      return redirect()->route('usuario-index')->with('status', 'Gênero criado!');
    } else {
      return redirect()->route('usuario-index')->withErrors('Não foi possivel salvar o gênero.');
    }
  }

  /*
  public function edit($id)
  {
    $usuarios = Usuario::where('id', $id)->first();
    if (!empty($usuarios)) {
      return view('edit-usuario', ['usuarios' => $usuarios]);
    } else {
      return redirect()->route('usuario-index')->withErrors('Não foi possivel encontrar o gênero.');
    }
  }

  public function update(Request $request, $id)
  {
    if ($request->hasFile('foto')) {
      $arquivo = $request->file('foto');
      $destPath = public_path('imagens');
      $imageName = time() . '_' . $arquivo->getClientOriginalName();
      $arquivo->move($destPath, $imageName);
      $data = [
        'nome' => $request->nome,
        'foto' => $imageName,
      ];
    } else {
      $data = [
        'nome' => $request->nome,
      ];
    }
    if (Usuario::where('id', $id)->update($data)) {
      return redirect()->route('usuario-index')->with('status', 'Gênero alterado!');
    } else {
      return redirect()->route('usuario-index')->withErrors('Não foi possivel alterar o gênero.');
    }
  }

  public function destroy($id)
  {
    if (Usuario::where('id', $id)->delete()) {
      return redirect()->route('usuario-index')->with('status', 'Gênero deletado!');
    } else {
      return redirect()->route('usuario-index')->withErrors('Não foi possivel deletar o gênero.');
    }
  }*/
}
