<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Funcionario extends Model
{
  use HasFactory;

  protected $fillable = [
    'nome_completo',
    'email',
    'senha',
    'saldo_atual',
    'admin_id',
  ];

  public function admin()
  {
    return $this->belongsTo(Admin::class);
  }

  public function movimentacoes()
  {
    return $this->hasMany(Movimentacao::class);
  }

}
