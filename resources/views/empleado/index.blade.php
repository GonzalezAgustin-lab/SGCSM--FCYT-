@extends('empleado.layouts.layout')
@section('content')

<div id="alert" class="alert alert-info" style="display: none"></div>

@if(Session::has('message'))
  <div class="container" id="div.alert">
    <div class="row">
      <div class="col-1"></div>
      <div class="alert {{Session::get('alert-class')}} col-10 text-center" role="alert">
        {{Session::get('message')}}
      </div>
    </div>
  </div>
@endif

<div class="col-md-12 ml-auto">
  <div class="form-group">
   <input type="text" class="form-control pull-right" style="width:20%" id="search" placeholder="Buscar">
 </div>
</div>

<div class="col-sm-12">             
  <table id="test" class="table table-striped table-bordered table-condensed" role="grid" cellspacing="0" cellpadding="2" border="10">
    <thead>
      <th class="text-center">Apellido y nombre</th>
      <th class="text-center">DNI</th>
      <th class="text-center">Fecha de ingreso</th>
      <th class="text-center">Fecha de nacimiento</th>
      <th class="text-center">Area</th>
      <th class="text-center">Jefe</th>
      <th class="text-center">En actividad</th>
      <th class="text-center">Acciones</th>
    </thead>        
    
    <tbody>
      @if(count($empleados))
        @foreach($empleados as $empleado) 
          <tr>
            @if ($empleado->dni != 9999999)
              <td> {{$empleado->apellido . ' '. $empleado->nombre_p}}</td>

              <td align="center">{{$empleado->dni}}</td>

              @if ($empleado->fe_ing != '')
                <td align="center">{!! \Carbon\Carbon::parse($empleado->fe_ing)->format("d-m-Y") !!}</td>
              @else
                <td align="center"></td>
              @endif

              @if ($empleado->fe_nac != '')
                <td align="center">{!! \Carbon\Carbon::parse($empleado->fe_nac)->format("d-m-Y") !!}</td>
              @else
                <td align="center"></td>
              @endif

              <td>{{$empleado->nombre_a}}</td>

              @if($empleado->jefe == 1)
                <td width="60" style="text-align: center;"><div class="circle_green"></div></td>
              @else
                <td width="60" style="text-align: center;"><div class="circle_grey"></div></td>
              @endif

              @if($empleado->activo == 1)
                <td width="60" style="text-align: center;"><div class="circle_green"></div></td>
              @else
                <td width="60" style="text-align: center;"><div class="circle_grey"></div></td>
              @endif

              <td>
                <div class="text-center">
                  <div class="btn-container">
                      <i onclick='fnOpenModalUpdate("{{$empleado->id_p}}")' data-area="{{$empleado->area}}" 
                      class="fa-solid fa-pen-to-square actualizar-editar" data-target="#editar_empleado"
                      id="edit-{{$empleado->id_p}}" title="Editar">
                      </i>
                  </div>
                </div>
              </td>
            @endif
          </tr>
        @endforeach  
      @endif  
    </tbody>
  </table>
</div>

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
      <form id="myForm" method="POST" enctype="multipart/form-data">
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

<script>
  $(document).ready(function() {
    $('.eliminar').click(function() {
      // Obtenemos el formulario padre del ícono
      var form = $(this).closest('form');
      // Enviamos el formulario
      form.submit();
    });
  });
</script>

