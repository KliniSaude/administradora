@extends('layout.main')
@section('content')
<div class="container vh-100">
  <form action="{{ route('operadora.users.store') }}" method="POST" enctype="multipart/form-data" class="row justify-content-center g-3">
    @csrf
    <input type="hidden" name="user_type" value="1">
    <input type="hidden" name="status" value="1">
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

    <div class="col-4">
      <div class="col-12 mb-5">
        <div class="d-flex flex-column justify-content-center align-items-center">
          <img src="{{ asset('storage/img/logos/perfil-female.png') }}" style="width: 210px;">
        </div>
      </div>
      <div class="col-12 mb-4">
        <input type="text" name="name" class="form-control" id="name" placeholder="Nome" required>
      </div>
      <div class="col-12 mb-4">
        <div class="form-floating">
          <select class="form-select" id="fk_administradora" name="fk_administradora" aria-label="Admnistradora" required>
            <option selected>Selecione a administradora</option>
            @foreach ($administrators as $administrator)
            <option value="{{ $administrator->id }}">{{ $administrator->cnpj }} - {{ $administrator->nome_empresa }}</option>
            @endforeach
          </select>
          <label for="nome_administradora">Admnistradora</label>
        </div>
      </div>
      <div class="col-12 mb-4">
        <input type="email" name="email" class="form-control" id="email" placeholder="E-mail" required >
      </div>
      <div class="col-12 mb-4">
        <input type="password" name="password" class="form-control" id="password" placeholder="Senha" required >
      </div>
      <div class="input-group col-12 mb-4">
        <label class="input-group-text" for="profile"><i class="fas fa-user-circle"></i></label>
        <input type="file" class="form-control" name="profile_photo" id="profile" accept="image/png, image/jpeg">
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-klini-primary text-light">Cadastrar</button>
      </div>
    </div>
  </form>
</div>
@endsection
