<!-- Modal -->
<div class="modal fade" id="ModalSeguimiento" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerUpdate">
                <h5 class="modal-title" id="titleModalNueva">Seguimiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <!--<form id="formSeguimientoProspec" name="formSeguimientoProspec">-->
                        <div class="card-body">
                            <div class="card-title"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" id="idPersonaSeg" name="idPersonaSeg" value="">
                                    <div class="row">
                                        <div class="text-lg">
                                            <label >Nombre completo: </label><span class="text-muted" id="lblNombre"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="text-sm">
                                            <label><span class="text-muted" id="lblMunicipio"></span> / <span class="text-muted" id="lblEstado"></span></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="text-sm">
                                            <label for=""><span class="font-weight-bold" >Medio publicitario:</span><span class="text-muted" id="lblMedioPublicitario"> </span></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="text-sm">
                                            <label for=""><span class="font-weight-bold">Comisionista:</span><span class="text-muted" id="lblNombreComisionista"></span></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="text-sm">
                                            <label for=""><span class="font-weight-bold">Fecha de captura:</span><span class="text-muted" id="lblFecha"></span></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="text-sm">
                                            <label for=""><span class="font-weight-bold">Nivel educativo de interés:</span><span class="text-muted" id="lblNivelEducativo"></span></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="text-sm">
                                            <label for=""><span class="font-weight-bold">Carrera de interés:</span><span class="text-muted" id="lblCarreraInteres"></span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <br><br><br><br><br><br><br>
                                    <div class="d-flex flex-row-reverse bd-highlight">
                                        <div class="p-2 bd-highlight">
                                            <button id="btnInscripcion" class="btn btn-sm btn-primary icono-color-principal btn-inline">
                                                <i class="fas fa-user-plus"></i>Inscribir
                                            </button>
                                        </div>
                                        <div class="p-2 bd-highlight">
                                            <button id="btnSeguimiento" data-toggle="modal" data-target="#modalProspeccionIndividual" class="btn btn-sm btn-primary icono-color-principal btn-inline">
                                                <i class="fas fa-forward"></i> Seguimiento
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="card card-secondary">
                    <div class="card-body">
                        <table id="tableSegProspecto" class="table table-bordered table-striped table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>Fecha y hora</th>
                                    <th>Respuesta</th>
                                    <th>Comentario</th>
                                    <th>Asesor</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary icono-color-principal btn-inline" data-dismiss="modal" id="dimissModalEdit"><i class="fa fa-fw fa-lg fa-times-circle icono-azul" id="cancelarModalTurnoEdit"></i>Salir</a>
            </div>
            <!--</form>-->
        </div>
    </div>
</div>