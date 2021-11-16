@extends('layout.main')
@section('content')
<div class="container vh-100">
  <h2 class="my-4 text-secondary">Olá, {{ $user }}. Seja muito bem vindo! <br> Aqui você escolhe a movimentação e em seguida <br>  o sistema irá redireciona-lo para a tela das propostas.</h2>
  <div class="row justify-content-center my-5">

    @if (session()->has('message'))
    <div class="alert alert-success alert-dismissible bg-success text-white fade show" role="alert">
      <strong>{{ session()->get('message') }}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <table class="table">
      <thead>
        <tr>
          <th scope="col">PROTOCOLO</th>
          <th scope="col">ENTIDADE</th>
          <th scope="col">VIGÊNCIA</th>
          <th scope="col">STATUS</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($movements as $movement)
          <tr class="table-{{ $movement->statusID == 5 ? 'warning' : 'light' }}">
            @if ($movement->data_inclusao)
            <th scope="row">
              <a href="{{ url('proposta', ['inclusao' => 'in.'.$movement->data_inclusao]) }}" rel="noopener noreferrer">IN{{ $movement->data_inclusao }}</a>
            </th>
            @else
            <th scope="row">
              <a href="{{ url('proposta', ['exclusao' => 'ex.'.$movement->data_exclusao]) }}" rel="noopener noreferrer">EX{{ $movement->data_exclusao }}</a>
            </th>
            @endif
            <td>{{ $movement->nome_entidade }}</td>
            <td>{{ $movement->data }}</td>
            <td><i class="{{ $movement->statusID == 5 ? 'fas fa-exclamation-triangle text-warning' :
                            ($movement->statusID == 4 ? 'fas fa-eye text-info' :
                            ($movement->statusID == 1 ? 'fas fa-sign-out-alt text-primary' :
                            ($movement->statusID == 7 ? 'fas fa-minus-circle text-danger' :
                            ($movement->statusID == 2 ? 'fas fa-sync-alt text-secondary' :
                            'fas fa-check-circle text-success')))) }}"></i> {{ $movement->status }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{ $movements->links() }}
  </div>
</div>
@endsection
