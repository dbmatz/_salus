<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emocao;
use Auth;
use Exception;

class EmocaoController extends Controller
{
    //

    public function create()
    {
        return view('Emocao.create');
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
            $emocao->imagem = '/' . $imageName;
        } else {
            $emocao->imagem = 'default.jpg';
        }

        try {
            $emocao->save();
            return redirect()
                ->route('index')
                ->with('status', 'Emoção criada!');
        } catch (Exception $e) {
            return redirect()
                ->route('index')
                ->withErrors('Não foi possivel criar a Emoção.');
        }
    }
}
