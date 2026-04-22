@extends('mantenimientoProgramado.layouts.layout')
@section('content')

<!-- alertas -->

<div class="content">
  <div class="row" style="justify-content: center">
    <div id="alert" class="alert alert-success col-md-10 text-center" style="display: none"></div>
  </div>
</div>

@if(Session::has('message'))
  <div class="container" id="divAlert">
    <div class="row">
      <div class="col-1"></div>
      <div class="alert {{ Session::get('alert-class') }} col-10 text-center" role="alert">
        {{ Session::get('message') }}
      </div>
    </div>
  </div>
@endif

<!-- barra para buscar mantenimientos programados -->
<div class="col">
  <div class="form-group">
    <form  method="GET">
      <div style="display: inline-block;">
        <label for="id_mant_prog" style="display: block; margin-bottom: 5px;"><h6>ID:</h6></label>
        <input type="text" class="form-control" name="id_mant_prog" id="id_mant_prog" autocomplete="off" value="{{$id_mant_prog}}">
      </div>
      <div style="display: inline-block;">
        <label for="nombre" style="display: block; margin-bottom: 5px;"><h6>Titulo:</h6></label>
        <input type="text" class="form-control" name="nombre" id="nombre" autocomplete="off" value="{{$nombre}}">
      </div>
      <div style="display: inline-block;">
        <label for="id_equipo" style="display: block; margin-bottom: 5px;"><h6>Equipo:</h6></label>
        <input type="text" class="form-control" name="id_equipo" id="id_equipo" autocomplete="off" value="{{$id_equipo}}">
      </div>
      <div style="display: inline-block;">
        <label for="tipo" style="display: block; margin-bottom: 5px;"><h6>Frecuencia:</h6></label>
        <select class="form-control" name="id_frecuencia"  id="id_frecuencia">
          <option value="0">{{'Todos'}} </option>
          @foreach($frecuencias as $frecuencia)
            @if($frecuencia->id == $id_frecuencia)
              <option value="{{$frecuencia->id}}" selected>{{$frecuencia->nombre}} </option>
            @else
              <option value="{{$frecuencia->id}}">{{$frecuencia->nombre}} </option>
            @endif
          @endforeach
        </select>
      </div>
      &nbsp
      <div style="display: inline-block;">
        <button type="submit" class="btn btn-default">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>      
      </div>
    </form>          
  </div>
</div>
<!-- tabla de datos -->
<div class="col-md-12">             
  <table class="table table-striped table-bordered ">
    <thead>
      <th class="text-center align-top">ID</th>
      <th class="text-center align-top">Titulo</th>
      <th class="text-center align-top">Equipo</th>
      <th class="text-center align-top">Descripcion</th>
      <th class="text-center align-top">Frecuencia</th>
      <th class="text-center align-top">Ultima fecha de mantenimiento</th>  
      <th class="text-center align-top">Fecha de inicio</th>    
      <th class="text-center align-top">Activo</th> 
      <th class="text-center align-top">Acciones</th>  
    </thead>
    <tbody>   
      @foreach($mantenimientos_programados as $mant_prog)
          <tr>
            <td align="center">{{$mant_prog->id}}</td>
            <td>{{$mant_prog->nombre}}</td>
            <td>{{$mant_prog->equipo}}</td>
            <td>{{$mant_prog->descripcion}}</td>
            <td align="center">{{$mant_prog->frecuencia}}</td>
            <td align="center">{{$mant_prog->ult_fech_mant}}</td>
            <td align="center">{{$mant_prog->fecha_de_inicio}}</td>
            @if($mant_prog->activo)
              <td width="60" style="text-align: center;"><div class="circle_green"></div></td>
            @else
              <td width="60" style="text-align: center;"><div class="circle_grey"></div></td>
            @endif
            <td>
              <div class="text-center">
                <div class="btn-group">
                  <div class="btn-container">
                    <i onclick='fnOpenModalEdit({{$mant_prog->id}})' id="edit-{{$mant_prog->id}}" class="fa-solid fa-pen-to-square actualizar-editar" title="Editar"></i>
                  </div>
                  <div class="btn-container">
                    <form action="{{ url('destroy_mant_prog', $mant_prog->id) }}" method="POST" onsubmit="return confirm('¿Está seguro que desea eliminar este mantenimiento programado?')" style="display: inline;">
                      @csrf
                      @method('DELETE')
                      <button class="btnEliminar" type="submit" title="Eliminar">
                        <i class="eliminar fa-solid fa-circle-xmark"></i>
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </td>
          </tr>
        @endforeach
    </tbody>
  </table>

  <div class="d-flex justify-content-end">
    <div class="pagination">
      {{ $mantenimientos_programados->links('pagination::bootstrap-4') }}
    </div>
  </div>

  <style>
  .btnEliminar{
      background: transparent; /* Fondo transparente */
      border: none; /* Sin borde */
      padding: 0; /* Sin padding */
      cursor: pointer; /* Cambia el cursor al pasar sobre el botón */
      outline: none; /* Elimina el borde de enfoque */
  }

  .btnEliminar:focus {
      outline: none; /* Elimina el borde de enfoque cuando el botón está enfocado */
  }
  </style>

  <div class="modal fade" id="show2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog estilo" role="document">
      <div class="modal-content">
        <form id="myForm" method="POST" enctype="multipart/form-data">
          {{csrf_field()}}
          <div id="modalshow" class="modal-body">
            <!-- Datos -->
          </div>
          <div id="modalfooter" class="modal-footer">
            <!-- Footer -->
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="show3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog estilo" role="document">
      <div class="modal-content">
        <form id="myForm3" method="POST" enctype="multipart/form-data">
          {{csrf_field()}}
          <div id="modalshow3" class="modal-body">
            <!-- Datos -->
          </div>
          <div id="modalfooter3" class="modal-footer">
            <!-- Footer -->
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="show4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog estilo" role="document">
      <div class="modal-content">
        <form id="myForm4" method="POST" enctype="multipart/form-data">
          {{csrf_field()}}
          <div id="modalshow4" class="modal-body">
            <!-- Datos -->
          </div>
          <div id="modalfooter4" class="modal-footer">
            <!-- Footer -->
          </div>
        </form>
      </div>
    </div>
  </div>

