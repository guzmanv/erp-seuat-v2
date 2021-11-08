<!-- Modal -->
<div class="modal fade" id="ModalFormVerPersona" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModalVer">Ver Persona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formPersonaVer" name="formPersonaVer">
                        <input type="hidden" id="idVer" name="idVer" value="">
                        <div class="card-body">
                            <div class="row" >
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" id="txtNombreVer" name="txtNombreVer" class="form-control" placeholder="Nombre"  name="" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Apellido Paterno</label>
                                        <input type="text" id="txtApellidoPaVer" name="txtApellidoPaVer" class="form-control" placeholder="Apellido Paterno"  name="" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Apellido Materno</label>
                                        <input type="text" id="txtApellidoMaVer" name="txtApellidoMaVer" class="form-control" placeholder="Apellido Materno"  name="" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Direccion</label>
                                        <input type="text" id="txtDireccionVer" name="txtDireccionVer" class="form-control" placeholder="Direccion"  name="" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Edad</label>
                                        <input type="text" id="txtEdadVer" name="txtEdadVer" class="form-control" placeholder="Edad"  name="" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Sexo</label>
                                        <select class="form-control" id="listSexoVer" name="listSexoVer" disabled >
                                        <option value="">Selecciona un Sexo</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>CP</label>
                                        <input type="text" id="txtCPVer" name="txtCPVer" class="form-control" placeholder="CP"  name="" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Colonia</label>
                                        <input type="text" id="txtColoniaVer" name="txtColoniaVer" class="form-control" placeholder="Colonia"  name="" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Telefono Celular</label>
                                        <input type="text" id="txtTelCelVer" name="txtTelCelVer" class="form-control" placeholder="Telefono Celular"  name="" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Telefono Fijo</label>
                                        <input type="text" id="txtTelFiVer" name="txtTelFiVer" class="form-control" placeholder="Telefono Fijo"  name="" disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" id="txtEmailVer" name="txtEmailVer" class="form-control" placeholder="Email"  name="" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Estado Civil</label>
                                        <select class="form-control" id="listEstadoCivilVer" name="listEstadoCivilVer" disabled >
                                        <option value="">Selecciona un Estado</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Ocupacion</label>
                                        <input type="text" id="txtOcupacionVer" name="txtOcupacionVer" class="form-control" placeholder="Ocupacion"  name="" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Validacion</label>
                                        <input type="text" id="txtValidacionVer" name="txtValidacionVer" class="form-control" placeholder="Validacion"  name="" disabled>
                                    </div>  
                                    <div class="form-group">
                                        <label>Escolaridad</label>
                                        <select class="form-control" id="listEscolaridadVer" name="listEscolaridadVer" disabled >
                                            <option value="">Selecciona una Escolaridad</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select class="form-control" id="listEstadoVer" name="listEstadoVer" onchange="estadoSeleccionadoEdit(value)" disabled >
                                            <option value="">Selecciona un Estado</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Municipio</label>
                                        <select class="form-control" id="listMunicipioVer" name="listMunicipioVer" onchange="municipioSeleccionadoEdit(value)" disabled >
                                            <option value="">Selecciona un Municipio</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Localidad</label>
                                        <select class="form-control" id="listLocalidadVer" name="listLocalidadVer" disabled >
                                        <option value="">Selecciona una Localidad</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Categoria Persona</label>
                                        <select class="form-control" id="listCategoriaVer" name="listCategoriaVer" disabled >
                                        <option value="">Selecciona una Categoría</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Estatus</label>
                                        <select class="form-control" id="listEstatusVer" name="listEstatusVer" disabled >
                                        <option value="">Selecciona un Estatus</option>
                                        </select>
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalVer"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                    <button id="btnActionFormVer" type="submit" class="btn btn-outline-secondary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Guardar</span></button>
                </div>   
            </form> 
        </div>
    </div>
</div>