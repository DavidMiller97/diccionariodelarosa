<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div class="preloader-busqueda" id="preloader-busqueda">
        <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>
    <div class="control-libros-autor" id="control-libros">
        <div class="cerrar-controls">
            <img src="{{ asset('assets/images/iconos/cerrar.png') }}" alt="">
        </div>
        <div class="autor"></div>
        <div class="controls">
            <a href="#" id="atras"><</a>
            <a href="#" id="adelante">></a>
        </div>
        <div class="cantidad">
            <p><span id="actual"></span> de <span id="numero-libros"></span></p>
        </div>
    </div>
    <header>
        <div class="contenedor-header">
            <div class="logo">
                <a href="https://www.unam.mx/">
                    <img src="{{ asset('assets/images/iconos/unam.png') }}" alt="UNAM">
                </a>
            </div>
            <nav class="menu">
                <ul>
                    <li>
                        <a href="{{ route('home') }}">Presentación</a>
                    </li>
                    <li>
                        <a href="{{ route('folio.index') }}">Texto</a>
                    </li>
                    <li>
                        <a href="{{ route('credito.index') }}">Créditos</a>
                    </li>
                </ul>
            </nav>
            <div class="hamburguer-contenedor">
                <span class="hamburger-menu" id="hamburger-menu">
                    <span class="line-1"></span>
                    <span class="line-2"></span>
                    <span class="line-3"></span>
                </span>
                <div class="buscador" id="buscador">
                    <img src="{{ asset('assets/images/iconos/buscador.png') }}" alt="">
                </div>
            </div>
        </div>
        <div class="menu-responsive">
            <ul>
                <li>
                    <a href="{{ route('home') }}">Presentación</a>
                </li>
                <li>
                    <a href="{{ route('folio.index') }}">Texto</a>
                </li>
                <li>
                    <a href="{{ route('credito.index') }}">Creditos</a>
                </li>
            </ul>
        </div>
    </header>
    <main class="folio">
        @yield('content')
    </main>
    <footer class="footer">
        <div class="logos">
            <div class="logo-unam">
                <a href="https://www.unam.mx/">
                    <img src="{{ asset('assets/images/iconos/unam2.png') }}" alt="UNAM">
                </a>
            </div>
            <div class="logo-biblio">
                <a href="https://bnm.iib.unam.mx/">
                    <img src="{{ asset('assets/images/iconos/biblioteca.png') }}" alt="">
                </a>
            </div>
        </div>
    </footer>

    @include('includes.modalBusqueda')
</body>
</html>