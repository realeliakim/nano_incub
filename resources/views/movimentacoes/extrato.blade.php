<div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          Extrato de Movimentação de {{ $funcionario->nome_completo }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        @if(sizeof($funcionario->movimentacoes) > 0)
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-md-center w20" scope="col">Data de Movimentação</th>
                <th class="text-md-center w15" scope="col">Tipo</th>
                <th class="text-md-center w15" scope="col">Valor</th>
                <th class="text-md-center" scope="col">Observação</th>
              </tr>
            </thead>
            <tbody>
              @foreach($funcionario->movimentacoes as $movimentacao)
              <tr>
                <td class="text-md-center">{{ date('d/m/Y', strtotime($movimentacao->created_at)) }}</td>
                <td class="text-md-center">{{ $movimentacao->tipo }}</td>
                <td class="text-md-center">{{ number_format($movimentacao->valor,2,',','.') }}</td>
                <td class="text-md-center">{{ $movimentacao->observacao }}</td>
              </tr>
              <span style="display: none">
              @if($movimentacao->tipo == 'entrada')
                  {{$valor = $valor+$movimentacao->valor}}
              @else
                  {{$valor = $valor-$movimentacao->valor}}
              @endif
              </span>
              @endforeach
            </tbody>
            <tr>
              <th colspan="2" class="text-md-center">Total</th>
              <th class="text-md-center">{{number_format($valor,2,',','.')}}</th>
              <th></th>
            </tr>
          </table>
        @else
        <div class="alert alert-danger padding15" role="alert">
          <h5>Nenhuma movimentação cadastrada para este funcionário</h5>
        </div>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
