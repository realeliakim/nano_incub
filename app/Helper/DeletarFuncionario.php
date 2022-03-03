<?php
namespace App\Helper;

use Illuminate\Support\Facades\DB;
use App\Models\Funcionario;
use App\Models\Movimentacao;

class DeletarFuncionario
{
  public function deletarFuncionario(int $id): string
  {
    $nome = '';
    DB::transaction(function() use ($id, &$nome) {
      $funcionario = Funcionario::find($id);
      $nome = $funcionario->nome_completo;
      $funcionario->movimentacoes->each(
        function(Movimentacao $movimentacao){
          $movimentacao->delete();
        });
      $funcionario->delete();
    });

    return $nome;
  }
}
