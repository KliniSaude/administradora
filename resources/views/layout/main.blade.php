<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Klini Saúde</title>

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="https://www.klinisaude.com.br/assets/img/favicon.ico" />

    <!-- Css -->
    <link rel="stylesheet" href="https://use.typekit.net/akv5lji.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    @hasSection ('content')
        @include('layout.menu')
    @endif

    @yield('content')
    @yield('login')

    @hasSection ('content')
    <footer>
        <div class="container py-3">
            <img src="{{ asset('storage/img/logos/klini-saude.png') }}" alt="Klini Saúde">
        </div>
    </footer>
    @endif


    <script src="https://kit.fontawesome.com/0d061613ad.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>

    @include('administradora.includes.delete-dependent')
</body>

</html>
