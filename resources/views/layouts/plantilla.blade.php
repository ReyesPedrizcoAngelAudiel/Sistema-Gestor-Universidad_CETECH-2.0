<!DOCTYPE html>
<html lang="es">

<head>
    <!--Imagen de ICONO-->
    <link rel="shortcut icon" href="/imagenes/tecnm.ico">
    <title>CETECH 2.0</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="/CSS/estilo-loggin.css">

    <script src="https://kit.fontawesome.com/ee9903c79f.js" crossorigin="anonymous"></script>
    <script src="/js/main.js"></script>
</head>

<body>

    <nav class="navbar is-dark" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="https://bulma.io">
                <img src="/imagenes/TecNM_logo.png" width="135" height="auto">
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false"
                data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item">
                    Casa
                </a>

                <a class="navbar-item">
                    Documentación
                </a>

                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        Más
                    </a>

                    <div class="navbar-dropdown">
                        <a class="navbar-item">
                            Acerca de
                        </a>
                        <a class="navbar-item">
                            Trabajo
                        </a>
                        <a class="navbar-item">
                            Contactanos
                        </a>
                        <hr class="navbar-divider">
                        <a class="navbar-item">
                            Reporta un problema
                        </a>
                    </div>
                </div>
            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <a class="navbar-link">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="buttons">
                        <form id="logout - form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                            <button class="button is-danger" type="submit">
                                <strong>Cerrar session</strong>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container is-fluid">
        @yield('content')
    </div>
</body>

</html>
