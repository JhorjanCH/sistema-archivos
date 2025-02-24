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
</style>

<body class="hold-transition login-page"
    style="background: url('{{ asset('imagenes/fondo.jpg') }}');
      background:no repeat;
      background-size: 100vw 100vh;
      z-index: -3;
      background-attachment: fixed">
    <div class="w-50 d-flex flex-column justify-content-center" style="height: 100vh">
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
                                            <input type="text" value="{{ old('cedula') }}" name="cedula"
                                                class="form-control" placeholder="Ingrese su cédula" required>
                                            @error('cedula')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
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
                                                class="form-control" placeholder="Ingrese su nombre" required>
                                            @error('nombre')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Apellido</label>
                                            <input type="text" value="{{ old('apellido') }}" name="apellido"
                                                class="form-control" placeholder="Ingrese su apellido" required>
                                            @error('apellido')
                                                <small style="color: red">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
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
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <a href="{{ url('admin/usuarios') }}"
                                            class="btn btn-secondary w-25">Cancelar</a>
                                        <button type="submit" class="btn btn-primary ml-2 w-25"><i
                                                class="bi bi-floppy2"></i>
                                            Guardar
                                            registro</button>
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
