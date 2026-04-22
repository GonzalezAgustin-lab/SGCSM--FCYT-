@extends('localizaciones.layouts.layout')
@section('content')

<!-- alertas -->

<div class="content">
  <div class="row" style="justify-content: center">
    <div id="alert" class="alert alert-success col-md-10 text-center" style="display: none"></div>
  </div>
</div>

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

<!-- barra para buscar equipos -->

<!-- tabla de datos -->
<div class="col-md-12">             
  <table class="table table-striped table-bordered ">
    <thead>
      <th class="text-center">ID</th>
      <th class="text-center">Area</th>
      <th class="text-center">Nombre</th>
      <th class="text-center">Acciones</th>   
    </thead>
    <tbody>
      @foreach($localizaciones as $localizacion)
        <tr class="text-center">
        <td width="80">{{$localizacion->id}}</td>
        <td>{{$localizacion->nombre_a}}</td>
        <td>{{$localizacion->nombre}}</td>
        <td width="90">
          <div class="btn-container">
            <i id="edit" onclick='fnOpenModalUpdate("{{$localizacion->id}}")' data-nombre="{{$localizacion->nombre}}" data-interno="{{$localizacion->interno}}" class="fa-solid fa-pen-to-square actualizar-editar" title="Editar"></i>
          </div>
        </td>
        </tr>
      @endforeach
    </tbody>       
  </table>
  <div class="modal fade" id="show2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
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
    
  <div class="d-flex justify-content-end">
    <div class="pagination">
      {{ $localizaciones->links('pagination::bootstrap-4') }}
    </div>
  </div>

</div>
<script> 
  //Duracion de alerta (agregado, eliminado, editado)
  $(document).ready(function(){
    setTimeout(function(){
      $("div.alert").fadeOut();
    }, 5000 ); // 5 secs
  });
</script> 

<script> 
  var ruta_create = '{{ route('store_localizacion') }}';
  var ruta_update = '{{ route('update_localizacion') }}';
  var ruta_show_store_localizacion = "{{ url('show_store_localizacion') }}";
  var ruta_show_update_localizacion = "{{ url('show_update_localizacion') }}";
  var closeButton = $('<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>');
  var saveButton = $('<button type="submit" class="btn btn-info">Guardar</button>');

  //modal store
  function fnOpenModalStore() {
    var myModal = new bootstrap.Modal(document.getElementById('show2'));
    var url = ruta_show_store_localizacion + "/";
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
      modalDialog.classList.add('modal-lg');
    });
  }
  
  //modal update
  function fnOpenModalUpdate(id) {
    var myModal = new bootstrap.Modal(document.getElementById('show2'));
    $.ajax({
      url: ruta_show_update_localizacion + "/" + id,
      type: 'GET',
      success: function(data) {
        $("#modalshow").empty();
        $("#modalshow").html(data);
        $("#modalfooter").empty();
        $("#modalfooter").append(closeButton);
        $("#modalfooter").append(saveButton);
        $('#myForm').attr('action', ruta_update);
        myModal.show();
        var modalDialog = myModal._element.querySelector('.modal-dialog');
        modalDialog.classList.remove('modal-sm');
        modalDialog.classList.add('modal-lg');
      },
    });
  }

  $('#show2').on('show.bs.modal', function (event) {
    $.get('select_area/',function(data){
      var html_select = '<option value="">Seleccione </option>'
      for(var i = 0; i<data.length; i ++){
        html_select += '<option value ="'+data[i].id_a+'">'+data[i].nombre_a+'</option>';
      }
      $('#area').html(html_select);
    });
  });
</script> 
@stop