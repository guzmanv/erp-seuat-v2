<!-- Modal -->
<div class="modal fade" id="ModalFormNuevoIngreso" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal">Nuevo Ingreso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formPagosServicios" name="formPagosServicios">
                        <input type="hidden" id="idPersonaSeleccionada" name="idPersonaSeleccionada" value="">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nombre de la Persona</label>
                                        <div class="row">
                                            <div class="col-md-9"><input type="text" id="txtNombreNuevo" name="txtNombreNuevo" class="form-control form-control-sm" placeholder="Nombre de la Persona"  name="" readonly required></div>
                                            <div class="col-md-3"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalNombrePersona"><i class="fa fa-search"></i> Buscar</button></div>
                                        </div>    
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Servicios</label>
                                    <select class="form-control form-control-sm" id="listServicios" name="listServicios" onchange="fnServicioSeleccionado(value)"required >
                                    <option value="">Selecciona un servicio</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Promociones</label>
                                    <select class="form-control form-control-sm" id="listPromociones" name="listPromociones" onchange="fnPromocionSeleccionado(value)"required >
                                    <option value="">Selecciona una promocion</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Descuento</label>
                                    <input type="text" id="txtDescuento" name="txtDescuento" class="form-control form-control-sm" placeholder="Descuento en porcentaje">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Cantidad</label>
                                    <input type="number" id="txtCantidad" name="txtCantidad" class="form-control form-control-sm" value="0">
                                </div>
                                <div class="form-group col-md-4" style="display:flex;align-items:end">
                                    <button type="button" class="btn btn-primary btn-block form-control btn-sm form-control-sm" onclick="fnBtnAgregarServicioTabla()"><i class="fa fa-plus"></i>Agregar</button>
                                </div>
                                <div class="form-group col-md-12">
                                    <hr>
                                </div>
                                <div class="form-group col-md-12 d-flex flex-row-reverse">
                                    <h3><span>Total: </span><b id="txtTotal">$0.00</b></h3>
                                </div>
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre del servicio</th>
                                            <th>Precio unitario</th>
                                            <th>Cantidad</th>
                                            <th>Descuento</th>
                                            <th>Subtotal</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableServicios">
                                    </tbody>
                                </table><br><br><br>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Aviso!</strong> Para poder pagar servicios es necesario tener un estado de cuenta.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
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

<div class="modal fade" id="modalNombrePersona" tabindex="-1" role="dialog" aria-labelledby="modalNombrePersonaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNombrePersonaNLabel">Buscar Persona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control col-5 form-control-sm" id="inputBusquedaPersona" placeholder="Nombre de la Persona" maxlength="100" autocomplete="off" onKeyUp="fnInputBuscarPersona();" />
                <br>
                <table id="tablePersonas" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre Alumno</th>
                            <th>Carrera</th>
                            <th>Grado</th>
                            <th>Grupo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="cerrarModalBuscarPersona"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cerrar</a>
            </div>
        </div>
    </div>
</div>