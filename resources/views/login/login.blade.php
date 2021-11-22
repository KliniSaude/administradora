@extends('layout.main')

@section('login')
  <div class="main_login">
    <div class="container">
    <div class="row justify-content-evenly align-items-center vh-100">
      <div class="col-6 d-none d-lg-block main_login_background"></div>
      <div class="col-12 col-lg-3 text-center">
          <img src="{{ asset('storage/img/logos/klini-saude.png') }}" alt="Klini Sáude" class="img-fluid mb-3">
          <form action="{{ route('admin.login.do') }}" method="POST">
            @csrf
            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="floatingInput" name="email" value="moises.fausto@klinisaude.com.br" placeholder="nome@example.com.br">
              <label for="floatingInput">E-mail</label>
            </div>
            <div class="form-floating mb-3">
              <input type="password" class="form-control" id="floatingPassword" name="password" value="21831440" placeholder="******">
              <label for="floatingPassword">Senha</label>
            </div>
            @if ($errors->all())
                @foreach ($errors->all() as $error)
                  <div class="alert bg-danger text-white" role="alert">
                    {{$error}}
                  </div>
                @endforeach
            @endif
            <button type="submit" class="btn btn-lg btn-klini-primary text-white w-100">Entrar</button>
          </form>
      </div>
    </div>
    </div>
  </div>
@endsection
