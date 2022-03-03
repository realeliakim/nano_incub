<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\BuscarFuncionarioController;
use App\Http\Controllers\BuscarMovimentacaoController;
use App\Http\Controllers\MovimentacaoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('dashboard');

Route::get('/buscar', [BuscarFuncionarioController::class, 'search'])->name('funcionario.search');
Route::get('/buscar/movimentacao', [BuscarMovimentacaoController::class, 'search'])->name('movimentacao.search');

/** rota de funcionarios */
Route::get('/extrato/{id}', [FuncionarioController::class, 'modalExtrato'])->name('extrato');
Route::get('/funcionarios/criar', [FuncionarioController::class, 'create'])->name('funcionarios.create');
Route::post('/funcionarios',      [FuncionarioController::class, 'store'])->name('funcionarios.store');
Route::get('/funcionarios/editar/{id}', [FuncionarioController::class, 'edit'])->name('funcionarios.edit');
Route::put('/funcionarios/{id}',  [FuncionarioController::class, 'update'])->name('funcionarios.update');
Route::delete('/funcionarios/remover/{id}', [FuncionarioController::class, 'destroy'])->name('funcionarios.destroy');
/** fim */

/** rota de movimentacoes */
Route::get('/movimentacoes', [MovimentacaoController::class, 'index'])->name('movimentacoes');
Route::get('/movimentacoes/criar', [MovimentacaoController::class, 'create'])->name('movimentacoes.create');
Route::post('/movimentacoes', [MovimentacaoController::class, 'store'])->name('movimentacoes.store');
Route::get('/movimentacoes/editar/{id}', [MovimentacaoController::class, 'edit'])->name('movimentacoes.edit');
Route::put('/movimentacoes/{id}',  [MovimentacaoController::class, 'update'])->name('movimentacoes.update');
Route::delete('/movimentacoes/remover/{id}',  [MovimentacaoController::class, 'destroy'])->name('movimentacoes.destroy');
/** fim */
