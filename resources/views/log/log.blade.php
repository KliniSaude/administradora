@extends('layout.main')
@section('content')

<div class="container">
  <h3 class="my-4 text-secondary">Log de movimentação</h3>

  <form action="../classes/Selects.php" method="post">
    <div class="row mt-5">
      <div class="col-md-2">
        <label class="form-label">Mês da compêtencia</label>
        <input type="month" class="form-control mb-3" id="mes_competencia">
      </div>
      <div class="col-md-3">
        <label class="form-label">Entidade</label>
        <select class="form-select" aria-label="Escolha uma opção">
          <option selected></option>
          <option value=""></option>
        </select>
      </div>
      <div class="col-md-2">
        <label class="form-label">Vigência</label>
        <select class="form-select" aria-label="Escolha uma opção">
          <option selected></option>
          <option value=""></option>
        </select>

      </div>
      <div class="col-md-2">
        <label class="form-label">Status</label>
        <select class="form-select" name="status" aria-label="Escolha uma opção">
          <option selected></option>
          <option value=""></option>
        </select>
      </div>
      <div class="col-md-1 d-flex justify-content-center align-items-center">
        <button type="submit" class="btn btn-klini-primary text-white">Buscar</button>
      </div>
    </div>
  </form>

  <div class="row">
    <div class="col-12">
      <table class="table table-bordered border-klini-primary table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome do Arquivo</th>
            <th scope="col">Administradora</th>
            <th scope="col">Entidade</th>
            <th scope="col">Vigência</th>
            <th scope="col">STATUS</th>
            <th scope="col">Data/Hora</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($logs as $log)
          <tr>
            <th scope="row">{{ $log->id }}</th>
            <td>{{ $log->data_inclusao == '' ? 'EX' . $log->data_exclusao : 'IN' . $log->data_inclusao }}</td>
            <td>{{ $log->nome_empresa }}</td>
            <td>{{ $log->nome_entidade }}</td>
            <td>{{ $log->data }}</td>
            <td>{{ $log->status }}</td>
            <td>{{ $log->timestamp }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>

      {{ $logs->links() }}
    </div>
  </div>
</div>
@endsection
