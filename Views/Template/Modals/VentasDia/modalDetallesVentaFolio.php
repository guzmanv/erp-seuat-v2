<!-- Modal -->
<div class="modal fade" id="modalVentaDetallesDia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalles Venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12 col-xl-12">
		            <div class="card">
				        <div class="card-header">
					        <h5 class="card-title">Folio: <span id="folioDetallesVenta"></span></h5>
					        <h6 class="card-subtitle text-muted m-auto"> &nbsp&nbsp&nbsp<i><span id="observacionIngreso"></span></i></h6>
				        </div>
				        <table class="table">
					        <thead>
						        <tr>
							        <th style="width:5%;">No</th>
							        <th style="width:30%">Concepto</th>
							        <th style="width:25%">Precio unitario</th>
							        <th style="width:40%">Promociones</th>
						        </tr>
					        </thead>
					        <tbody id="tableDetallesVentaModal">
						        <tr>
							        <td>1</td>
							        <td>CREDENCIAL</td>
							        <td>$100.00</td>
							        <td><span class="badge badge-primary m-1">Promocion 1(10%)</span><span class="badge badge-primary m-1">Promocion 2(12%)</span><span class="badge badge-primary m-1">Promocion 3(14%)</span></td>
								</tr>
								<tr class="table-primary">
                                    <td>1</td>
							        <td>UNIFORME ENFERMERIA</td>
									<td>$100.00</td>		
									<td><span class="badge badge-primary m-1">Promocion 3(18%)</span></td>		
								</tr>
								<tr>
                                    <td>1</td>
							        <td>CARTA PASANTE</td>
									<td>$100.00</td>		
									<td><span class="badge badge-primary m-1">Promocion 8(13%)</span></td>		
								</tr>
								<tr class="table-success">
                                    <td>1</td>
							        <td>INSCRIPCION</td>
									<td>$100.00</td>	
									<td><span class="badge badge-primary m-1">Promocion 4(11%)</span></td>	
								</tr>
								<tr>
                                    <td>1</td>
							        <td>TRAMITE DOCUMENTOS</td>
									<td>$100.00</td>		
									<td></td>		
								</tr>
							</tbody>
						</table>
					</div>
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>