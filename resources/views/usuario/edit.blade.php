@extends('layout.main')
@section('content')
<div class="container vh-100">
  <form action="{{ route('admin.user.update', ['id' => $users->id]) }}" method="POST" enctype="multipart/form-data" class="row justify-content-center g-3">
    @csrf
    @method('PUT')

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
          <img src="{{ $users->profile_photo != NULL ? asset($users->profile_photo) : asset('storage/img/logos/perfil-female.png') }}" class="rounded-circle" style="width: 300px; height: 300px;">
        </div>
      </div>
      <div class="col-12 mb-4">
        <input type="text" name="name" class="form-control" id="name" placeholder="Nome" value="{{ $users->name }}" readonly>
      </div>
      <div class="col-12 mb-4">
        <input type="text" name="fk_administradora" class="form-control" id="fk_administradora" placeholder="Administradora" value="{{ $administrator->nome_empresa }}" readonly>
      </div>
      <div class="col-12 mb-4">
        <input type="email" name="email" class="form-control" id="email" placeholder="E-mail" value="{{ $users->email }}" readonly>
      </div>
      <div class="col-12 mb-4">
        <input type="password" name="password" class="form-control" id="password_administradora" placeholder="Nova senha" required value="{{ old('password') }}">
      </div>
      <div class="input-group col-12 mb-4">
        <label class="input-group-text" for="profile"><i class="fas fa-user-circle"></i></label>
        <input type="file" class="form-control" name="profile_photo" id="profile" accept="image/png, image/jpeg">
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-klini-primary text-light">Atualizar</button>
      </div>
    </div>
  </form>
</div>
@endsection
