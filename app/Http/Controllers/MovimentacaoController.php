<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\Movimentacao;

class MovimentacaoController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $movimentacoes = Movimentacao::paginate(10);
    return view('movimentacoes.index', compact('movimentacoes'));
  }

  public function create()
  {
    $funcionarios = Funcionario::all();
    return view('movimentacoes.create', compact('funcionarios'));
  }

  public function store(Request $request)
  {
    $data = [
      'tipo'            =>  $request->tipo,
      'valor'           =>  $request->valor,
      'observacao'      =>  $request->observacao,
      'funcionario_id'  =>  $request->funcionario_id,
      'admin_id'        =>  auth()->user()->id,
    ];

    $movimentacao = Movimentacao::create($data);
    return redirect()->route('movimentacoes')
                     ->with('success',
                     "Movimentação com id {$movimentacao->id} criado com sucesso para
                      o funcionario {$movimentacao->funcionario->nome_completo}.");
  }

  public function edit(int $id):object
  {
    if(!$movimentacoes = Movimentacao::find($id)){
      return redirect()->route('movimentacoes')
                       ->with("error", "Movimentação com id: {$id} não encontrado");
    }

    return view('movimentacoes.update', compact('movimentacoes'));
  }

  public function update(Request $request, int $id): object
  {
    if(!$movimentacoes = Movimentacao::find($id)){
      return redirect()->route('movimentacoes')
                       ->with("error", "Movimentação com id: {$id} não encontrado");
    }

    $data = [
      'tipo'            =>  $request->tipo,
      'valor'           =>  $request->valor,
      'observacao'      =>  $request->observacao,
    ];

    Movimentacao::where('id',$id)->update($data);
    return redirect()->route('movimentacoes')
                       ->with('success',
                              "Movimentacao com id {$id} atualizado com sucesso!");
  }

  public function destroy(Request $request, int $id): object
  {
    $movimento = Movimentacao::find($id);
    $movimento->delete();
    return redirect()->route('movimentacoes')
                       ->with('success',
                              "Movimentacao com id {$id} removido com sucesso!");
  }


}
