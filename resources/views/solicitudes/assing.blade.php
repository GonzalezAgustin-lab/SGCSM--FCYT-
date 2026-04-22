<!-- Modal Editar-->
<!-- Título del modal -->
<h5 class="modal-title">Asignar solicitud</h5>
<hr>

<div class="form-group col-md-12">
  <div class="row">
    <div class="col">
      <strong>Solicitud N° {{$solicitud->id}}</strong>
      <br><br>
      <label for="user"><strong>Empleado:</strong></label>
      <select class="form-control" name="user" id="user" required></select>
    </div>
    <input type="hidden" name="id_solicitud" value="{{ $solicitud->id }}">
  </div>
</div> 