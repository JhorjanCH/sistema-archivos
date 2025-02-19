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
      <a href="{{url('/admin/mi_unidad')}}" class="btn btn-default"><i class="bi bi-arrow-bar-left"></i>
        Volver</a>
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal_cargar_archivos">
        <i><i class="bi bi-cloud-upload"></i></i> Subir archivos
      </button>

      <!-- Modal para subir archivos -->
      <div class="modal fade" id="modal_cargar_archivos" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Subir archivos</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="recargarPagina()">
                <span aria-hidden="true">&times;</span>
              </button>
              
              <script>
                function recargarPagina() {
                  location.reload();
                }
              </script>
            </div>
            <form action="{{url('/admin/mi_unidad/carpeta/upload')}}" method="post" class="dropzone" id="myDropzone"
              enctype="multipart/form-data ">
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
        dictDefaultMessage: "Arrastra y suelte los archivos aqui o de click para selecionar los archivos"
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
                      <input type="text" value="{{Auth::user()->id}}" name="user_id" hidden>
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
              <a class="dropdown-item" href="#" data-toggle="modal"
                data-target="#Modal_cambiar_nombre{{$subcarpeta->id}}"><i class="bi bi-pencil"></i>
                Cambiar nombre
              </a>
              <a class="dropdown-item" href="#"><i class="bi bi-front"></i> Color de la carpeta
                <div class="btn-group" role="group" aria-label="Basic example">
                  <form action="{{url('/admin/mi_unidad/color')}}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="text" value="blue" name="color" hidden>
                    <input type="text" value="{{$subcarpeta->id}}" name="id" hidden>
                    <button type="submit" style="background-color: white;border: 0px">
                      <i class="bi bi-circle-fill" style="color: blue"></i>
                    </button>
                  </form>
                  <form action="{{url('/admin/mi_unidad/color')}}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="text" value="red" name="color" hidden>
                    <input type="text" value="{{$subcarpeta->id}}" name="id" hidden>
                    <button type="submit" style="background-color: white;border: 0px">
                      <i class="bi bi-circle-fill" style="color: red"></i>
                    </button>
                  </form>
                  <form action="{{url('/admin/mi_unidad/color')}}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="text" value="green" name="color" hidden>
                    <input type="text" value="{{$subcarpeta->id}}" name="id" hidden>
                    <button type="submit" style="background-color: white;border: 0px">
                      <i class="bi bi-circle-fill" style="color: green"></i>
                    </button>
                  </form>
                  <form action="{{url('/admin/mi_unidad/color')}}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="text" value="darkorange" name="color" hidden>
                    <input type="text" value="{{$subcarpeta->id}}" name="id" hidden>
                    <button type="submit" style="background-color: white;border: 0px">
                      <i class="bi bi-circle-fill" style="color: darkorange"></i>
                    </button>
                  </form>
                  <form action="{{url('/admin/mi_unidad/color')}}" method="post">
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
              <form action="{{url('/admin/mi_unidad/eliminar_subcarpeta', $subcarpeta->id)}}"
                onclick="preguntar_d{{$subcarpeta->id}}(event)" id="miFormularioC{{$subcarpeta->id}}" method="post" >
                @csrf
                @method('DELETE')
                <input type="text" name="id" value="{{$subcarpeta->id}}" hidden>
                <button type="submit" class="dropdown-item" href="#"><i class="bi bi-trash"></i>
                  Eliminar</button>
              </form>
              <script>
                function preguntar_d{{$subcarpeta->id}}(event) {
                  event.preventDefault();
                  Swal.fire({
                    title: '¿Desea eliminar esta carpeta?',
                    text: 'Al eliminar la carpeta se borrar todo el contenido dentro de ella',
                    icon: 'question',
                    showDenyButton: true,
                    confirmButtonText: 'Eliminar',
                    confirmButtonColor: '#a5161d',
                    denyButtonColor: '#270a0a',
                    denyButtonText: 'Cancelar',
                  }).then((result) => {
                    if (result.isConfirmed) {
                      var form = $('#miFormularioC{{$subcarpeta->id}}');
                      form.submit();
                    }
                  });
                }
              </script>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal cambiar nombre carpetas-->
  <div class="modal fade" id="Modal_cambiar_nombre{{$subcarpeta->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
                  <input type="text" value="{{$subcarpeta->nombre}}" class="form-control" name="nombre" required>
                </div>
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

