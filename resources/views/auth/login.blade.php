<!DOCTYPE html>
<head>
    <title>Login | CETECH</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="">
    <script src="https://kit.fontawesome.com/ee9903c79f.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container is-fluid">
        <div class="columns is-centered is-vcentered">
            <div class="column is-4">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
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
                                <input value="{{ old('email') }}" type="email" name='email' class="input is-rounded" placeholder="e.g. ejemplo1234@sjuanrio.com">
                            </div>
                        </div>
                            @error('email')
                                <p class="help is-danger">{{$message}}</p>
                            @enderror
                        <!--Contraseña-->
                        <div class="field">
                            <label class="label">Contraseña</label>
                            <div class="control has-icons-left">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" name='password' class="input is-rounded" placeholder="***************">
                            </div>
                        </div>
                            @error('password')
                                <p class="help is-danger">{{$message}}</p>
                            @enderror
                        <!--Boton-->
                        <div class="has-text-centered">
                            <button class="button is-primary is-rounded" type="submit">Iniciar sesión</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="column is-5">
                <div class="box has-background-light p-5" 
                    style="border-radius: 12px; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);">
                    <h1 class="title is-3 has-text-centered has-text-info">Bienvenido</h1>
                    <h2 class="subtitle is-4 has-text-centered has-text-grey-dark">Roles y accesos</h2>
                    <div class="content">
                        <ul style="list-style: none; padding-left: 0;">
                            <li class="mb-3">
                                <span class="has-text-weight-bold has-text-danger">Administrador de Escolares:</span><br>
                                <span class="has-text-grey-dark">📧 escolares@sjuanrio.tecnm.mx | 🔑 12345678</span>
                            </li>
                            <li class="mb-3">
                                <span class="has-text-weight-bold has-text-danger">División de Estudios Profesionales:</span><br>
                                <span class="has-text-grey-dark">📧 div_estudios@sjuanrio.tecnm.mx | 🔑 12345678</span>
                            </li>
                            <li class="mb-3">
                                <span class="has-text-weight-bold has-text-danger">Profesores:</span><br>
                                <span class="has-text-grey-dark">📧 axel@docente.com | 🔑 Tecsj+011212</span><br><br>
                                <p class="has-text-grey">
                                    📌 <span class="has-text-weight-semibold">Nota:</span> Si agregas un nuevo profesor, su contraseña será: 
                                    <span class="has-text-weight-bold has-text-info">Tecsj+"Primeros 6 dígitos de su fecha de nacimiento (según CURP)"</span>.
                                </p>
                            </li>
                            <li class="mb-3">
                                <span class="has-text-weight-bold has-text-danger">Alumnos:</span><br>
                                <span class="has-text-grey-dark">📧 l20590172@sjuanrio.tecnm.mx | 🔑 Tecsj+011212</span><br><br>
                                <p class="has-text-grey">
                                    📌 <span class="has-text-weight-semibold">Nota:</span> Si agregas un nuevo alumno, toma en cuenta lo siguiente:
                                    <ul class="mt-1 ml-6" style="list-style: disc;">
                                        <li>📧 Su email será: <span class="has-text-weight-bold has-text-info">l + número de control + @sjuanrio.tecnm.mx</span></li>
                                        <li>🔑 Su contraseña será: <span class="has-text-weight-bold has-text-info">Tecsj+"Primeros 6 dígitos de su fecha de nacimiento (según CURP)"</span></li>
                                    </ul>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>