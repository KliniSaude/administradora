@extends('layout.main')
@section('content')
<div class="container vh-100">
  @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger bg-danger text-white alert-dismissible fade show" role="alert">
      {{ $error }}
      <button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endforeach
  @endif

  @if (session()->has('message'))
  <div class="alert alert-success alert-dismissible bg-success text-white fade show" role="alert">
    <strong>{{ session()->get('message') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  <table class="table align-middle table-striped caption-top table-responsive">
    <caption>Lista de usuário de ADMINISTRADORA</caption>
    <thead>
      <tr>
        <th>#ID</th>
        <td>Nome</td>
        <td>Email</td>
        <td>Administradora</td>
        <td>Status</td>
        <td>Editar/Deletar</td>
      </tr>
    </thead>
    <tbody>
      @foreach ($usersAdministrators as $userAdministrators)
      <tr>
        <th>{{ $userAdministrators->id }}</th>
        <td>{{ $userAdministrators->name }}</td>
        <td>{{ $userAdministrators->email }}</td>
        <td>{{ $userAdministrators->nome_empresa }}</td>
        <td>{{ $userAdministrators->status == 1 ? 'Ativo' : 'Inativo' }}</td>
        <td class="d-flex align-items-center">
          <a class="btn btn-klini-primary text-white" href="{{ route('operadora.users.edit', ['id' => $userAdministrators->id]) }}"
            role="button"><i class="fas fa-edit"></i></a>
          <form action="{{ route('operadora.users.delete', ['id' => $userAdministrators->id]) }}" method="post" class="mx-1">
            @csrf
            {{ method_field('DELETE') }}
            <button type="submit" class="btn bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $usersAdministrators->links() }}
</div>
@endsection
