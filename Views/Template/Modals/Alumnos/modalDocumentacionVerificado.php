<!-- Modal -->
<!--<div class="modal fade" id="ModalFormDocumentacionVerificado" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal">Documentacion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formDocumentacionNueva" name="formDocumentacionNueva">
                        <input type="hidden" id="idInscripcion" name="idInscripcion" value="">
                        <div class="card-body"> 
                            <h5 class="card-title">Documentacion</h5>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre del Documento</th>
                                    <th scope="col">Original</th>
                                    <th scope="col">Copia</th>
                                    <th scope="col" width='20%'>Candidad copias</th>
                                    </tr>
                                </thead>
                                <tbody id="tbDocumentacionInsvalidado">
                                </tbody>
                                </table>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkDocumentacionValidado">
                                    <label class="form-check-label" for="checkDocumentacion">Para <b style='color:#3b7ddd'>validar</b> marca esta casilla</label>
                                    <p>Ya está <b style='color:#3b7ddd'>validado</b> por: <span class="badge badge-success" id="nombre_usuarios_verificacion"></span></p>
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
</div>-->

<div class="modal fade" id="ModalFormDocumentacionVerificado" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModalNuevo">Nuevo plantel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <nav>
                        <div class="nav nav-pills nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-link tab-nav" id="step1-tab" data-toggle="tab" href="" onclick="fnNavTab(0)">Documentos</a>
                            <a class="nav-link tab-nav" id="step2-tab" data-toggle="tab" href="" onclick="fnNavTab(1)">Prestamos</a>
                            <a class="nav-link tab-nav" id="step3-tab" data-toggle="tab" href="" onclick="fnNavTab(2)">Historial</a>
                        </div>
                    </nav>
                    <form id="formNuevoPlantel" method = "POST" name="formNuevoPlantel" enctype="multipart/form-data">
                        <input type="hidden" id="idPlantelNuevo" name="idPlantelNuevo" value="">
                        <div class="card-body"> 
                                <div class="tab">
                                    <div class="row">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nombre del Documento</th>
                                                    <th scope="col">Original</th>
                                                    <th scope="col">Copia</th>
                                                    <th scope="col" width='20%'>Candidad copias</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbDocumentacionInsvalidado">
                                            </tbody>
                                        </table>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="checkDocumentacionValidado">
                                            <label class="form-check-label" for="checkDocumentacion">Para <b style='color:#3b7ddd'>validar</b> marca esta casilla</label>
                                            <p>Ya está <b style='color:#3b7ddd'>validado</b> por: <span class="badge badge-success" id="nombre_usuarios_verificacion"></span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab">
                                    <div class="row">
                                        
                                    </div>
                                </div>
                                <div class="tab">
                                    <div class="row">
                                        
                                    </div>               
                                </div>     
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row col-12">
                        <!--<div class="col-4">
                            <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalNuevo"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                        </div>-->
                        <div class="col-7 text-right">
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                        </div>
                        <div class="col-5">
                            <div class="float-right">
                                <div class="row">
                                    <buttom class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" onclick="pasarTab(-1)"  id="btnAnterior"><i class="fas fa-fw fa-lg fa-arrow-circle-left icono-azul"></i>Anterior</buttom>
                                    <buttom class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" onclick="pasarTab(1)"  id="btnSiguiente"><i class="fas fa-fw fa-lg fa-arrow-circle-right icono-azul"></i>Siguiente</buttom>
                                    <button id="btnActionFormNuevo" type="submit" class="btn btn-outline-secondary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Guardar</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
            </form> 
        </div>
    </div>
</div>