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
          Atualizar movimentacão para: {{ $movimentacoes->funcionario->nome_completo }}
        </h4>
      </div>
      <div class="card-body">
        <form id="form" method="POST" action="{{ route('movimentacoes.update', $movimentacoes->id) }}">
          @csrf
          @method('PUT')

          <div class="form-group row mb-3">
            <div class="col-md-6 mb-3">
              <label for="tipo" class="form-label">{{ __('Tipo:') }}</label>
              <select class="form-select" name="tipo">
                <option value="">Selecione o tipo</option>
                @if($movimentacoes->tipo == 'entrada')
                <option value="{{ $movimentacoes->tipo }}" selected>
                  Entrada
                </option>
                <option value="saida">Saída</option>
                @else
                <option value="entrada">Entrada</option>
                <option value="{{ $movimentacoes->tipo }}" selected>
                  Saída
                </option>
                @endif
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label for="tipo" class="form-label">{{ __('Valor:') }}</label>
              <input id="valor" type="text" class="form-control" name="valor"
                value="{{ $movimentacoes->valor }}"
                oninput="moeda(this)" required autofocus>
            </div>
          </div>
          <div class="form-group row mb-3">
            <div class="col-md-7 mb-3">
              <label for="tipo" class="form-label">{{ __('Observacao:') }}</label>
              <textarea id="observacao" type="text" class="form-control"
                name="observacao" required >{{ $movimentacoes->observacao }}</textarea>
            </div>
            <div class="col-md-5 mb-3 text-md-center margin30">
              <button type="submit" class="btn btn-success w40" id="btn-submit">
                {{ __('Atualizar')}}
              </button>
              <a href="{{ route('movimentacoes') }}" class="btn btn-danger w40">
                Voltar
              </a>
            </div>
          </div>

          </div>
        </form>
      </div>
    </div>
</div>

@endsection
