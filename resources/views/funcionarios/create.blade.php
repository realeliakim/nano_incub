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
          Cadastrar novo funcionário
        </h4>
      </div>
      <div class="card-body">
        <form id="form" method="POST" action="{{ route('funcionarios.store') }}">
          @csrf
          <div class="form-group row mb-3">
            <div class="col-md-12 mb-3">
              <label class="form-label">{{ __('Nome Completo:') }}</label>
              <input id="name" type="text" class="form-control" name="nome"
                placeholder="Nome" value="" required autofocus>
            </div>
          </div>

          <div class="form-group row mb-3">
            <div class="col-md-6 mb-3">
              <label class="form-label">{{ __('Email:') }}</label>
              <input id="email" type="email" class="form-control" name="email"
               placeholder="Email" value="" required autofocus>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">{{ __('Senha:') }}</label>
              <input id="senha" type="password" class="form-control"
               name="senha" required autofocus>
            </div>
          </div>

          <div class="form-group row mb-3">
            <div class="col-md-5 mb-3">
              <label class="form-label">{{ __('Saldo:') }}</label>
              <input id="saldo" type="text" class="form-control" name="saldo"
               oninput="moeda(this)" required >
            </div>
            <div class="col-md-7 mb-3 text-md-center margin30">
              <button type="submit" class="btn btn-success w50" id="btn-submit">
                {{ __('Salvar')}}
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
</div>

@endsection
