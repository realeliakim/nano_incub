<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{

  use HasFactory;

  protected $table = 'movimentacoes';

  protected $fillable = [
    'tipo',
    'valor',
    'observacao',
    'funcionario_id',
    'admin_id',
  ];

  public function admin()
  {
    return $this->belongsTo(Admin::class);
  }

  public function funcionario()
  {
    return $this->belongsTo(Funcionario::class);
  }

}
