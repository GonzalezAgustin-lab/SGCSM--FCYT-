<!-- Modal Editar-->
<input type="hidden" name="idMantProg1" id="idMantProg1">

<!-- Título del modal -->
<h5 class="modal-title">Editar mantenimiento programado</h5>
<hr>

<div class="form-group col-md-12">
  <label for="title"><strong>Titulo:</strong></label>
  <input type="text" class="form-control" autocomplete="off" name="nombre1" id="nombre1" minlength="10" maxlength="50" required>
  
  <label for="title"><strong>Descripcion:</strong></label>
  <textarea type="text" rows="3" class="form-control" name="descripcion1" id="descripcion1"  minlength="10" maxlength="500" required></textarea>
              
  <div class="row" >
    <div class="col-6" id="div_equipo">
      <label for="title"><strong>Equipo:</strong></label>&nbsp&nbsp&nbsp&nbsp<a role="button" class="fa-solid fa-magnifying-glass default" 
      href="#" title="Mostrar Equipos" data-toggle="modal" data-target="#mostrar" onclick="fnOpenModalShowEquipos()"></a>
      <br>
      <select class="form-control select2" name="equipo1" id="equipo1" style="width: 100%;" required></select>
    </div>
    <div class="col-6" id="div_fecha_de_inicio">
      <label for="title"><strong>Fecha de inicio:</strong></label>
      <input type="date" class="form-control" name="fecha_de_inicio1" id="fecha_de_inicio1" required>
    </div>
      <div class="col-12" id="div_fecuencia">
      <label for="title"><strong>Frecuencia de mantenimiento:</strong></label>
      <select class="form-control" name="frecuencia1" id="frecuencia1" required></select>
    </div>
    <div class="col-6">
      <label for="activo1"><strong>Activo:</strong></label>
      <input type="checkbox" name="activo1" id="activo1">
    </div>
  </div>
</div> 