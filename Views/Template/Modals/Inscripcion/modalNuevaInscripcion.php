<!-- Modal -->
<div class="modal fade" id="ModalFormNuevaInscripcion" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModalNuevo">Nueva Inscripcion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <nav>
                        <div class="nav nav-pills nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-link tab-nav" id="step1-tab" data-toggle="tab" href="" onclick="fnNavTab(0)">Persona</a>
                            <a class="nav-link tab-nav" id="step2-tab" data-toggle="tab" href="" onclick="fnNavTab(1)">Tutor</a>
                        </div>
                    </nav>
                    <form id="formInscripcionNueva" name="formInscripcionNueva">
                        <input type="hidden" id="idNuevo" name="idNuevo" value="">
                        <input type="hidden" id="idPersonaSeleccionada" name="idPersonaSeleccionada" value="">
                        <div class="card-body"> 
                                <div class="tab">
                                    <div class = "col-8">
                                        <div class="form-group">
                                            <label>Nombre de la Persona</label>
                                            <div class="row">
                                                <input type="text" id="txtNombreNuevo" name="txtNombreNuevo" class="form-control col-8" placeholder="Nombre de la Persona"  name="" readonly required>
                                                <p class="col-1"></p>
                                                <button type="button" class="btn btn-primary col-3" data-toggle="modal" data-target="#modalNombrePersona"><i class="fa fa-search"></i> Buscar</button>
                                            </div>    
                                        </div>
                                        <div class="form-group">
                                            <label>Plantel</label>
                                            <select class="form-control" id="listPlantelNuevo" name="listPlantelNuevo" onchange="fnPlantelSeleccionado(value)" required>
                                                <option value="">Selecciona el Plantel</option>
                                                <?php 
                                                    foreach ($data['planteles'] as $value) {
                                                        ?>
                                                            <option value="<?php echo $value['id'] ?>"><?php echo $value['nombre_plantel'] ?></option>
                                                        <?php
                                                    }    
                                                ?>
                                            </select>                                    
                                        </div>
                                        <div class="form-group">
                                            <label>Carrera</label>
                                            <select class="form-control" id="listCarreraNuevo" name="listCarreraNuevo" required>
                                                <option value="">Selecciona la Carrera</option>
                                            </select>                                    
                                        </div>
                                    </div>    
                                </div>
                                <div class="tab">
                                    <div class="row">
                                        <div class = "col-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="chk-alumno-tutor" onclick="fnChkAlumnoTutor()">
                                                <label class="form-check-label">Asignar el alumno como Tutor</label>
                                            </div><br>
                                            <div class="form-group">
                                                <label>Nombre</label>
                                                <input type="text" id="txtNombreTutorAgregar" name="txtNombreTutorAgregar" class="form-control" placeholder="Nombre"  name="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Apellido Paterno</label>
                                                <input type="text" id="txtAppPaternoTutorAgregar" name="txtAppPaternoTutorAgregar" class="form-control" placeholder="Apellido Paterno"  name="" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Apellido Materno</label>
                                                <input type="text" id="txtAppMaternoTutorAgregar" name="txtAppMaternoTutorAgregar" class="form-control" placeholder="Apellido Materno"  name="" required>
                                            </div>
                                        </div>    
                                        <div class = "col-6">
                                            <div class="form-group">
                                                <label>Teléfono Celular</label>
                                                <input type="text" id="txtTelCelularTutorAgregar" name="txtTelCelularTutorAgregar" class="form-control" placeholder="Telefono Celular"  name="">
                                            </div>
                                            <div class="form-group">
                                                <label>Teléfono Fijo</label>
                                                <input type="text" id="txtTelFijoTutorAgregar" name="txtTelFijoTutorAgregar" class="form-control" placeholder="Telefono Fijo"  name="">
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" id="txtEmailTutorAgregar" name="txtEmailTutorAgregar" class="form-control" placeholder="Email"  name="">
                                            </div>
                                        </div>    
                                    </div>   
                                </div>    
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row col-12">
                        <div class="col-4">
                            <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalNuevo"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                        </div>
                        <div class="col-4 text-center">
                                <span class="step"></span>
                                <span class="step"></span>
                        </div>
                        <div class="col-4">
                            <div style="overflow:auto;">
                                <div style="float:right;">
                                    <button class="btn btn-primary" type="button" id="btnAnterior" onclick="pasarTab(-1)">Anterior</button>
                                    <button class="btn btn-primary" type="button" id="btnSiguiente" onclick="pasarTab(1)">Siguiente</button>
                                    <button class="btn btn-success" type="submit" id="btnActionFormNuevo">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="dimissModalNuevo"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>-->
                    <!--<button id="btnActionFormNuevo" type="submit" class="btn btn-outline-secondary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Guardar</span></button>-->
                </div>   
            </form> 
        </div>
    </div>
</div>








<div class="modal fade" id="modalNombrePersona" tabindex="-1" role="dialog" aria-labelledby="modalNombrePersonaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNombrePersonaNLabel">Buscar Persona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="busquedaPersona" placeholder="Nombre de la Persona" maxlength="100" autocomplete="off" onKeyUp="buscarPersona();" />
                <br>
                <table id="tablePersonas" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Nombre Alumno</th>
                            <th width="15%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="cerrarModalBuscarPersona">Cerrar</button>
            </div>
        </div>
    </div>
</div>