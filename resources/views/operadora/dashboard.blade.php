@extends('layout.main')
@section('content')
<div class="container vh-100">
  <h2 class="my-4 text-secondary">Olá, {{ $users->name }}. Seja muito bem vindo! <br> Aqui você escolhe a movimentação e em seguida <br>  o sistema irá redireciona-lo para a tela das propostas.</h2>
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
          <th scope="col">ADMINISTRADORA</th>
          <th scope="col">MÊS REFERÊNCIA</th>
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
            <td>{{ $movement->nome_empresa }}</td>
            @if ($movement->data_inclusao)
            <td>{{ $movement->data_inclusao }}</td>
            @else
            <td>{{ $movement->data_exclusao }}</td>
            @endif
          </tr>
        @endforeach
      </tbody>
    </table>
    {{ $movements->links() }}
  </div>
</div>
@endsection
