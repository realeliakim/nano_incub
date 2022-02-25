<?php

namespace App\Http\Controllers;

use App\Http\Requests\FuncionariosFormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Funcionario;

class FuncionarioController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
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

    public function edit(int $id)
    {
      if(!$funcionarios = Funcionario::find($id)){
        return redirect()->route('dashboard')->with("error", "Funcionário com id: {$id} não encontrado");
      }

      return view('funcionarios.update', compact('funcionarios'));
    }

    public function update(FuncionariosFormRequest $request, int $id)
    {
      if(!$funcionarios = Funcionario::find($id)){
        return redirect()->route('dashboard')->with("error", "Funcionário com id: {$id} não encontrado");
      }


    }

    public function destroy($id)
    {

    }

}
