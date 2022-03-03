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
          Atualizar funcionário: {{ $funcionarios->id }}
        </h4>
      </div>
      <div class="card-body">
        <form id="form" method="POST" action="{{ route('funcionarios.update', $funcionarios->id) }}">
          @csrf
          @method('PUT')
          <div class="form-group row mb-3">
            <div class="col-md-12 mb-3">
              <label class="form-label">{{ __('Nome Completo:') }}</label>
              <input id="name" type="text" class="form-control" name="nome"
                placeholder="Nome" value="{{$funcionarios->nome_completo}}"
                required autofocus>
            </div>
          </div>

          <div class="form-group row mb-3">
            <div class="col-md-6 mb-3">
              <label class="form-label">{{ __('Email:') }}</label>
              <input id="email" type="email" class="form-control" name="email"
               placeholder="Email" value="{{$funcionarios->email}}"
               required autofocus>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">{{ __('Senha:') }}</label>
              <input id="senha" type="password" class="form-control"
                name="senha" placeholder="" value="{{$funcionarios->senha}}"
                autofocus>
            </div>
          </div>

          <div class="form-group row mb-3">
            <div class="col-md-5 mb-3">
              <label class="form-label">{{ __('Saldo:') }}</label>
              <input id="saldo" type="text" class="form-control" name="saldo"
                value="{{$funcionarios->saldo_atual}}"
                oninput="moeda(this)"
                required autofocus>
            </div>
            <div class="col-md-7 mb-3 text-md-center margin30">
              <button type="submit" class="btn btn-primary w35" id="btn-submit">
                {{ __('Atualizar')}}
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
