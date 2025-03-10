@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1 class="col-12 text-center">Listado de usuarios</h1>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header d-flex align-items-center">
                    <h3 class="card-title col-6">Datos registrados</h3>
                    <div class="card-tools col-6 d-flex justify-content-end">
                        <a href="{{ url('/admin/usuarios/create') }}" class="btn btn-primary">
                            <i class="bi bi-person-fill-add"></i> Nuevo usuario
                        </a>
                    </div>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered table-sm table-striped table-hover">
                        <thead>
                            <tr>
                                <th>
                                    <center>Nro</center>
                                </th>
                                <th>
                                    <center>Nombre</center>
                                </th>
                                <th>
                                    <center>Rol</center>
                                </th>
                                <th>
                                    <center>Email</center>
                                </th>
                                <th>
                                    <center>Carpetas</center>
                                </th>
                                <th>
                                    <center>Acciones</center>
                                </th>
                            </tr>
                        </thead>

                        <tbody style="height: 50px;">
                            @php
                                $contador = 0;
                                $limite = 5; // Número de usuarios por página
                                $pagina = request()->get('page', 1); // Página actual, por defecto 1
                                $tareasTotales = $usuarios->count();
                                $cantidadPaginas = ceil($tareasTotales / $limite);
                                $items = $usuarios->forPage($pagina, $limite);
                            @endphp

                            @foreach ($items as $usuario)
                                @php
                                    $contador++;
                                    $id = $usuario->id;
                                @endphp
                                <tr>
                                    <td class="text-center align-middle">{{ $contador }}</td>
                                    <td class="text-center align-middle">{{ $usuario->nombre . ' ' . $usuario->apellido }}
                                    </td>
                                    <td class="text-center align-middle">{{ $usuario->rol }}</td>
                                    <td class="text-center align-middle">{{ $usuario->email }}</td>
                                    <td class="text-center align-middle">
                                        @if ($usuario->carpetas->where('borrado', false)->isNotEmpty())
    <select class="form-control" name="carpetas" id="carpetas"
        onchange="location = this.value;">
        <option value="">Selecciona una carpeta</option>
        @foreach ($usuario->carpetas->where('borrado', false) as $carpeta)
            <option
                class="text-dark"
                value="{{ url('/admin/mi_unidad/carpeta', $carpeta->id) }}">
                {{ $carpeta->nombre }}
            </option>
        @endforeach
    </select>
@else
    <span>No hay carpetas creadas</span>
@endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-info">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-success">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="post"
                                                id="miFormulario{{ $id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    style="border-top-left-radius: 0; border-bottom-left-radius: 0;"
                                                    onclick="preguntar{{ $id }}(event)">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                            <script>
                                                function preguntar{{ $id }}(event) {
                                                    event.preventDefault();
                                                    Swal.fire({
                                                        title: 'Eliminar usuario',
                                                        text: '¿Desea eliminar este usuario?',
                                                        icon: 'question',
                                                        showDenyButton: true,
                                                        confirmButtonText: 'Eliminar',
                                                        confirmButtonColor: '#a5161d',
                                                        denyButtonColor: '#270a0a',
                                                        denyButtonText: 'Cancelar',
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            var form = document.getElementById('miFormulario{{ $id }}');
                                                            form.submit();
                                                        }
                                                    });
                                                }
                                            </script>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="mt-3">
                            Página: {{ $pagina }} / {{ $cantidadPaginas }}
                        </div>


                        <ul class="pagination">
                            @for ($i = 1; $i <= $cantidadPaginas; $i++)
                                <li class="page-item {{ $pagina == $i ? 'active' : '' }}">
                                    <a class="page-link"
                                        href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">{{ $i }}</a>
                                </li>
                            @endfor
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="row">
    <h1 class="col-12 text-center">Restaurar carpetas</h1>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-success">

            <div class="card-body table-responsive">
                <table class="table table-bordered table-sm table-striped table-hover">
                    <thead>
                        <tr>
                            <th>
                                <center>Nro</center>
                            </th>
                            <th>
                                <center>Nombre</center>
                            </th>
                            <th>
                                <center>Carpetas Eliminadas</center>
                            </th>
                        </tr>
                    </thead>

                    <tbody style="height: 50px;">
                        @php
                            $contador = 0;
                            $limite = 5; // Número de usuarios por página
                            $pagina = request()->get('page', 1); // Página actual, por defecto 1
                            $tareasTotales = $usuarios->count();
                            $cantidadPaginas = ceil($tareasTotales / $limite);
                            $items = $usuarios->forPage($pagina, $limite);
                        @endphp

                        @foreach ($items as $usuario)
                            @php
                                $contador++;
                                $id = $usuario->id;
                            @endphp
                            <tr>
                                <td class="text-center align-middle">{{ $contador }}</td>
                                <td class="text-center align-middle">{{ $usuario->nombre . ' ' . $usuario->apellido }}
                                </td>
                                <td class="text-center align-middle">
                                    @if ($usuario->carpetas->where('borrado', true)->isNotEmpty())
                                        <select class="form-control" name="carpetas" id="carpetas"
                                            onchange="handleCarpetaSelection(this.value)">
                                            <option value="">Selecciona una carpeta eliminada</option>
                                            @foreach ($usuario->carpetas->where('borrado', true) as $carpeta)
                                                <option value="{{ $carpeta->id }}">
                                                    {{ $carpeta->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @else
                                        <span>No hay carpetas eliminadas</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex flex-column align-items-center justify-content-center">
                    <div class="mt-3">
                        Página: {{ $pagina }} / {{ $cantidadPaginas }}
                    </div>

                    <ul class="pagination">
                        @for ($i = 1; $i <= $cantidadPaginas; $i++)
                            <li class="page-item {{ $pagina == $i ? 'active' : '' }}">
                                <a class="page-link"
                                    href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">{{ $i }}</a>
                            </li>
                        @endfor
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function handleCarpetaSelection(value) {
        if (!value) return;

        Swal.fire({
            title: '¿Qué tipo de restauración deseas?',
            text: 'Selecciona una opción:',
            icon: 'question',
            showDenyButton: true,
            confirmButtonText: 'Carpeta',
            denyButtonText: 'Subcarpeta',
        }).then((result) => {
            if (result.isConfirmed) {
                // Restaurar carpeta
                window.location.href = `/admin/mi_unidad/restaurar_carpeta/${value}`;
            } else if (result.isDenied) {
                // Restaurar subcarpeta
                window.location.href = `/admin/mi_unidad/restaurar_subcarpeta/${value}`;
            }
        });
    }
</script>



@endsection
