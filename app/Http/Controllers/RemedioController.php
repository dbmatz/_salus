<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RemedioController extends Controller
{
    public function create()
  {
    return view('remedio-create');
  }
}
