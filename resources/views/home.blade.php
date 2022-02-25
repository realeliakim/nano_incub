@extends('layouts.app')

@section('content')
  @if(sizeof($funcionarios) == 0)
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">{{ __('LISTA DE FUNCIONÁRIOS VAZIA') }}</div>
          <div class="card-body center">
            <div calss="content-card-body">
              <div>
                <h5>
                  Nenhum funcionario cadastrado até o momento.
                  <br />
                  Cadastre o seu primeiro funcionário:
                </h5>
              </div>
              <div>
                <a href="{{ route('funcionarios.create') }}" class="btn btn-success btn-md">+ Criar novo funcionario</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @else
    <div class="col-md-12">
      @if($message = Session::get('success'))
        <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ $message }}</strong>
        </div>
      @endif
        <div class="offset-md-10">
          <a href="{{ route('funcionarios.create') }}" class="w100 btn btn-success btn-md">+ Cadastrar novo funcionario</a>
        </div>
    </div>
  @endif
  <h3>Lista de Funcionários</h3>
  <br />
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th class="text-md-center w5" scope="col">#</th>
        <th class="center w35" scope="col">Nome</th>
        <th class="text-md-center w20" scope="col">Saldo Atual</th>
        <th class="text-md-center w20" scope="col">Data de Criação</th>
        <th class="text-md-center w20" scope="col">Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach($funcionarios as $funcionario)
        <tr>
          <th class="text-md-center">{{$funcionario->id}}</th>
          <td>{{$funcionario->nome_completo}}</td>
          <td class="text-md-center">
            {{number_format($funcionario->saldo_atual, 2,',','.')}}
          </td>
          <td class="text-md-center">
            {{date('d/m/Y', strtotime($funcionario->created_at))}}
          </td>
          <td class="text-md-center">
            <button class="btn btn-secondary btn-sm w20" title="Ver extrato">
              <i class="far fa-eye fa-lg"></i>
            </button>
            <button class="btn btn-success btn-sm w20" title="Adicionar uma movimentação">
              <a href="">
                <i class="fa fa-plus-circle fa-lg"></i>
              </a>
            </button>
            <a href="{{ route('funcionarios.edit', $funcionario->id) }}">
              <button class="btn btn-primary btn-sm w20" title="Editar">
                <i class="fa fa-pen-to-square"></i>
              </button>
            </a>
            <button class="btn btn-danger btn-sm w20" title="Excluir">
              <i class="far fa-trash-alt fa-lg"></i>
            </button>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
