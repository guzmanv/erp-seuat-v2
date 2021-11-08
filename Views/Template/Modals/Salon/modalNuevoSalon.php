<div class="modal fade" id="ModalFormNuevoSalon" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerUpdate">
                <h5 class="modal-title" id="titleModalEdit">Nuevo salón</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formSalonNuevo" name="formSalonNuevo">
                        <input type="hidden" id="idEdit" name="idEdit" value="">
                        <div class="card-body"> 
                            <div class="form-group">
                                <label>Nombre salón</label>
                                <input type="text" id="txtNombreEdit" name="txtNombreEdit" class="form-control form-control-sm" placeholder="EJ: Salón 1"  name="" maxlength="45" required>
                            </div>
                            <div class="form-group">
                              <label for="">Cantidad máx. alumnos</label>
                              <input type="text" id="txtCantidadMax" name="txtCantidadMax" class="form-control form-control-sm" placeholder="EJ: 10,15,20" required>
                            </div>
                            <div class="form-group">
                                <label>Periodo</label>
                                <select class="form-control form-control-sm" name="listPeriodo" id="listPeriodo" required>
                                  <option value="">Seleccione un periodo</option>
                                  <?php
                                  foreach($data['periodo'] as $value){
                                  ?>
                                  <option value="<?php echo $value['id'] ?>"><?php echo($value['nombre_periodo']) ?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Grado</label>
                                <select name="listGrado" id="listGrupo" class="form-control form-control-sm" required>
                                  <option value="">Seleccione un grado</option>
                                  <?php
                                  foreach($data['grado'] as $value){
                                  ?>
                                  <option value="<?php echo $value['id'] ?>"><?php echo($value['nombre_grado']) ?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Grupo</label>
                                <select class="form-control form-control-sm" id="listGrupo" name="listGrupo" required >
                                  <option value="">Seleccione un grupo</option>
                                  <?php
                                  foreach($data['grupo'] as $value){
                                  ?>
                                  <option value="<?php echo $value['id'] ?>"><?php echo ($value['nombre_grupo']) ?></option>
                                  <?php
                                  }
                                  ?>
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