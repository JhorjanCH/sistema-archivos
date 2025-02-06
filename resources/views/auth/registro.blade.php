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
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- Animate.css -->
  <link rel="stylesheet" href="{{asset('css/animate.css')}}">
</head>
<style>
@font-face {
  font-family: 'Andalia';
  src:url('{{asset('font/Andalia.ttf')}}');
}

.titulo {
  font-family: 'Andalia';
  font-size: 30pt;
  color: white;
  text-shadow: 0.1em 0.1em 0.5em black;
}
</style>

<body class="hold-transition login-page" style="background: url('{{asset('imagenes/fondo.jpg')}}');
      background:no repeat;
      background-size: 100vw 100vh;
      z-index: -3;
      background-attachment: fixed">
  <div class="login-box">
    <div class="login-logo  animated fadeInUp delay-2s">
      <a href="{{url('/')}}"><b class="titulo">
          REGISTRO DE USUARIO</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="animated slideInDown delay-1s">
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Ingrese sus datos</p>

          <div class="row">
            <div class="col-md-12">
              <form action="{{url('/registro')}}" method="post">
                @csrf
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Nombre del usuario</label>
                      <input type="text" value="{{old('name')}}" name="name" class="form-control" required>
                      @error('name')
                      <small style="color: red">{{$message}}</small>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Email</label>
                      <input type="email" value="{{old('email')}}" name="email" class="form-control" required>
                      @error('email')
                      <small style="color: red">{{$message}}</small>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Password</label>
                      <input type="password" name="password" class="form-control" required>
                      @error('password')
                      <small style="color: red">{{$message}}</small>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Repetir Password</label>
                      <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-12">
                    <a href="{{url('admin/usuarios')}}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-floppy2"></i> Guardar
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
  <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
</body>

</html>