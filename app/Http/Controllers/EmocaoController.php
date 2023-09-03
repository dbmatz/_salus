<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emocao;

class EmocaoController extends Controller
{
  //

  public function create()
  {
    return view('emocao-create');
  }

  public function store(Request $request)
  {
    $emocao = new Emocao();
    $emocao->nome = $request->nome;

    if ($request->hasFile('imagem')) {
      $arquivo = $request->file('imagem');
      $destPath = public_path('emocoes');
      $imageName = $arquivo->getClientOriginalName();
      $arquivo->move($destPath, $imageName);
      $emocao->imagem = "/" . $imageName;
    } else {
      $emocao->imagem = "default.jpg";
    }

    if ($emocao->save()) {
      return redirect()->route('index')->with('status', 'Editora criada!');
    } else {
      return redirect()->route('index')->withErrors('Não foi possivel salvar a editora.');
    }

  }
}