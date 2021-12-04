<div class="modal fade" id="modalFormCategoria_servicios" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nueva categoría</h5>
        <button type="button" class="close cerrarModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <small class="text-muted pb-4">Los campos con asterisco (<span class="required">*</span>) son obligatorios..</small>
        <div class="card card-dark">
                <form id="formCategoria_servicios" name="formCategoria_servicios" autocomplete="off">
                    <input type="hidden" id="idCategoria_servicios" name="idCategoria_servicios" value="">
                    <input type="hidden" id="listEstatus" name="listEstatus" value="1">
                    <input type="hidden" id="txtFecha_creacion" name="txtFecha_creacion" value="2021-10-23 00:00:00">
                    <input type="hidden" id="txtFecha_actualizacion" name="txtFecha_actualizacion" value="0000-00-00 00:00:00">
                    <input type="hidden" id="txtId_usuario_creacion" name="txtId_usuario_creacion" value="1">
                    <input type="hidden" id="txtId_usuario_actualizacion" name="txtId_usuario_actualizacion" value="NULL">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="txtNombre_categoria">Nombre categoría <span class="required">*</span></label>
                        <input type="text" id="txtNombre_categoria" name="txtNombre_categoria" class="form-control valid validText" placeholder="Ingrese una nueva categoría"  name="Ingresa el nombre de la categoría" required="" autofocus>
                      </div>
                    </div>
        </div>
      </div>
      <div class="modal-footer">
        <a class="btn btn-outline-secondary icono-color-principal btn-inline cerrarModal" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
        <button id="btnActionForm" type="submit" class="btn btn-primary btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i> Guardar</button>
      </div>  
      </form>
    </div>
  </div>
</div>