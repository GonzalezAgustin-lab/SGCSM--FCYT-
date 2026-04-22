<!-- Título del modal -->
<h5 class="modal-title">Editar empleado</h5>
<hr>
<div class="col-md-12">
  <input type="hidden" name="id_e" id="id_e" value="{{ $empleado->id_e }}">

  <div class="row">
    <div class="col-md-6">
      <label for="nombre_p"><strong>Nombre:</strong></label>
      <input type="text" name="nombre" class="form-control" id="nombre_p" autocomplete="off" value="{{ $empleado->nombre }}" minlength="3" maxlength="30" required>
    </div>
    <div class="col-md-6">
      <label for="apellido"><strong>Apellido:</strong></label>
      <input type="text" name="apellido" class="form-control" id="apellido" autocomplete="off" value="{{ $empleado->apellido }}" minlength="3" maxlength="30" required>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <label for="dni"><strong>DNI:</strong></label>
      <input disabled type="number" name="dni" class="form-control" id="dni" autocomplete="off" value="{{ $empleado->dni }}" minlength="8" maxlength="11" required>
    </div>
    <div class="col-md-6">
      <label for="interno"><strong>Interno:</strong></label>
      <input type="number" name="interno" class="form-control" id="interno" autocomplete="off" value="{{ $empleado->interno }}" minlength="2" maxlength="5">
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <label for="fe_nac"><strong>Fecha de nacimiento:</strong></label>
      <input type="date" name="fe_nac" id="fe_nac" class="form-control" step="1" value="{{ $empleado->fe_nac }}">
    </div>
    <div class="col-md-6">
      <label for="fe_ing"><strong>Fecha de ingreso:</strong></label>
      <input type="date" name="fe_ing" id="fe_ing" class="form-control" step="1" value="{{ $empleado->fe_ing }}">
    </div>
  </div>

  <div class="row">
    <div class="col">
      <label for="correo"><strong>Correo electrónico:</strong></label>
      <input type="email" name="correo" class="form-control" id="correo" value="{{ $empleado->correo }}" >
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <label for="area"><strong>Area:</strong></label>
      <select class="form-control" name="area" id="area" required></select>
    </div>
  </div>

  <p></p>
  
  <div class="row">
    <div class="col-6">
      <label for="actividadEditar"><strong>En actividad:</strong></label>
      <input type="checkbox" name="actividadEditar" id="actividadEditar" {{ $empleado->activo ? 'checked' : '' }}>
    </div>
    <div class="col-6">
      <label for="esJefeEditar"><strong>Es jefe:</strong></label>
      <input type="checkbox" name="esJefeEditar" id="esJefeEditar" {{ $empleado->jefe ? 'checked' : '' }}>
    </div>
  </div>

  <p></p>
</div>