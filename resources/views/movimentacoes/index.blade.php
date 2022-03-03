@extends('layouts.app')

@section('content')
  @if(sizeof($movimentacoes) == 0)
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">{{ __('LISTA DE MOVIMENTAÇÕES VAZIA') }}</div>
          <div class="card-body center">
            <div class="content-card-body d-flex justify-content-between ">
              <div>
                <h5>
                  Nenhum funcionario cadastrado até o momento.
                  <br />
                  Cadastre o seu primeiro funcionário:
                </h5>
              </div>
              <div>
                <a href="{{ route('movimentacoes.create') }}" class="btn btn-success btn-md">
                  <i class="fa fa-plus-circle"></i>&nbsp; Criar nova movimentação
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
        <a href="{{ route('movimentacoes.create') }}" class="btn btn-success btn-md">
          <i class="fa fa-plus-circle"></i>&nbsp; Criar nova movimentação
        </a>
      </div>
    </div>
    <h3 class="padding15">Movimentações</h3>
    <form method="GET" action="{{ route('movimentacao.search') }}">
      @csrf
      <div class="form-group row padding15">
        <div class="col-md-3 mb-3">
          <select class="form-select" name="tipo">
            <option value="" selected>Selecione o tipo</option>
            <option value="entrada">Entrada</option>
            <option value="saida">Saída</option>
          </select>
        </div>
        <div class="col-md-3 mb-3">
          <input type="search" name="nome" placeholder="Nome Funcionário" class="form-control">
        </div>
        <div class="col-md-3 mb-3">
          <input type="date" name="data" class="form-control" value="">
        </div>
        <div class="col-md-2 mb-3">
          <button type="submit" class="btn btn-outline-primary w45">
            Buscar
          </button>
          <a href="{{ route('movimentacoes') }}" class="btn btn-outline-warning w45">
            Limpar
          </a>
        </div>
      </div>
    </form>
    @if($movimentacoes['error'] != '')
      <div class="alert alert-danger padding15" role="alert">
        <h5>{{$movimentacoes['error']}}</h5>
      </div>
    @else
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-md-center w5" scope="col">#</th>
            <th class="text-md-center w15" scope="col">Tipo</th>
            <th class="text-md-center w10" scope="col">Valor</th>
            <th class="text-md-center w25" scope="col">Funcionario</th>
            <th class="text-md-center w25" scope="col">Observacao</th>
            <th class="text-md-center w15" scope="col">Data de Criação</th>
            <th class="text-md-center w10" scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach($movimentacoes as $movimentacao)
            <tr>
              <th class="text-md-center">{{$movimentacao->id}}</th>
              <td class="text-md-center">{{$movimentacao->tipo}}</td>
              <td class="text-md-center">
                {{number_format($movimentacao->valor, 2,',','.')}}
              </td>
              <td>{{$movimentacao->funcionario->nome_completo}}</td>
              <td>{{$movimentacao->observacao}}</td>
              <td class="text-md-center">
                {{date('d/m/Y', strtotime($movimentacao->created_at))}}
              </td>
              <td class="d-flex">
                <a href="{{ route('movimentacoes.edit', $movimentacao->id) }}">
                  <button class="btn btn-primary btn-sm">
                    <i class="fas fa-edit fa-lg"></i>
                  </button>
                </a>
                &nbsp;
                <form action="{{ route('movimentacoes.destroy', $movimentacao->id) }}"
                  method="post"
                  onsubmit="return confirm('Tem certeza que deseja excluir a movimentação {{ $movimentacao->id }}')">
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
      <div class="pagination-block pagination">
        {{ $movimentacoes->links('layouts.pagination') }}
      </div>
    @endif
  @endif
@endsection
