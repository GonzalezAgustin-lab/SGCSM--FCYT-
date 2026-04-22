<!-- Modal Agregar usuario-->
<div class="modal fade" id="agregar_usuario" role="dialog">
  <div class="modal-dialog">
   <div class="modal-content">          
      <form action="{{ url('store_usuario') }}" method="POST" onsubmit="disableSubmitButton()">
        {{csrf_field()}}
        <div class="modal-body">
          <h5 class="modal-title">Agregar usuario</h5>
          <hr>
            <div class="form-group col-md-12">

              <div class="row">
                <div class="col-md-6">
                  <label for="title"><strong>Nombre:</strong></label>
                  <select class="form-control" name="nombre_p" id="nombre_p"></select>
                </div>
                <div class="col-md-6">
                  <label for="title"><strong>Correo electrónico:</strong></label>
                  <select class="form-control" name="correo" id="correo"></select>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <label for="title"><strong>Contraseña:</strong></label>
                  <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                </div>
                <div class="col-md-6">
                  <label for="title"><strong>Confirmar contraseña:</strong></label>
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
              </div>

              <p></p>
            </div>
        </div>
        <div id="modalfooter" class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-info" id="submitButton">Agregar</button>
        </div>
      </form>                
    </div>
  </div>
</div>

<script>
  function disableSubmitButton() {
    document.getElementById('submitButton').disabled = true;
  }
</script>