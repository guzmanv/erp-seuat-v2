<!-- Modal -->
<div class="modal fade" id="ModalEditSalon" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerUpdate">
                <h5 class="modal-title" id="titleModalNueva">Editar salón</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formModalidadEdit" name="formModalidadEdit">
                        <input type="hidden" id="idSalonEdit" name="idSalonEdit" value="">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nombre salón</label>
                                <input type="text" id="txtNombreEdit" name="txtNombreEdit" class="form-control form-control-sm" placeholder="EJ: Salón 1" name="" maxlength="45" required>
                            </div>
                            <div class="form-group">
                                <label for="">Cantidad máx. alumnos</label>
                                <input type="number" min="1" pattern="^[0-9]" id="txtCantidadMaxEdit" name="txtCantidadMaxEdit" class="form-control form-control-sm" placeholder="EJ: 10,15,20" required>
                            </div>
                            <div class="form-group">
                                <label>Estatus</label>
                                <select class="form-control form-control-sm" name="listEstatusEdit" id="listEstatusEdit" required>
                                    <option value="">Selecciona una opción</option>
                                    <option value="1">Activado</option>
                                    <option value="2">Inactivo</option>
                                </select>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalEdit"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                <button id="btnActionFormEdit" type="submit" class="btn btn-outline-secondary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Actualizar</span></button>
            </div>
            </form>
        </div>
    </div>
</div>