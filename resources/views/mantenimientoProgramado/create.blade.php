<!-- Modal Agregar-->
<input type="hidden" name="id">

<!-- Título del modal -->
<h5 class="modal-title">Agregar mantenimiento programado</h5>
<hr>

<div class="form-group col-md-12">
  <label for="title"><strong>Titulo:</strong></label>
  <input type="text" class="form-control" autocomplete="off" name="nombre" id="nombre" minlength="10" maxlength="50" required>

  <label for="title"><strong>Descripcion:</strong></label>
  <textarea rows="3" type="text" class="form-control" name="descripcion" id="descripcion"  minlength="10" maxlength="500" required></textarea>
              
  <div class="row" >
    <div class="col-6" id="div_equipo">
      <label for="title"><strong>Equipo:</strong></label>&nbsp&nbsp&nbsp&nbsp<a role="button" class="fa-solid fa-magnifying-glass default" 
      href="#" title="Mostrar Equipos" data-toggle="modal" data-target="#mostrar" onclick="fnOpenModalShowEquipos()"></a>
      <br>
      <select class="form-control select2" name="equipo" id="equipo" style="width: 100%;" required></select>
    </div>
    <div class="col-6" id="div_fecha_de_inicio">
      <label for="title"><strong>Fecha de inicio:</strong></label>
      <input type="date" class="form-control" name="fecha_de_inicio" id="fecha_de_inicio" required>
    </div>
      <div class="col-12" id="div_fecuencia">
      <label for="title"><strong>Frecuencia de mantenimiento:</strong></label>
      <select class="form-control" name="frecuencia" id="frecuencia" required></select>
    </div>
    <div class="col-6">
      <label for="activo"><strong>Activo:</strong></label>
      <input type="checkbox" name="activo" id="activo" checked>
    </div>
  </div>
  <!--<input type="hidden" name="solicitante" value="{{ Auth::id() }}"> -->
</div>
      