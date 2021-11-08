<!-- Modal -->
<div class="modal fade" id="ModalFormNuevaPersona" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModalNuevo">Nueva Persona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formPersonaNuevo" name="formPersonaNuevo">
                        <input type="hidden" id="idNuevo" name="idNuevo" value="">
                        <div class="card-body">
                            <div class="row" >
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" id="txtNombreNuevo" name="txtNombreNuevo" class="form-control" placeholder="Nombre"  name="" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Apellido Paterno</label>
                                        <input type="text" id="txtApellidoPaNuevo" name="txtApellidoPaNuevo" class="form-control" placeholder="Apellido Paterno"  name="" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Apellido Materno</label>
                                        <input type="text" id="txtApellidoMaNuevo" name="txtApellidoMaNuevo" class="form-control" placeholder="Apellido Materno"  name="" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Direccion</label>
                                        <input type="text" id="txtDireccionNuevo" name="txtDireccionNuevo" class="form-control" placeholder="Direccion"  name="" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Edad</label>
                                        <input type="text" id="txtEdadNuevo" name="txtEdadNuevo" class="form-control" placeholder="Edad"  name="" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Sexo</label>
                                        <select class="form-control" id="listSexoNuevo" name="listSexoNuevo" required >
                                        <option value="">Selecciona un Sexo</option>
                                        <option value="H">H</option>
                                        <option value="M">M</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>CP</label>
                                        <input type="text" id="txtCPNuevo" name="txtCPNuevo" class="form-control" placeholder="CP"  name="" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Colonia</label>
                                        <input type="text" id="txtColoniaNuevo" name="txtColoniaNuevo" class="form-control" placeholder="Colonia"  name="" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Telefono Celular</label>
                                        <input type="text" id="txtTelCelNuevo" name="txtTelCelNuevo" class="form-control" placeholder="Telefono Celular"  name="" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Telefono Fijo</label>
                                        <input type="text" id="txtTelFiNuevo" name="txtTelFiNuevo" class="form-control" placeholder="Telefono Fijo"  name="" required>
                                    </div>  
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" id="txtEmailNuevo" name="txtEmailNuevo" class="form-control" placeholder="Email"  name="" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Estado Civil</label>
                                        <select class="form-control" id="listEstadoCivilNuevo" name="listEstadoCivilNuevo" required >
                                        <option value="">Selecciona un Estado</option>
                                        <option value="Soltero">Soltero(a)</option>
                                        <option value="Casado">Casado(a)</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Ocupacion</label>
                                        <input type="text" id="txtOcupacionNuevo" name="txtOcupacionNuevo" class="form-control" placeholder="Ocupacion"  name="" required>
                                    </div> 
                                    <div class="form-group">
                                        <label>Escolaridad</label>
                                        <select class="form-control" id="listEscolaridadNuevo" name="listEscolaridadNuevo" required >
                                            <option value="">Selecciona una Escolaridad</option>
                                            <?php 
                                                foreach ($data['grados_estudios'] as $value) {
                                                    ?>
                                                        <option value="<?php echo $value['id'] ?>" ><?php echo $value['nombre_escolaridad'] ?></option>                
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select class="form-control" id="listEstadoNuevo" name="listEstadoNuevo" onchange="estadoSeleccionado(value)" required >
                                            <option value="">Selecciona un Estado</option>
                                            <?php 
                                                foreach ($data['estados'] as $value) {
                                                    ?>
                                                        <option value="<?php echo $value['id'] ?>" ><?php echo $value['nombre'] ?></option>                
                                                    <?php
                                                }    
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Municipio</label>
                                        <select class="form-control" id="listMunicipioNuevo" name="listMunicipioNuevo" onchange="municipioSeleccionado(value)" required >
                                            <option value="">Selecciona un Municipio</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Localidad</label>
                                        <select class="form-control" id="listLocalidadNuevo" name="listLocalidadNuevo" required >
                                        <option value="">Selecciona una Localidad</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Categoria Persona</label>
                                        <select class="form-control" id="listCategoriaNuevo" name="listCategoriaNuevo" required >
                                        <option value="">Selecciona una Categoriía</option>
                                        <?php 
                                            foreach ($data['categoria_persona'] as $value) {
                                                ?>
                                                    <option value="<?php echo $value['id'] ?>"><?php echo $value['nombre_categoria'] ?></option>
                                                <?php
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Estatus</label>
                                        <select class="form-control" id="listEstatusNuevo" name="listEstatusNuevo" required >
                                        <option value="">Selecciona un Estatus</option>
                                        <option value="1">Activo</option>
                                        <option value="2">Inactivo</option>
                                        </select>
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalNuevo"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                    <button id="btnActionFormNuevo" type="submit" class="btn btn-outline-secondary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Guardar</span></button>
                </div>   
            </form> 
        </div>
    </div>
</div>