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
        </div>
    </div>
</body>
</html>