<script>
  var ruta_update = '{{ route('update_empleado') }}';
  var ruta_create = '{{ route('store') }}';
  var ruta_show_store_empleado = "{{ url('show_store_empleado') }}";
  var ruta_show_update_empleado = "{{ url('show_update_empleado') }}";
  var closeButton = $('<button type="button" class="btn btn-secondary" id="closeButton" data-dismiss="modal">Cerrar</button>');
  var closeButton2 = $('<button type="button" class="btn btn-secondary" id="closeButton2" data-dismiss="modal">Cerrar</button>');
  var saveButton = $('<button type="submit" class="btn btn-info" id="saveButton" onclick="fnSaveEmpleado()">Guardar</button>');
  var saveButton2 = $('<button type="submit" class="btn btn-info">Guardar</button>');
  var idJefe;

  function fnOpenModalAgregarEmpleado(){
    var myModal = new bootstrap.Modal(document.getElementById('show3'));
      var url = ruta_show_store_empleado;
    $.get(url, function(data) {
      // Borrar contenido anterior
      $("#modalshow3").empty();

      // Establecer el contenido del modal
      $("#modalshow3").html(data);

      // Borrar contenido anterior
      $("#modalfooter3").empty();

      // Agregar el botón "Cerrar y Guardar" al footer
      $("#modalfooter3").append(closeButton2);
      $("#modalfooter3").append(saveButton2);

      // Cambiar la acción del formulario
      $('#myForm').attr('action', ruta_create);

      // Mostrar el modal
      myModal.show();

      // Cambiar el tamaño del modal a "modal-lg"
      var modalDialog = myModal._element.querySelector('.modal-dialog');
      modalDialog.classList.remove('modal-sm');
      modalDialog.classList.remove('modal-lg');
    });
  }

  $('#show3').on('show.bs.modal', function (event) {
    $.get('selectAreaEmpleados/',function(data){
      var html_select = '<option value="">Seleccione area </option>'
      for(var i = 0; i<data.length; i ++)
        html_select += '<option value ="'+data[i].id_a+'">'+data[i].nombre_a+'</option>';
      $('#area').html(html_select);
    });

    $('#actividadCreate').on('change', function () {
      if ($(this).prop('checked')) {
        // Si se marca el checkbox de actividad, desactiva el checkbox de jefe
        $('#esJefeCreate').prop('checked', false);
        $('#esJefeCreate').prop('disabled', false);
      } else {
        // Si se desmarca el checkbox de actividad, habilita el checkbox de jefe
        $('#esJefeCreate').prop('disabled', true);
        $('#esJefeCreate').prop('checked', false);
      }
    });
  });

  /*function actualizarContenidoModal(idJefe) {
    // Realizar una nueva solicitud AJAX para obtener el contenido actualizado de la tabla
    $.ajax({
      url: window.location.protocol + '//' + window.location.host + "/obtenerNuevoListadoAreaXJefe/" + idJefe, 
      type: 'GET',
      success: function (data) {
        // Actualizar el contenido del modal con los nuevos datos
        $("#modalshow").html(data);
        updateSelectOptions();
      },
    });
  }*/

  function fnOpenModalUpdate(id_e) 
  {
    var myModal = new bootstrap.Modal(document.getElementById('show2'));
    var area = document.getElementById('edit-' + id_e).getAttribute('data-area');
    $.ajax({
      url: ruta_show_update_empleado + "/" + id_e,
      type: 'GET',
      success: function(data) {
        // Borrar contenido anterior
        $("#modalshow").empty();
        // Establecer el contenido del modal
        $("#modalshow").html(data);
        // Borrar contenido anterior
        $("#modalfooter").empty();

        // Agregar el botón "Cerrar" al footer
        $("#modalfooter").append(closeButton);
        $("#modalfooter").append(saveButton);

        //Cambiar la acción del formulario
        $('#myForm').attr('action', ruta_update);

        // Mostrar el modal
        myModal.show();

        // Cambiar el tamaño del modal a "modal-lg"
        var modalDialog = myModal._element.querySelector('.modal-dialog');
        modalDialog.classList.remove('modal-sm');
        modalDialog.classList.remove('modal-lg');
      },
    });
    $('#show2').on('show.bs.modal', function (event){
    $.get('selectAreaEmpleados/',function(data){
      var html_select = '<option value="">Seleccione </option>'
      for(var i = 0; i<data.length; i ++){
        if(data[i].id_a == area){
          html_select += '<option value ="'+data[i].id_a+'"selected>'+data[i].nombre_a+'</option>';
        }else{
          html_select += '<option value ="'+data[i].id_a+'">'+data[i].nombre_a+'</option>';
        }
      }
      $('#area').html(html_select);
    });

    $('#actividadEditar').on('change', function () {
      if ($(this).prop('checked')) {
        // Si se marca el checkbox de actividad, desactiva el checkbox de jefe
        $('#esJefeEditar').prop('checked', false);
        $('#esJefeEditar').prop('disabled', false);
      } else {
        // Si se desmarca el checkbox de actividad, habilita el checkbox de jefe
        $('#esJefeEditar').prop('disabled', true);
        $('#esJefeEditar').prop('checked', false);
      }
    });
  });
  }

  

  /*$('#show2').on('show.bs.modal', function (event) {
    $.get('select_tablas/',function(data){
      data[0].forEach(item => {
        if ((item.id_a === solicitud[0].idAreaProyecto) || (item.id_a === solicitud[0].idAreaEquipo) || (item.id_a === solicitud[0].idAreaEdilicio)) {
          htmlSelectArea += `<option value="${item.id_a}" selected>${item.nombre_a}</option>`;
          areaPrecargada = true;
        } else {
          htmlSelectArea += `<option value="${item.id_a}">${item.nombre_a}</option>`;
        }
      });
    });
  });*/

  function fnSaveEmpleado(){
    var form = document.getElementById('myForm');
    if (form.checkValidity()) {
      $('#saveButton').prop('disabled', true);
      $('#myForm').submit();
    } else {
      console.log('El formulario no es válido. Completar los campos requeridos antes de enviar.');
    }
  }
</script>

<script> 
  $("document").ready(function(){
    setTimeout(function(){
      $("div.alert").fadeOut();
    }, 5000 ); // 5 secs
  });
</script>

<script>
 $(document).ready(function(){
   $("#search").keyup(function(){
     _this = this;
     $.each($("#test tbody tr"), function() {
       if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
         $(this).hide();
       else
         $(this).show();
     });
   });
 });
</script>

<script>
  $(document).ready(function(){
    $('#alert').hide();
    $('.btn-borrar').click(function(e){
        e.preventDefault();
        if(! confirm("¿Está seguro de eliminar?")){
            return false;
        }
        var row = $(this).parents('tr');
        var form = $(this).parents('form');
        var url  = form.attr('action');       
        
        $.get(url, form.serialize(),function(result){
            row.fadeOut();
            $('#alert').show();
            $('#alert').html(result.message)
            setTimeout(function(){ $('#alert').fadeOut();}, 5000 );
        }).fail(function(){
            $('#alert').show();
            $('#alert').html("Algo salió mal");
        });
    });
});
</script>

@endsection

