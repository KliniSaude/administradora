<header>
    <div class="container py-3">
        <div class="d-flex justify-content-between align-items-center">
            <a class="text-decoration-none text-dark" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                aria-controls="offcanvasExample" style="color: #000">
                <i class="fas fa-bars fs-3"></i>
            </a>
            <img src="{{ url('storage/img/logos/klini-saude.png') }}" alt="Klini Saúde">
        </div>


        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header justify-content-around">
                <!-- <span><i class="fas fa-user fs-3"></i></span> -->
                <img class="rounded-circle" src="{{ $user->profile_photo != NULL ? asset($user->profile_photo) : asset('storage/img/logos/perfil-female.png') }}"
                    alt="Profile User" width="60px">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel"> {{ $user->name }} <br>
                    <small class="text-uppercase text-muted fw-light" style="font-size: 12px;"> {{ $user->user_type == 0 ? 'administradora' : 'operadora' }}</small>
                </h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-secondary text-uppercase active" aria-current="page"
                            href="{{ $user->user_type == 0 ? route('admin.dashboard') : route('operadora.dashboard') }}">Ver
                            Propostas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-secondary text-uppercase"
                            href="{{ route('admin.create.proposta') }}">Nova
                            Proposta</a>
                    </li>
                    {{-- <li class="nav-item">
                      <a class="nav-link fw-bold text-secondary text-uppercase"
                          href="http://localhost:8080/views/administradora/cadastrar-proposta.php">Editar
                          Proposta</a>
                  </li> --}}
                    <hr>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-secondary text-uppercase"
                            href="{{ route('admin.user') }}">Meu Usuário</a>
                    </li>
                    @if ($user->user_type == 1)
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-secondary text-uppercase"
                            href="{{ route('operadora.users.all') }}">Ver Usuários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-secondary text-uppercase"
                            href="{{ route('operadora.users.create') }}">Criar Usuários</a>
                    </li>
                    @endif
                    <hr>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-secondary text-uppercase" href="{{ route('admin.log') }}">Log de
                            movimentação</a>
                    </li>
                    <hr>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-secondary text-uppercase"
                            href="{{ route('admin.logout') }}">Sair</a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</header>
