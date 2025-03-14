<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de Archivos</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Animate.css -->
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
</head>
<style>
    @font-face {
        font-family: 'Andalia';
        src: url('{{ asset('font/Andalia.ttf') }}');
    }

    .titulo {
        font-family: 'Andalia';
        font-size: 30pt;
        color: white;
        text-shadow: 0.1em 0.1em 0.5em black;
    }

    .responsiva {
        width: 100%;
    }

    @media (min-width: 576px) {
        .responsiva {
            width: 70%;
        }
    }
</style>

<body class="hold-transition login-page"
    style="background: url('{{ asset('imagenes/fondo.jpg') }}');
      background:no repeat;
      background-size: 100vw 100vh;
      z-index: -3;
      background-attachment: fixed;">

    <div class="responsiva px-1 d-flex flex-column justify-content-center" style="height: 100vh;">
        <div class="login-logo  animated fadeInUp delay-2s">
            <a href="{{ url('/') }}"><b class="titulo">
                    REGISTRO DE USUARIO</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="animated slideInDown delay-1s">
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Ingrese sus datos</p>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ url('/registro') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Cédula</label>
                                            <input type="number" value="{{ old('cedula') }}" name="cedula"
                                                id="cedula" class="form-control" placeholder="Ingrese su cédula"
                                                required>
                                            <small id="cedulaError" style="color: red; display: none;">La cédula no puede 
                                                comenzar con 0 y debe tener máximo 8 dígitos</small>
                                            @error('cedula')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <script>
                                        document.getElementById('cedula').addEventListener('input', function(e) {
                                            var cedula = e.target.value;
                                            var cedulaError = document.getElementById('cedulaError');

                                            if (cedula.length > 0 && cedula.charAt(0) === '0') {
                                                e.target.value = '';
                                                cedulaError.style.display = 'block';
                                            } else if (cedula.length > 8) {
                                                e.target.value = cedula.substring(0, 8);
                                                cedulaError.style.display = 'block';
                                            } else {
                                                cedulaError.style.display = 'none';
                                            }
                                        });
                                    </script>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" value="{{ old('email') }}" name="email"
                                                class="form-control" placeholder="Ingrese su correo" required>
                                            @error('email')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nombre</label>
                                            <input type="text" value="{{ old('nombre') }}" name="nombre"
                                                class="form-control" placeholder="Ingrese su nombre" id="nombre"
                                                required>
                                            @error('nombre')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Apellido</label>
                                            <input type="text" value="{{ old('apellido') }}" name="apellido"
                                                class="form-control" placeholder="Ingrese su apellido" id="apellido"
                                                required>
                                            @error('apellido')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <script>
                                        document.getElementById('nombre').addEventListener('input', function(e) {
                                            e.target.value = e.target.value.split(' ').map(function(word) {
                                                return word.charAt(0).toUpperCase() + word.slice(1);
                                            }).join(' ');
                                        });

                                        document.getElementById('apellido').addEventListener('input', function(e) {
                                            e.target.value = e.target.value.split(' ').map(function(word) {
                                                return word.charAt(0).toUpperCase() + word.slice(1);
                                            }).join(' ');
                                        });
                                    </script>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Contraseña</label>
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Ingrese su contraseña " required>
                                            @error('password')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Repetir Contraseña</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                placeholder="Repetir contraseña" required>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-center">
                                        <a href="{{ url('admin/usuarios') }}"
                                            class="btn btn-secondary w-50 py-2">Cancelar</a>
                                        <button type="submit" class="btn btn-primary ml-2 w-50 py-2"><i
                                                class="bi bi-floppy2"></i>
                                            Crear</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>

</html>
