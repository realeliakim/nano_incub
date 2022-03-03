<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Movimentacao;

class BuscarMovimentacaoController extends Controller
{
  public function search(Request $request): object
  {
    $nome = $request->nome;
    $tipo = $request->tipo;
    $data = $request->data;

    $movimentacoes = '';

    if(isset($nome)) {
      $movimentacoes = Movimentacao::whereRelation('funcionario','nome_completo','LIKE','%'.$nome.'%')
                       ->paginate(10)
                       ->appends($request->all());
    }
    else if(isset($tipo)){
      $movimentacoes = Movimentacao::where('tipo',$tipo)->paginate(10)
                                     ->appends($request->all());
    }
    else if(isset($data)){
      $movimentacoes = Movimentacao::where('created_at','LIKE','%'.$data.'%')
                                     ->paginate(10)
                                     ->appends($request->all());
    }
    else {
      $movimentacoes = Movimentacao::paginate(10);
      return view('movimentacoes.index', compact('movimentacoes'));
    }

    if($movimentacoes[0] != ''){
      return view('movimentacoes.index', ['movimentacoes'=>$movimentacoes]);
    }
    $err = ['error'=>'Nenhum resultado encontrado'];
    return view('movimentacoes.index', ['movimentacoes'=>$err]);
  }
}