</div>

<!-- Incluir archivos CSS de Select2 -->
<link href="{{ asset('select2/dist/css/select2.min.css') }}" rel="stylesheet" />
<script src="{{ asset('select2/dist/js/select2.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>

<script>
  function manejarSeleccion(idEquipo) {
    $('#equipo').val(idEquipo).trigger('change');
  }

  var ruta = '{{ route('mostrar_equipos_mant') }}';
  var ruta_create = '{{ route('store_mant_prog') }}';
  var ruta_edit = '{{ route('edit_mant_prog') }}';
  var ruta_show_store_mant_prog = "{{ url('show_store_mant_prog') }}";
  var ruta_show_mostrar_equipos_mant_prog = "{{ url('show_mostrar_equipos_mant_prog') }}";
  var ruta_getMantProg = "{{ url('getMantProg') }}";
  var ruta_show_edit_mant_prog = "{{ url('show_edit_mant_prog') }}";
  var closeButton = $('<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>');
  var saveButton = $('<button type="submit" class="btn btn-info" id="saveButton" onclick="fnSaveMantProg()">Guardar</button>');
  var saveButton2 = $('<button type="submit" class="btn btn-info" id="saveButton2" onclick="fnSaveMantProg2()">Guardar</button>');

  function fnSaveMantProg() {
    var form = document.getElementById('myForm');
    if (form.checkValidity()) {
      $('#saveButton').prop('disabled', true);
      $('#myForm').submit();
    } else {
      console.log('El formulario no es válido. Completar los campos requeridos antes de enviar.');
    }
  }

  //modal store
  function fnOpenModalStore() {
    var myModal = new bootstrap.Modal(document.getElementById('show2'));
    var url = ruta_show_store_mant_prog + "/";
    $.get(url, function(data) {
      $("#modalshow").empty();
      $("#modalshow").html(data);
      $("#modalfooter").empty();
      $("#modalfooter").append(closeButton);
      $("#modalfooter").append(saveButton);
      $('#myForm').attr('action', ruta_create);
      myModal.show();
      var modalDialog = myModal._element.querySelector('.modal-dialog');
      modalDialog.classList.remove('modal-sm');
      modalDialog.classList.remove('modal-lg');
    });

    $('#show2').on('show.bs.modal', function (event){
      var today = new Date();
      today.setDate(today.getDate() + 1);
      var year = today.getFullYear();
      var month = (today.getMonth() + 1).toString().padStart(2, '0');
      var day = today.getDate().toString().padStart(2, '0');
      var minDate = `${year}-${month}-${day}`;
      $('#fecha_de_inicio').attr('min', minDate);
      $.get('select_tablas_mant_prog/',function(data){
        var htmlSelectFrecuencia = '<option value="">Seleccione </option>'
        var htmlSelectEquipo = '<option value="">Seleccione </option>'
        htmlSelectFrecuencia += data[0].map(item => `<option value="${item.id}">${item.nombre}</option>`).join('');
        htmlSelectEquipo += data[1].map(equipo => `<option value="${equipo.id}">${equipo.id}</option>`).join(''); 
        $('#equipo').html(htmlSelectEquipo);  
        $('#frecuencia').html(htmlSelectFrecuencia);   
      });
    });
  } 

  //modal show equipos
  function fnOpenModalShowEquipos() {
    var myModal3 = new bootstrap.Modal(document.getElementById('show3'));
    $.ajax({
      url: ruta_show_mostrar_equipos_mant_prog + "/",
      type: 'GET',
      success: function(data) {
        $("#modalshow3").empty();
        $("#modalshow3").html(data);
        $("#modalfooter3").empty();
        $("#modalfooter3").append(closeButton);
        closeButton.click(function(event) {
          event.stopPropagation();
          myModal3.hide();
        });
        myModal3.show();
        var modalDialog = myModal3._element.querySelector('.modal-dialog');
        modalDialog.classList.remove('modal-sm');
        modalDialog.classList.add('modal-lg');
        modalDialog.style.width = '90%';
        modalDialog.style.maxWidth = '90%';
      },
    });
  }

  function getMantProg(idMantProg) {
    return new Promise(function(resolve, reject) {
      $.ajax({
        url: ruta_getMantProg + "/" + idMantProg,
        method: 'GET',
        success: function(data) {
          resolve(data);
        },
        error: function(error) {
          reject(error);
        }
      });
    });
  }

  var mantProg;
  //modal edit
  async function fnOpenModalEdit(id) {
    var myModal = new bootstrap.Modal(document.getElementById('show4'));
    $.ajax({
      url: ruta_show_edit_mant_prog + "/" + id,
      type: 'GET',
      success: function(data) {
        $("#modalshow4").empty();
        $("#modalshow4").html(data);
        $("#modalfooter4").empty();
        $("#modalfooter4").append(closeButton);
        $("#modalfooter4").append(saveButton2);
        $('#myForm4').attr('action', ruta_edit);
        myModal.show();
        var modalDialog = myModal._element.querySelector('.modal-dialog');
        modalDialog.classList.remove('modal-sm');
        modalDialog.classList.remove('modal-lg');
      },
    });
    try {
      mantProg = await getMantProg(id);
    } catch (error) {
      console.error('Error al obtener el mantenimiento programado:', error);
    }
  }

  $('#show4').on('show.bs.modal', function (event){
    var today = new Date();
    today.setDate(today.getDate() + 1);
    var year = today.getFullYear();
    var month = (today.getMonth() + 1).toString().padStart(2, '0');
    var day = today.getDate().toString().padStart(2, '0');
    var minDate = `${year}-${month}-${day}`;
    $('#fecha_de_inicio1').attr('min', minDate);

    $.get('select_tablas_mant_prog/',function(data){
      var htmlSelectFrecuencia = '<option value="">Seleccione </option>'
      var htmlSelectEquipo = '<option value="">Seleccione </option>'

      htmlSelectFrecuencia += data[0].map(item => {
          const selected = item.id === mantProg[0].frecuencia ? 'selected' : '';
          return `<option value="${item.id}" ${selected}>${item.nombre}</option>`;
      }).join('');

      htmlSelectEquipo += data[1].map(equipo => {
          const selected = equipo.id === mantProg[0].equipo ? 'selected' : '';
          return `<option value="${equipo.id}" ${selected}>${equipo.id}</option>`;
      }).join('');

      $('#nombre1').val(mantProg[0].nombre);
      $('#descripcion1').val(mantProg[0].descripcion);
      $('#fecha_de_inicio1').val(mantProg[0].fecha_de_inicio);

      if(mantProg[0].activo == 1){
        $('#activo1').prop('checked', true);
      }else {$('#activo1').prop('checked', false);}

      $('#equipo1').select2();
      $('#equipo1').html(htmlSelectEquipo);  
      $('#frecuencia1').html(htmlSelectFrecuencia);   
      $('#idMantProg1').val(mantProg[0].id);

    })
  });

  //Duracion de alerta (agregado, elimnado, editado)
  $(document).ready(function(){
    setTimeout(function(){
      $(".alert").fadeOut();
    }, 5000); // 5 segundos
  });

</script>

@stop