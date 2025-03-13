@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <h1 class="col-12 text-center">Nuevo usuario</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Llene los datos</h3>
                </div>
                <div class="card-body ">
                    <form action="{{ url('/admin/usuarios') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Cédula</label>
                                    <input type="number" value="{{ old('cedula') }}" name="cedula" id="cedula"
                                        class="form-control" placeholder="Ingrese su cédula" required>
                                    <small id="cedulaError" style="color: red; display: none;">La cédula debe
                                        no puede comenzar con 0 max 8 digitos</small>
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
                                    <input type="email" value="{{ old('email') }}" name="email" class="form-control"
                                        placeholder="Ingrese su correo" required>
                                    @error('email')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" value="{{ old('nombre') }}" name="nombre" class="form-control"
                                        placeholder="Ingrese su nombre" id="nombre" required>
                                    @error('nombre')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Apellido</label>
                                    <input type="text" value="{{ old('apellido') }}" name="apellido" class="form-control"
                                        placeholder="Ingrese su apellido" required id="apellido">
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
                                <a href="{{ url('admin/usuarios') }}" class="btn btn-secondary w-50 py-2">Cancelar</a>
                                <button type="submit" class="btn btn-primary ml-2 w-50 py-2"><i class="bi bi-floppy2"></i>
                                    Crear</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
