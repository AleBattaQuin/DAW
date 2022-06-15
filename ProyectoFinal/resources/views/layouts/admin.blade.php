<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!--Metas-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mountain Route') }}</title>

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Neonderthaw&family=Noto+Sans+TC&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>

<body>
<div class="container-fluid">
    <nav>
        <!-- HEADER ---------------------------------------------------------------------------------------------------------------------------------------------->

        <div class="row justify-content-center">
            <div class="col" style="background-color: #FEFAE0;"></div>
            <!--LOGO-->
            <div class="col align-self-center">
                <a href="{{ route('home') }}" style="background-color: #FEFAE0;"><img src="{{ asset('img/logo.png') }}" alt="logo" width="400px" class="mx-auto d-block"></a>
            </div>

        <div class="col" style="background-color: #FEFAE0;"></div>
            <br>
            <!--MENU DE NAVEGACION-->
            <div>
                @if( Auth::check() )
                <ul class="nav justify-content-center" id="bordes">

                    <li class="nav-item" id="boton">
                        <a class="nav-link" id="boton" aria-current="page" href="{{ route('admin') }}">INICIO</a>
                    </li>
                    @if( Auth::user()->rutas )
                    <li class="nav-item">
                        <a class="nav-link" id="boton" href="{{ url('admin/rutas') }}">RUTAS</a>
                    </li>
                    @endif
                        @if( Auth::user()->noticias )
                    <li class="nav-item">
                        <a class="nav-link" id="boton" href="{{ url('admin/noticias') }}">NOTICIAS</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" id="boton" href="{{ url('admin/usuarios') }}">USUARIOS</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('salir') }}">
                            @csrf
                            <a onclick="$(this).closest('form').submit()" class="nav-link" title="Salir" id="boton">
                                SALIR
                            </a>
                        </form>
                    </li>

                </ul>
@endif
                <br><br>

            </div>

        </div>
    </nav>

    <!--Menú de navegación móvil-->

    <main>


        <section class="container-fluid">

            <!--Content-->
        @yield('content')

        <!--Footer-->
        </section>
    </main>

    <footer class="row align-items-end">
        <!--FOOTER------------------------------------------------>

        <div class="row borde" id="fondo">

            <div class="col al">
                <br><br>

                <a href="https://twitter.com/batta612" target="_blank">
                    <img src="{{ asset('img/Twitter-logo.svg.png') }}" alt="logo-twitter" width="60px">
                </a>
                <br>
                <a href="https://www.instagram.com/mountain__route_/?hl=es"  target="_blank">
                    <img src="{{ asset('img/logo-insta.png') }}" alt="logo-instagram" width="60px">
                </a>
                <br>
            </div>

            <div class="col nos">
                <br><br>
                <p class="center">Politica de Privacidad</p>
                <br>
                <p class="center">Politica de Privacidad</p>

            </div>


        </div>


    </footer>
</div>

</body>

<!--Scripts-->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="{{ asset('js/admin.js') }}" defer></script>

</html>
