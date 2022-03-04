<!-- Modal -->
<div class="modal fade" id="modalCorteCaja" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Corte de caja</h5>
                <button type="button" onclick="cerrarModla()"class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12 text-center">
                    <p><i class="fas fa-cash-register fa-3x"></i></p>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Cantidad a entregar</label>
                        <div class="text-center"><input type="text" class="form-control col-md-6 col-lg-6 m-auto" id="txtCantidadEntregar" placeholder="Ex: $1500.00" style="height:50px;font-size:24px"></div>
                    </div>   
                    <div class="form-group">
                        <select class="custom-select" id="listCajeros">
                            <option value="" selected>Seleccionar un cajero(a)</option>
                            <?php foreach ($data['cajeros'] as $key => $cajero) { ?>
                                <option value="<?php echo $cajero['id_caja'] ?>"><?php echo $cajero['nombre_persona'].' '.$cajero['ap_paterno'].' '.$cajero['ap_materno'] ?></option>
                            <?php }?>
                        </select>
                    </div>             
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" onclick="cerrarModla()"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cancelar</a>
                <button onclick="fnRealizarCorte()" type="submit" class="btn btn-outline-secondary btn-primary icono-color-principal btn-inline"><i class="fa fa-fw fa-lg fa-check-circle icono-azul"></i><span id="btnText"> Guardar</span></button>
            </div>
        </div>
    </div>
</div>