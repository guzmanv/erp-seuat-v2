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
                                    <div class="form-group col-md-4">
                                        <label>Nombre</label>
                                        <input type="text" id="txtNombreNuevo" name="txtNombreNuevo" class="form-control form-control-sm" placeholder="Nombre" maxlength="45" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Apellido Paterno</label>
                                        <input type="text" id="txtApellidoPaNuevo" name="txtApellidoPaNuevo" class="form-control form-control-sm" placeholder="Apellido paterno" maxlength="70" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Apellido Materno</label>
                                        <input type="text" id="txtApellidoMaNuevo" name="txtApellidoMaNuevo" class="form-control form-control-sm" placeholder="Apellido materno" maxlength="70" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Sexo</label>
                                        <select class="form-control form-control-sm" id="listSexoNuevo" name="listSexoNuevo" required >
                                        <option value="">Seleccionar</option>
                                        <option value="H">H</option>
                                        <option value="M">M</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Edad</label>
                                        <input type="number" id="txtEdadNuevo" name="txtEdadNuevo" class="form-control form-control-sm" placeholder="Edad"  min = "0" max="120" onkeypress="return validarNumeroInput(event)" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Estado Civil</label>
                                        <select class="form-control form-control-sm" id="listEstadoCivilNuevo" name="listEstadoCivilNuevo" required >
                                        <option value="">Seleccionar</option>
                                        <option value="Soltero">Soltero(a)</option>
                                        <option value="Casado">Casado(a)</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Fecha de Nacimiento</label>
                                        <input type="date" id="txtFechaNacimientONuevo" name="txtFechaNacimientONuevo" class="form-control form-control-sm"   max=" " required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>CURP</label>
                                        <input type="text" id="txtCURPNuevo" name="txtCURPNuevo" class="form-control form-control-sm" placeholder="CURP" maxlength="18">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Ocupacion</label>
                                        <input type="text" id="txtOcupacionNuevo" name="txtOcupacionNuevo" class="form-control form-control-sm" placeholder="Ocupacion"  maxlength="50" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Telefono Celular</label>
                                        <input type="text" id="txtTelCelNuevo" name="txtTelCelNuevo" class="form-control form-control-sm" placeholder="Telefono celular"    onkeypress="return validarNumeroInput(event)" maxlength="10" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Telefono Fijo</label>
                                        <input type="text" id="txtTelFiNuevo" name="txtTelFiNuevo" class="form-control form-control-sm" placeholder="Telefono fijo"  onkeypress="return validarNumeroInput(event)" maxlength="10" >
                                    </div> 
                                    <div class="form-group col-md-4">
                                        <label>Escolaridad</label>
                                        <select class="form-control form-control-sm" id="listEscolaridadNuevo" name="listEscolaridadNuevo" required >
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
                                    <div class="form-group col-md-4">
                                        <label>Plantel de interés</label>
                                        <select class="form-control form-control-sm" id="listPlantelInteres" name="listPlantelInteres">
                                            <option value="">Seleccionar</option>
                                            <?php  foreach ($data['planteles'] as $key => $plantel) { ?>
                                                <option value="<?php echo $plantel['id'] ?>"><?php echo($plantel['nombre_plantel'].'('.$plantel['municipio'].')') ?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Nivel carrera de interés</label>
                                        <select class="form-control form-control-sm" id="listNivelCarreraInteres" name="listNivelCarreraInteres" onchange="nivelCarreraInteresSeleccionado(value)" >
                                            <option value="">Seleccionar</option>
                                        <?php 
                                            foreach ($data['grados_estudios'] as $value) {
                                                ?>
                                                    <option value="<?php echo $value['id'] ?>"><?php echo $value['nombre_escolaridad'] ?></option>
                                                <?php
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Carrera de interés</label>
                                        <select class="form-control form-control-sm" id="listCarreraInteres" name="listCarreraInteres" >
                                            <option value="">Seleccionar</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Medio de captación</label>
                                        <select class="form-control form-control-sm" id="listMediosCaptacion" name="listMediosCaptacion" >
                                            <option value="">Seleccionar</option>
                                            <?php  foreach ($data['medios_captacion'] as $key => $medios) { ?>
                                                <option value="<?php echo $medios['id'] ?>"><?php echo($medios['medio_captacion']) ?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label>Escuela de procedencia</label>
                                        <input type="text" id="txtNombreEscuelaProc" name="txtNombreEscuelaProc" class="form-control form-control-sm" placeholder="Nombre de la escuela de procedencia" maxlength="100">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Email</label>
                                        <input type="email" id="txtEmailNuevo" name="txtEmailNuevo" class="form-control form-control-sm" placeholder="Email" maxlength="50">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Estado</label>
                                        <select class="form-control form-control-sm" id="listEstadoNuevo" name="listEstadoNuevo" onchange="estadoSeleccionado(value)" required >
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
                                    <div class="form-group col-md-4">
                                        <label>Municipio</label>
                                        <select class="form-control form-control-sm" id="listMunicipioNuevo" name="listMunicipioNuevo" onchange="municipioSeleccionado(value)" required >
                                            <option value="">Selecciona un Municipio</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Localidad</label>
                                        <select class="form-control form-control-sm" id="listLocalidadNuevo" name="listLocalidadNuevo" required >
                                        <option value="">Selecciona una Localidad</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-10">
                                        <label>Colonia</label>
                                        <input type="text" id="txtColoniaNuevo" name="txtColoniaNuevo" class="form-control form-control-sm" placeholder="Colonia" maxlength="45" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>CP</label>
                                        <input type="text" id="txtCPNuevo" name="txtCPNuevo" class="form-control form-control-sm" placeholder="CP"    onkeypress="return validarNumeroInput(event)" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Direccion</label>
                                        <textarea  id="txtDireccionNuevo" name="txtDireccionNuevo" class="form-control form-control-sm" placeholder="Direccion"  maxlength="100" required></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Observación</label>
                                        <textarea id="txtObservacion" name="txtObservacion" class="form-control form-control-sm" placeholder="Observación" maxlength="200" ></textarea>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalNuevo"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                    <button id="btnActionFormNuevo" type="submit" class="btn btn-outline-secondary icono-color-principal btn-primary btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Guardar</span></button>
                </div>   
            </form> 
        </div>
    </div>
</div>