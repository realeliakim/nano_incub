@extends('layouts.app')

@section('content')
<div class="col-md-11">
    @if(count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    @if($message = Session::get('success'))
      <div class="alert alert-success alert-block">
        <strong>{{ $message }}</strong>
      </div>
    @endif
    <div class="card">
      <div class="card-header">
        <h4>
          Cadastrar nova movimentação
            @if(isset($_GET['id']))
              {{ 'para id '.$_GET['id'] }}
            @else
             {{ '' }}
            @endif
        </h4>
      </div>
      <div class="card-body">
        <form id="form" method="POST" action="{{ route('movimentacoes.store') }}">
          @csrf
            @if(!isset($_GET{'id'}))
              <div class="form-group row mb-3">
                <div class="col-md-4 mb-3">
                  <label for="funcionario" class="form-label">{{ __('Funcionário:') }}</label>
                  <select class="form-select" name="funcionario_id">
                    <option selected>Selecione o funcionário</option>
                    @foreach($funcionarios as $funcionario)
                      <option value="{{ $funcionario->id }}">{{ $funcionario->nome_completo }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="tipo" class="form-label">{{ __('Tipo:') }}</label>
                  <select class="form-select" name="tipo">
                    <option selected>Selecione o tipo</option>
                    <option value="entrada">Entrada</option>
                    <option value="saida">Saída</option>
                  </select>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="tipo" class="form-label">{{ __('Valor:') }}</label>
                  <input type="text" class="form-control" name="valor" value="" oninput="moeda(this)" required >
                </div>
              </div>
            @else
            <div class="form-group row mb-3">
              <div class="col-md-6 mb-3">
                <label for="tipo" class="form-label">{{ __('Tipo:') }}</label>
                <select class="form-select" name="tipo">
                  <option selected>Selecione o tipo</option>
                  <option value="entrada">Entrada</option>
                  <option value="saida">Saída</option>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label for="tipo" class="form-label">{{ __('Valor:') }}</label>
                <input type="text" class="form-control" name="valor" value="" oninput="moeda(this)" required >
              </div>
              <div class="col-md-6 mb-3">
                <input type="hidden" class="form-control" name="funcionario_id" value="{{ $_GET['id'] }}">
              </div>
            </div>
            @endif
            <div class="form-group row mb-3">
              <div class="col-md-12 mb-3">
                <label for="tipo" class="form-label">{{ __('Observacao:') }}</label>
                <textarea id="observacao" type="text" class="form-control" name="observacao" required autocomplete=""></textarea>
              </div>
            </div>
            <div class="form-group row mb-3">
              <div class="col-md-5 offset-md-4">
                <button type="submit" class="btn btn-success w35" id="btn-submit">
                  {{ __('Salvar')}}
                </button>
                <a href="{{ route('dashboard') }}" class="btn btn-danger w35">
                  Voltar
                </a>
              </div>
            </div>
        </form>
      </div>
    </div>
</div>

@endsection
