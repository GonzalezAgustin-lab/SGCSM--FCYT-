<!-- Modal Editar-->
<div class="form-group col-md-12">

  <!-- Título del modal -->
  <h5 class="modal-title">Reclamar solicitud</h5>
  <hr>

  <div class="row">
    <div class="col">
      <strong>Solicitud N° {{$solicitud->id}}</strong>
      <br><br>
      <label for="descripcion" class="form-label"><strong>Descripción:</strong></label>
      <input type="text" name="descripcion" class="form-control" id="descripcion" minlength="10" maxlength="500" required>
    </div>
    <input type="hidden" name="id_solicitud" value="{{ $solicitud->id }}">
  </div>
</div> 
