@extends('layout.main')
@section('content')
<div class="container vh-100">
  <h2 class="my-4 text-secondary">Olá, {{ $user }}. Seja muito bem vindo! <br> Aqui você escolhe a movimentação e em seguida <br>  o sistema irá redireciona-lo para a tela das propostas.</h2>
  <div class="row justify-content-center my-5">

    <table class="table">
      <thead>
        <tr>
          <th scope="col">ARQUIVO</th>
          <th scope="col">ENTIDADE</th>
          <th scope="col">VIGÊNCIA</th>
          <th scope="col">STATUS</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($movements as $movement)
          <tr class="table-{{ $movement->status == 'PENDENTE' ? 'warning' : 'success' }}">
            @if ($movement->data_inclusao)
            <th scope="row">
              <a href="{{ url('proposta', ['inclusao' => $movement->data_inclusao]) }}" target="_blank" rel="noopener noreferrer">IN{{ $movement->data_inclusao }}</a>
            </th>
            @else
            <th scope="row">
              <a href="{{ url('proposta', ['exclusao' => $movement->data_exclusao]) }}" target="_blank" rel="noopener noreferrer">EX{{ $movement->data_exclusao }}</a>
            </th>
            @endif
            <td>{{ $movement->nome_entidade }}</td>
            <td>{{ $movement->data }}</td>
            <td><i class="{{ $movement->status == 'PENDENTE' ? 'fas fa-exclamation-triangle text-warning' : 'fas fa-check-circle text-success' }}"></i> {{ $movement->status }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{ $movements->links() }}
  </div>
</div>
@endsection
