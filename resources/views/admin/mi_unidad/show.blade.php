@extends('layouts.admin')

@section('content')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{$carpeta->nombre}}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="float-sm-right">
                <!-- Button trigger modal -->
                <a href="{{url('/admin/mi_unidad')}}" class="btn btn-default"><i class="bi bi-arrow-bar-left"></i> Volver</a>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal_cargar_archivos">
                    <i><i class="bi bi-cloud-upload"></i></i> Subir archivos
                </button>

                <!-- Modal para subir archivos -->
                <div class="modal fade" id="modal_cargar_archivos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Subir archivos</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{url('/admin/mi_unidad/carpeta')}}" method="post" class="dropzone" id="myDropzone" enctype="multipart/form-data ">
                                    @csrf
                            <div class="modal-body">
                                    <input type="text" value="{{$carpeta->id}}" name="id" hidden>
                                    <div class="fallback">
                                        <input type="file" name="file" multiple />
                                    </div>
                            </div>
                            <!-- <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Crear</button>
                            </div> -->
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                    Dropzone.options.myDropzone = {
                        paramName: "file",
                        dictDefaultMessage:"Arrastra y suelte los archivos aqui o de click para selecionar los archivos"
                    };
                </script>

                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
                    <i><i class="bi bi-folder-plus"></i></i> Nueva carpeta
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nombre de la carpeta</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{url('/admin/mi_unidad/carpeta')}}" method="get">
                                @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" value="{{$carpeta->id}}" name="carpeta_padre_id" hidden>
                                            <input type="text" class="form-control" name="nombre" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Crear</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </ol>
        </div><!-- /.col -->
    </div>
    <hr>
        <h5>Carpetas y archivos</h5>
    <hr>
    <div class="row">
       @foreach($subcarpetas as $subcarpeta)
        <div class="col-md-3">
                    <div class="divcontent">
                        <div class="row" style="padding: 10px">
                            <div class="col-2" style="text-align: center">
                                <i class="bi bi-folder-fill" style="font-size: 20pt;color: {{$subcarpeta->color}}"></i>
                            </div>
                            <div class="col-8" style="margin-top: 7px">
                                <a href="{{url('/admin/mi_unidad/carpeta',$subcarpeta->id)}}" style="color: black">
                                    {{$subcarpeta->nombre}}
                                </a>
                            </div>
                            <div class="col-2" style="margin-top: 7px" style="text-align: right">
                                <div class="btn-group" role="group">
                                    <button class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Modal_cambiar_nombre{{$subcarpeta->id}}"><i class="bi bi-pencil"></i> Cambiar nombre
                                    </a>
                                    <a class="dropdown-item" href="#"><i class="bi bi-front"></i> Color de la carpeta
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                    <form action="{{url('/admin/mi_unidad/carpeta')}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="text" value="blue" name="color" hidden>
                                            <input type="text" value="{{$subcarpeta->id}}" name="id" hidden>
                                            <button type="submit" style="background-color: white;border: 0px">
                                                <i class="bi bi-circle-fill" style="color: blue"></i>
                                            </button>
                                        </form>
                                        <form action="{{url('/admin/mi_unidad/carpeta')}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="text" value="red" name="color" hidden>
                                            <input type="text" value="{{$subcarpeta->id}}" name="id" hidden>
                                            <button type="submit" style="background-color: white;border: 0px">
                                                <i class="bi bi-circle-fill" style="color: red"></i>
                                            </button>
                                        </form>
                                        <form action="{{url('/admin/mi_unidad/carpeta')}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="text" value="green" name="color" hidden>
                                            <input type="text" value="{{$subcarpeta->id}}" name="id" hidden>
                                            <button type="submit" style="background-color: white;border: 0px">
                                                <i class="bi bi-circle-fill" style="color: green"></i>
                                            </button>
                                        </form>
                                        <form action="{{url('/admin/mi_unidad/carpeta')}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="text" value="darkorange" name="color" hidden>
                                            <input type="text" value="{{$subcarpeta->id}}" name="id" hidden>
                                            <button type="submit" style="background-color: white;border: 0px">
                                                <i class="bi bi-circle-fill" style="color: darkorange"></i>
                                            </button>
                                        </form>
                                        <form action="{{url('/admin/mi_unidad/carpeta')}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="text" value="black" name="color" hidden>
                                            <input type="text" value="{{$subcarpeta->id}}" name="id" hidden>
                                            <button type="submit" style="background-color: white;border: 0px">
                                                <i class="bi bi-circle-fill" style="color: black"></i>
                                            </button>
                                        </form>
                                    </div>
                                    </a>
                                    <a class="dropdown-item" href="#"><i class="bi bi-trash"></i> Eliminar</a>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal cambiar nombre carpetas-->
            <div class="modal fade" id="Modal_cambiar_nombre{{$subcarpeta->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cambiar nombre</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form action="{{url('/admin/mi_unidad/carpeta')}}" method="post">
                        @csrf
                        @method('PUT')
                            <input type="text" value="{{$subcarpeta->id}}" name="id" hidden>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" value="{{$subcarpeta->nombre}}" class="form-control" name="nombre" required>                                        </div>
                                    </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach 
    </div>

    <hr>

    @foreach($archivos as $archivo)
        <li>{{$archivo->nombre}}</li>
    @endforeach    

@endsection