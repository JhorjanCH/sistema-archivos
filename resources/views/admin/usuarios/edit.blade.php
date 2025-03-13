@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1>Modificación de datos del usuarios</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Llene los datos</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('/admin/usuarios', $usuario->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Cédula</label>
                                    <input type="number" value="{{ $usuario->cedula ?? old('cedula') }}" name="cedula"
                                        id="cedula" class="form-control" placeholder="Ingrese su cédula" required>
                                    <small id="cedulaError" style="color: red; display: none;">La cédula no puede comenzar
                                        con 0 y debe tener máximo 8 dígitos</small>
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
                                    <label for="rol">Rol</label>
                                    <select name="rol" class="form-control" required>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}"
                                                {{ $usuario->rol == $role->name ? 'selected' : '' }}>{{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('rol')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nombre del usuario</label>
                                    <input type="text" value="{{ $usuario->nombre }}" name="nombre" class="form-control"
                                        required>
                                    @error('nombre')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Apellido del usuario</label>
                                    <input type="text" value="{{ $usuario->apellido }}" name="apellido"
                                        class="form-control" required>
                                    @error('nombre')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="">Email</label>
                              <input type="email" value="{{$usuario->email}}" name="email" class="form-control" required>
                              @error('email')
                              <small style="color: red">{{$message}}</small>
                              @enderror
                            </div>
                          </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Contraseña</label>
                                    <input type="password" name="password" class="form-control">
                                    @error('password')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Repetir Contraseña</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ url('admin/usuarios') }}" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-success"><i class="bi bi-pencil-square"></i>
                                    Actualizar
                                    registro</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
