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

        try{
            $parametro->save();
            return redirect()->route('index')->with('status', 'parametro criada!');
        }catch(Exception $e){
            return redirect()->route('index')->withErrors('erro. '.$e);
        }
    }
}