<table id="tablaArchivos" class="table table-responsive table-hover table-striped">
  <thead>
    <tr>
      <th>
        <center>Nro</center>
      </th>
      <th>
        <center>Nombre</center>
      </th>
      <th>
        <center>Fecha</center>
      </th>
      <th>
        <center>Accione</center>
      </th>
    </tr>
  </thead>
  <tbody>
    <input type="text" class="form-control w-50" id="buscador" onkeyup="buscarArchivos()" placeholder="Buscar archivos..."> <br>  
    @php
    $contador = 0;
    @endphp
    @foreach($archivos as $archivo)
    <tr>
      <td style="text-align: center">{{$contador=$contador+1;}}</td>
      <td>
        <?php
            $nombre = $archivo->nombre;
            $extension = pathinfo($nombre,PATHINFO_EXTENSION);
            if ($extension == "jpg"){ ?>
        <img src="{{url('/imagenes//iconos/icono_de_jpg.png')}}" alt="" width="25px">
        <?php
                    }
                    if ($extension == "docx") { ?><img src="{{url('/imagenes//iconos/icono_de_word.png')}}" alt=""
          width="25px"><?php }  
                    if ($extension == "pdf") { ?><img src="{{url('/imagenes//iconos/icono_de_pdf.png')}}" alt=""
          width="20px"><?php } 
                    if ($extension == "xlsx") { ?><img src="{{url('/imagenes//iconos/icono_de_xlsx.png')}}" alt=""
          width="25px"><?php }
                    if ($extension == "pptx") { ?><img src="{{url('/imagenes//iconos/icono_de_pptx.png')}}" alt=""
          width="25px"><?php }
                    if ($extension == "mp4") { ?><img src="{{url('/imagenes//iconos/icono_de_video.png')}}" alt=""
          width="25px"><?php }
                    if ($extension == "mp3") { ?><img src="{{url('/imagenes//iconos/icono_de_mp3.png')}}" alt=""
          width="25px"><?php }
                    
                    ?>
        <a href="" data-toggle="modal" data-target="#modal_visor{{$archivo->id}}" style="color: black">
          {{$archivo->nombre}}
        </a>


        <?php if ($extension == "jpg") { ?>
        <!-- Modal -->
        <div class="modal fade" id="modal_visor{{$archivo->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$archivo->nombre}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" style="text-align: center">
                <img src="{{asset('storage/'.$carpeta->id.'/'.$archivo->nombre)}}" width="100%" alt="">
              </div>
            </div>
          </div>
        </div>
        <?php } ?>

        <?php if ($extension == "pdf") { ?>
        <!-- Modal -->
        <div class="modal fade" id="modal_visor{{$archivo->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$archivo->nombre}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" style="text-align: center">
                <iframe src="{{asset('storage/'.$carpeta->id.'/'.$archivo->nombre)}}" width="100%" height="550px"
                  alt=""></iframe>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>

        <?php if ($extension == "docx") { ?>
        <!-- Modal -->
        <div class="modal fade" id="modal_visor{{$archivo->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$archivo->nombre}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" style="text-align: center">
                <img src="{{url('imagenes/iconos/icono_de_word.png')}}" width="50%" alt=""><br>
                <a href="{{asset('storage/'.$carpeta->id.'/'.$archivo->nombre)}}" class="btn btn-success">Descargar</a>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>

        <?php if ($extension == "pptx") { ?>
        <!-- Modal -->
        <div class="modal fade" id="modal_visor{{$archivo->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$archivo->nombre}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" style="text-align: center">
                <img src="{{url('imagenes/iconos/icono_de_pptx.png')}}" width="50%" alt=""><br><br>
                <a href="{{asset('storage/'.$carpeta->id.'/'.$archivo->nombre)}}" class="btn btn-success">Descargar</a>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>

        <?php if ($extension == "xlsx") { ?>
        <!-- Modal -->
        <div class="modal fade" id="modal_visor{{$archivo->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$archivo->nombre}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" style="text-align: center">
                <img src="{{url('imagenes/iconos/icono_de_xlsx.png')}}" width="50%" alt=""><br>
                <a href="{{asset('storage/'.$carpeta->id.'/'.$archivo->nombre)}}" class="btn btn-success">Descargar</a>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>

        <?php if ($extension == "mp4") { ?>
        <!-- Modal -->
        <div class="modal fade" id="modal_visor{{$archivo->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$archivo->nombre}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" style="text-align: center">
                <video id="my-video" style="width: 100%;" height="500px" class="video-js" controls preload="auto"
                  data-setup="{}">
                  <source src="{{asset('storage/'.$carpeta->id.'/'.$archivo->nombre)}}" type="video/mp4">
                </video>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>

        <?php if ($extension == "mp3") { ?>
        <!-- Modal -->
        <div class="modal fade" id="modal_visor{{$archivo->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$archivo->nombre}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" style="text-align: center">
                <audio id="my-audio" style="width: 100%;" controls>
                  <source src="{{asset('storage/'.$carpeta->id.'/'.$archivo->nombre)}}" type="audio/mp3">
                </audio>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>


      </td>
      <td>{{$archivo->created_at}}</td>
      <td>

        <div class="btn-group" role="group" aria-label="Basic example">

          <!-- Boton eliminar archivos -->
          <form action="{{url('/admin/mi_unidad/carpeta')}}" method="post" style="text-align: center" method="post"
            onclick="preguntar{{$archivo->id}} (event)" id="miFormulario{{$archivo->id}}">
            @csrf
            @method('DELETE')
            <input type="text" value="{{$archivo->id}}" name="id" hidden>
            <button type="submit" class="btn btn-danger btn-sm" style="border-top-right-radius: 0; border-bottom-right-radius: 0;" ><i class="bi bi-trash"></i></button>
          </form>
          <script>
            function preguntar {{$archivo->id}}(event) {
              event.preventDefault();
              Swal.fire({
                title: 'Eliminar archivo',
                text: '¿Desea eliminar este archivo?',
                icon: 'question',
                showDenyButton: true,
                confirmButtonText: 'Eliminar',
                confirmButtonColor: '#a5161d',
                denyButtonColor: '#270a0a',
                denyButtonText: 'Cancelar',
              }).then((result) => {
                if (result.isConfirmed) {
                  var form = $('#miFormulario{{$archivo->id}}');
                  form.submit();
                }
              });
            }
          </script>

          <!-- Boton compartir archivos -->
          <button class="btn btn-success btn-sm" style="border-top-right-radius: 3px; border-bottom-right-radius: 3px;" data-toggle="modal" data-target="#modal_compartir_{{$archivo->id}}">
            <i class="bi bi-share-fill"></i></button>

          <!-- Modal -->
          <div class="modal fade" id="modal_compartir_{{$archivo->id}}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Compartir archivo</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>{{$archivo->nombre}}</p>
                  <?php
                            if ( ($archivo->estado_archivo)=="PRIVADO" ) { ?>

                  <form action="{{route('mi_unidad.archivo.privado.publico')}}" method="post">
                    @csrf
                    <input type="text" name="id" value="{{$archivo->id}}" hidden>
                    <b>Este archivo esta de forma privada</b>
                    <button type="submit" class="btn btn-success"><i class="bi bi-unlock-fill"></i>
                      Cambiar a público</button>
                  </form>
                  <?php
                            }else { ?>
                  <form action="{{route('mi_unidad.archivo.publico.privado')}}" method="post">
                    @csrf
                    <input type="text" name="id" value="{{$archivo->id}}" hidden>
                    <b>Este archivo esta de forma pública</b>
                    <button type="submit" class="btn btn-info"><i class="bi bi-lock-fill"></i>
                      Cambiar a privada</button>
                  </form>
                  <hr>
                  <button data-clipboard-target="#foo{{$archivo->id}}" type="button"
                    class="btn btn-outline-primary">Copiar enlace</button>
                  <input type="text" id="foo{{$archivo->id}}"
                    value="{{asset('storage/'.$carpeta->id.'/'.$archivo->nombre)}}" class="form-control">
                  <script>
                  var clipboard = new Clipboard('.btn');
                  </script>
                  <br>
                  <center>
                    <div id="qrcode{{$archivo->id}}"></div>
                  </center>

                  <script>
                  var opciones = {
                    width: 150,
                    height: 150
                  };
                  var texto = encodeURIComponent(
                    "{{ asset('storage/'.$carpeta->id.'/'.$archivo->nombre) }}");

                  var qrcode = new QRCode("qrcode{{$archivo->id}}", opciones);
                  qrcode.makeCode(texto);
                  </script>


                  <?php
                            }
                            ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

<script>
  function buscarArchivos() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("buscador");
    filter = input.value.toUpperCase();
    table = document.getElementById("tablaArchivos");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1]; // Columna donde se encuentra el nombre del archivo
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
</script>

@endsection