<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movimentacao;

class MovimentacaoController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $movimentacoes = Movimentacao::all();
    return view('movimentacoes.index', compact('movimentacoes'));
  }

  public function create()
  {
    return view('movimentacoes.create');
  }

  public function store()
  {

  }




}
