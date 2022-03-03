@extends('layouts.app')

@section('content')
  @if(sizeof($funcionarios) == 0)
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">{{ __('LISTA DE FUNCIONÁRIOS VAZIA') }}</div>
          <div class="card-body center">
            <div class="content-card-body d-flex justify-content-between">
              <div>
                <h5>
                  Nenhum funcionario cadastrado até o momento.
                  <br />
                  Cadastre o seu primeiro funcionário:
                </h5>
              </div>
              <div>
                <a href="{{ route('funcionarios.create') }}" class="btn btn-success btn-md">
                  <i class="fa fa-plus-circle"></i>&nbsp; Criar novo funcionário
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @else
    @if($message = Session::get('success'))
      <div id="msg" class="alert alert-success alert-block">
        <strong>{{ $message }}</strong>
      </div>
    @endif
    <div class="col-md-12">
      <div class="offset-md-10">
        <a href="{{ route('funcionarios.create') }}" class="btn btn-success btn-md">
          <i class="fa fa-plus-circle"></i>&nbsp; Criar novo funcionário
        </a>
      </div>
    </div>
    <h3 class="padding15">Lista de Funcionários</h3>
    <form method="GET" action="{{ route('funcionario.search') }}">
      @csrf
      <div class="form-group row padding15">
        <div class="col-md-3 mb-3">
          <input type="search" name="search" placeholder="Nome" class="form-control typeahead">
        </div>
        <div class="col-md-3 mb-3">
          <input type="date" name="search_data" class="form-control">
        </div>
        <div class="col-md-2 mb-3">
          <button type="submit" class="btn btn-outline-primary w45">
            Buscar
          </button>
          <a href="{{ route('dashboard') }}" class="btn btn-outline-warning w45">
            Limpar
          </a>
        </div>
      </div>
    </form>
    @if($funcionarios['error'] != '')
      <div class="alert alert-danger padding15" role="alert">
        <h5>{{$funcionarios['error']}}</h5>
      </div>
    @else
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-md-center w5" scope="col">#</th>
            <th class="center w35" scope="col">Nome</th>
            <th class="text-md-center w25" scope="col">Saldo Atual</th>
            <th class="text-md-center w25" scope="col">Data de Criação</th>
            <th class="text-md-center w10" scope="col">Ações</th>
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
              <td class="d-flex">
                <button class="btn btn-secondary btn-sm extrato"
                  value="{{$funcionario->id}}" title="Ver extrato">
                  <i class="far fa-eye fa-lg"></i>
                </button>
                &nbsp;
                <a href="{{route('movimentacoes.create',['id'=>$funcionario->id]) }}">
                  <button class="btn btn-success btn-sm" title="Adicionar uma movimentação">
                    <i class="fa fa-plus-circle fa-lg"></i>
                  </button>
                </a>
                &nbsp;
                <a href="{{ route('funcionarios.edit', $funcionario->id) }}">
                  <button class="btn btn-primary btn-sm" title="Editar">
                    <i class="fas fa-edit fa-lg"></i>
                  </button>
                </a>
                &nbsp;
                <form action="{{ route('funcionarios.destroy', $funcionario->id) }}"
                  method="post"
                  onsubmit="return confirm('Tem certeza que deseja excluir {{ $funcionario->nome_completo }}')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm btn-block" title="Excluir">
                    <i class="far fa-trash-alt fa-lg"></i>
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div class="modal" id="modal"></div>
      <div class="pagination-block pagination">
        {{ $funcionarios->links('layouts.pagination') }}
      </div>
    @endif
  @endif
@endsection
