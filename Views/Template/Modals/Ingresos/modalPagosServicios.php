<!-- Modal -->
<div class="modal fade" id="ModalFormPagosServicios" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal">Pagos Servicios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formCategoriaNueva" name="formCategoriaNueva">
                        <input type="hidden" id="idAlumno" name="idAlumno" value="">
                        <div class="card-body"> 
                            <div class="form-group">
                                <label>Alumno</label>
                                <h2 type="text" id="txtAlumno" name="txtAlumno" class="form-control form-control-sm" disabled>
                            </div>
                            <div class="form-group">
                                <label>Servicios</label>
                                <select class="form-control" id="listEstatusNuevo" name="listEstatusNuevo" required >
                                <option value="">Selecciona un servicio</option>
                                <option value="1">Inscripcion</option>
                                <option value="2">Asignacion de campos clinicos</option>
                                <option value="2">Servicio3</option>
                                <option value="2">Servicio4</option>
                                <option value="2">Servicio5</option>
                                <option value="2">Servicio6</option>
                                </select>
                            </div>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Aviso!</strong> Para poder pagar servicios es necesario tener un estado de cuenta.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalNuevo"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                    <button id="btnActionFormNueva" type="submit" class="btn btn-outline-secondary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Guardar</span></button>
                </div>   
            </form> 
        </div>
    </div>
</div>