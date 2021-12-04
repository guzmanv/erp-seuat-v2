<!-- Modal -->
<div class="modal fade" id="ModalFormDatosFiscales" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerUpdated">
                <h5 class="modal-title" id="titleModalEdit">Datos de facturación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formDatosFiscales" name="formDatosFiscales">
                        <input type="hidden" id="idPersona" name="idPersona" value="">
                        <div class="card-body">
                            <div class="row" >
                                    <div class="form-group col-md-12">
                                        <label>Nombre del alumno</label>
                                        <input type="text" id="txtNombreAlumno" class="form-control form-control-sm" disabled>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label>RFC</label>
                                        <input type="text" id="txtNombreEdit" name="txtNombreEdit" class="form-control form-control-sm" placeholder="RFC" maxlength="15" required>
                                    </div>
                                    <div class="form-group col-md-7">
                                        <label>Nombre social</label>
                                        <input type="text" id="txtApellidoPaEdit" name="txtApellidoPaEdit" class="form-control form-control-sm" placeholder="Nombre social"  maxlength="180" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>CP</label>
                                        <input type="text" id="txtEdadEdit" name="txtEdadEdit" class="form-control form-control-sm" placeholder="CP"   maxlength="5" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Teléfono</label>
                                        <input type="text" id="txtFechaNacimientoEdit" name="txtFechaNacimientoEdit" class="form-control form-control-sm"  placeholder="Teléfono"   maxlength="10" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Email</label>
                                        <input type="text" id="txtCURPEdit" name="txtCURPEdit" class="form-control form-control-sm" placeholder="Email"  maxlength="100" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Dirección</label>
                                        <textarea id="txtApellidoMaEdit" name="txtApellidoMaEdit" class="form-control form-control-sm" placeholder="Dirección" rows='2' maxlength="200" required></textarea>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalEdit"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                    <button id="btnActionFormEdit" type="submit" class="btn btn-outline-secondary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText">Guardar</span></button>
                </div>   
            </form> 
        </div>
    </div>
</div>