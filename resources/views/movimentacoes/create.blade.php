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
        </h4>
      </div>
      <div class="card-body">
        <form id="form" method="POST" action="{{ route('movimentacoes.store') }}">
          @csrf
          <div class="form-group row mb-3">
            <div class="col-md-6 mb-3">
              <label for="tipo" class="form-label">{{ __('Tipo:') }}</label>
              <select class="form-select">
                <option selected>Open this select menu</option>
                <option value="entrada">Entrada</option>
                <option value="saida">Saída</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label for="tipo" class="form-label">{{ __('Valor:') }}</label>
              <input id="valor" type="text" class="form-control" name="valor" placeholder="" value="" required autocomplete="" autofocus>
            </div>
          </div>

          <div class="form-group row mb-3">
            <div class="col-md-12 mb-3">
              <label for="tipo" class="form-label">{{ __('Observacao:') }}</label>
              <textarea id="observacao" type="text" class="form-control" name="observacao" required autocomplete=""></textarea>
            </div>
          </div>
          <div class="form-group row mb-3">
            <div class="col-md-5 offset-md-5">
              <button type="submit" class="btn btn-success w35" id="btn-submit">
                {{ __('Salvar')}}
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
</div>

@endsection
