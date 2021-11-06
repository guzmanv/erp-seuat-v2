<!-- Modal -->
<div class="modal fade" id="ModalFormNuevoSalon" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModalNuevo">Nuevo salón</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <form id="formMateriaNueva" name="formMateriaNueva">
                        <input type="hidden" id="idNuevo" name="idNuevo" value="">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-9">
                                  <label for="">Nombre de salón</label>
                                  <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="EJ. Salón 1">
                                  
                                </div>
                                <div class="form-group col-md-3">
                                  <label for="">Cantidad alumnos</label>
                                  <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="EJ. 10, 15, 20">
                                  
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                  <label for="">Periodo</label>
                                  <select class="form-control" name="" id="">
                                    <option>Selecciona un periodo</option>
                                    <?php
                                      foreach ($data['periodo'] as $value) {
                                        ?>
                                        <option value="<?php echo $value['id']?>"><?php echo($value['nombre_periodo'])?></option>
                                        <?php
                                      }
                                    ?>
                                  </select>
                                </div>
                                <div class="form-group col-md-4">
                                  <label for="">Grado</label>
                                  <select class="form-control" name="" id="">
                                    <option>Selecciona un grado</option>
                                    <?php
                                    foreach ($data['grado'] as $value) {
                                    ?>
                                    <option value="<?php echo $value['id'] ?>"><?php echo($value['nombre_grado']) ?></option>
                                    <?php
                                    }
                                    ?>
                                  </select>
                                </div>
                                <div class="form-group col-md-4">
                                  <label for="">Grupo</label>
                                  <select class="form-control" name="" id="">
                                    <option>Selecciona un grupo</option>
                                    <?php
                                    foreach ($data['grupo'] as $value) {
                                    ?>
                                      <option value="<?php echo $value['id'] ?>"><?php echo($value['nombre_grupo']) ?></option>
                                    <?php
                                    }
                                    ?>
                                  </select>
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