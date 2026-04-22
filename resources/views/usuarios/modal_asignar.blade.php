<div class="modal fade" id="asignar_rol" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">           
      <form action="{{ url('asignar_rol') }}" method="POST">
        @csrf
        <div class="modal-body">
          <h5 class="modal-title">Asignar rol</h5>
          <hr>
          <div class="row">
            <div class="col-md-12">
              <label><strong>Usuario: <output class="headertekst" type="text" name="nombre" id="nombre"></strong></label>
              <input type="hidden" name="id" id="id" value="">  
              <select class="form-control" name="rol"  id="select_rol"required></select>
              <p></p>
            </div>
          </div>
        </div> 
        <div id="modalfooter" class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-info">Asignar</button>
        </div>         
      </form>      
    </div>
  </div>
</div>