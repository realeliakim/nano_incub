<?php

namespace App\Http\Controllers;

use App\Http\Requests\FuncionariosFormRequest;
use App\Helper\DeletarFuncionario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Funcionario;

class FuncionarioController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function modalExtrato($id)
    {
      $funcionario = Funcionario::find($id);
      $valor = 0;
      return view('movimentacoes.extrato', compact('funcionario', 'valor'));
    }

    public function create()
    {
      return view('funcionarios.create');
    }

    public function store(FuncionariosFormRequest $request)
    {

      $data = [
        'nome_completo' =>  $request->nome,
        'email'         =>  $request->email,
        'senha'         =>  Hash::make($request->senha),
        'saldo_atual'   =>  $request->saldo,
        'admin_id'      =>  auth()->user()->id,
      ];
      $funcionario = Funcionario::create($data);
      $request->session()
          ->flash(
              'mensagem',
              "Funcionario {$funcionario->id} criada com sucesso {$funcionario->nome_completo}"
          );
      return redirect()->route('dashboard');
    }

    public function edit(int $id): object
    {
      if(!$funcionarios = Funcionario::find($id)){
        return redirect()->route('dashboard')
                         ->with("error", "Funcionário com id: {$id} não encontrado");
      }

      return view('funcionarios.update', compact('funcionarios'));
    }

    public function update(FuncionariosFormRequest $request, int $id)
    {
      if(!$funcionarios = Funcionario::find($id)){
        return redirect()->route('dashboard')
                         ->with("error", "Funcionário com id: {$id} não encontrado");
      }

      $data = [
        'nome_completo' =>  $request->nome,
        'email'         =>  $request->email,
        'saldo_atual'   =>  $request->saldo,
      ];

      if($funcionarios['senha'] !== $request->senha){
        array_push($data, 'senha', Hash::make($request->senha));
      }

      Funcionario::where(['id'=>$id])->update($data);
      return redirect()->route('dashboard')
                       ->with('success',
                              "Funcionário: {$funcionarios['nome_completo']}, atualizado com sucesso!");
    }

    public function destroy(DeletarFuncionario $deletarFuncionario, int $id)
    {

      $nomeFuncionario = $deletarFuncionario->deletarFuncionario($id);
      return redirect()->route('dashboard')
                       ->with('success',
                              "Funcionário: {$nomeFuncionario} removido com sucesso!");
    }

}
