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
        <tr class="table-success">
          <th scope="row">
            <a href="ver-propostas.php" target="_blank" rel="noopener noreferrer">proposta20210927</a>
          </th>
          <td>SUSEP</td>
          <td>01</td>
          <td><i class="fas fa-check-circle text-success"></i> APROVADO</td>
        </tr>
        <tr class="table-warning">
          <th scope="row"><a href="ver-propostas.php" target="_blank" rel="noopener noreferrer">proposta20210926</a></th>
          <td>SUSEP</td>
          <td>10</td>
          <td><i class="fas fa-exclamation-triangle text-warning"></i> CORREÇÃO</td>
        </tr>
        <tr>
          <th scope="row"><a href="ver-propostas.php" target="_blank" rel="noopener noreferrer">proposta20210817</a></th>
          <td>SUSEP</td>
          <td>10</td>
          <td><i class="fas fa-eye text-black-50"></i> EM ANALISE</td>
        </tr>
      </tbody>
    </table>
    <nav aria-label="..." class="d-flex justify-content-center align-items-center">
      <ul class="pagination pagination-sm">
        <li class="page-item active" aria-current="page">
          <span class="page-link">1</span>
        </li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
      </ul>
    </nav>
  </div>
</div>
@endsection
