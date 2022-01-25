<div class="modal fade" id="modalFormListaInscritos" tabindex="-1" role="dialog" aria-labelledby="modalNombrePersonaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lista de Inscritos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tableListaInscritos" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th class="text-center"><input id="checkAllInscritos" onclick="fnCheckAllInscritos()" type="checkbox" aria-label="check"></th>
                            <th>#</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Inscripcion</th>
                            <th>Solicitud</th>
                        </tr>
                    </thead>
                    <tbody id="valoresListaInscritos">
                    </tbody>
                </table>
                <div class="form-group col-md-12 row">
                    <div class="col-md-4"><p>Con los usuarios seleccionados...</p></div>
                    <select class="form-control form-control-sm col-md-6" id="listAccionesUsSel" onchange="accionesUsuariosSeleccionados(value)" name="listAccionesUsSel" required disabled>
                        <option value="">Elegir...</option>                            
                        <option value="0">Cancelar</option>                            
                        <option value="1">Posponer a una nuevo ciclo</option>                            
                    </select>                                    
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-outline-secondary icono-color-principal btn-inline" href="#" data-dismiss="modal" id="cerrarModalListaInscritos"><i class="fa fa-fw fa-lg fa-times-circle icono-azul"></i>Cerrar</a>
            </div>
        </div>
    </div>
</div>