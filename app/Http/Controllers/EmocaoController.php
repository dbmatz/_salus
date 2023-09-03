<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emocao;

class EmocaoController extends Controller
{
    //

    public function create (){
        return view('emocao-create');
    }

    public function store(Request $request)
  {
    
  }
}
