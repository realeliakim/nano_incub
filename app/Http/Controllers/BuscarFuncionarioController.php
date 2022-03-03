<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Funcionario;

class BuscarFuncionarioController extends Controller
{
  public function search(Request $request): object
  {
    $search = $request->search;
    $data   = $request->search_data;

    if(isset($search) || isset($data)){
        $funcionarios = DB::table('funcionarios')
                        ->where('nome_completo','LIKE','%'.$search.'%')
                        ->WhereDate('created_at','LIKE','%'.$data.'%')
                        ->paginate(10)
                        ->appends($request->all());

        if($funcionarios[0] != ''){
          return view('home', ['funcionarios'=>$funcionarios]);
        }
        $err = ['error'=>'Nenhum resultado encontrado'];
        return view('home', ['funcionarios'=>$err]);
    }
    else {
      $funcionarios = DB::table('funcionarios')->paginate(10);
      return view('home', compact('funcionarios'));
    }
  }
}
