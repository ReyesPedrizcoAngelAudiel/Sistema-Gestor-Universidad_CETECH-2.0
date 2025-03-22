<!DOCTYPE html>
<head>
    <title>Login | CETECH XD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="">
    <script src="https://kit.fontawesome.com/ee9903c79f.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container is-fluid">
        <div class="columns is-centered is-vcentered">
            <div class="column is-4">
                <div class="box">
                    <!--Imagen a centrar-->
                    <figure class="image is-128x128" style="margin: 0 auto;">
                        <img src="imagenes/ITSJR.png">
                    </figure>
                    <br>
                    <h1 class="title is-4">Sistema Integral de Información</h1>
                    <!--Correo Institucional-->
                    <div class="field">
                        <label class="label">Correo Institucional</label>
                        <div class="control has-icons-left">
                            <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" class="input is-rounded" placeholder="e.g. ejemplo1234@sjuanrio.com">
                        </div>
                    </div>
                    <!--Contraseña-->
                    <div class="field">
                        <label class="label">Contraseña</label>
                        <div class="control has-icons-left">
                            <span class="icon is-small is-left">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" class="input is-rounded" placeholder="***************">
                        </div>
                    </div>
                    <!--Boton-->
                    <div class="has-text-centered">
                        <a class="button is-primary is-rounded" href = "{{route('home')}}">Iniciar sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>