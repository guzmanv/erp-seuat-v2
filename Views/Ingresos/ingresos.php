<?php
    headerAdmin($data);
    getModal("Ingresos/modalBuscarPersona",$data);
    getModal("Ingresos/modalGenerarEdoCuenta",$data);
    getModal("Ingresos/modalCobrar",$data);
?>
<div id="contentAjax"></div>
<div class="wrapper">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-7">
                        <h1 class="m-0"><?= $data['page_title'] ?></h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row col-12">
                                    <?php if($data['estatus_caja']['estatus_caja'] == 1){ ?>
                                        <div class="col-12 row">
                                            <div class="form-group col-md-4 col-sm-12">
                                                <input type="text" id="txtNombreNuevo" name="txtNombreNuevo" class="form-control" placeholder="Nombre de la persona a buscar"  name="" readonly required> 
                                            </div>
                                            <div class="form-group col-md-4 col-sm-12">
                                                <button type="button" class="btn btn-primary col-md-4 col-sm-12" data-toggle="modal" data-target="#modalNombrePersona"><i class="fa fa-search"></i> Buscar</button>
                                            </div>
                                        </div>
                                        <div class="col-12" id="alertAgregarAlumno">
                                            <div class="col-md-6 alert alert-warning alert-dismissible fade show m-auto" role="alert">
                                                <strong>Aviso!</strong> Para agregar servicios, primero agrega un alumno, click en <b>buscar</b>.
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <div class="col-md-3 p-0">
                                            <label>Que desea cobrar?</label>
                                            <select class="form-control" id="listTipoCobro"  name="listTipoCobro" onchange="fnTiposCobro(value)" style="width: 100%;" required >
                                                <option value="">Selecciona una</option>
                                                <option value="1">Colegiaturas mensuales</option>
                                                <option value="2">Otros servicios</option>
                                            </select></div>
                                        </div>
                                        <div class="form-group col-md-2 listGrado">
                                            <label>Grado</label>
                                            <select class="form-control" id="listGrado" onchange="fnChangeGrado(value)" required >
                                                <option value="">Selecciona un grado</option>
                                                <option value="1">1</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4 listServicios">
                                            <label>Servicios</label>
                                            <select class="form-control form-control-sm select2" id="listServicios"  name="listServicios" onchange="fnServicioSeleccionado(value)" style="width: 100%;" required >
                                                <option value="">Selecciona un servicio</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4 listPromociones">
                                            <label>Promociones</label>
                                            <div class="select2-blue">
                                                <select class="select2 form-control" multiple="multiple" id="listPromociones"  name="listPromociones" data-placeholder="Seleccciona una promocion" data-dropdown-css-class="select2-blue" style="width: 100%;" required>
            
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2" style="display:flex;align-items:end">
                                            <button type="button" id="btnAgregarServicio" class="btn btn-primary btn-block form-control" onclick="fnBtnAgregarServicioTabla()"><i class="fa fa-plus"></i>Agregar</button>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <hr>
                                        </div>
                                        <div class="form-group table-responsive"> 
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nombre del servicio</th>
                                                        <th>Precio unitario</th>
                                                        <th>Cantidad</th>
                                                        <th>Descuento</th>
                                                        <th>Subtotal</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tableServicios">
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="form-group col-md-12 d-flex flex-row-reverse">
                                            <p><span>Subtotal: </span><b id="txtSubtotal">$0.00</b></p>
                                        </div>
                                        <div class="form-group col-md-12 d-flex flex-row-reverse">
                                            <p><span>Descuento: </span><b id="txtDescuento">0.00 %</b></p>
                                        </div>
                                        <div class="form-group col-md-12 d-flex flex-row-reverse">
                                            <h3><span>Total: </span><b id="txtTotal">$0.00</b></h3>
                                        </div>
                                        <div class="col-md-12 row" id="alertSinEdoCta">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-6 alert alert-warning alert-dismissible fade show" role="alert">
                                                <strong>Aviso!</strong> El alumno seleccionado no tiene un estado de cuenta, para poder pagar servicios es necesario tener uno, click en el boton para generar!.
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button><br>
                                                <div class="col-md-12"><div class="form-group m-auto" style="display:flex;align-items:end">
                                                    <button type="button" class="btn btn-secondary btn-block form-control" onclick="fnGenerarEstadoCuenta()"><i class="fas fa-dollar-sign"></i></i> Generar estado de cuenta</button>
                                                </div></div>
                                            </div>
                                            <div class="col-md-3"></div>
                                        </div>
                                        <div class="form-group col-md-12 d-flex flex-row-reverse">
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-success btn-lg col-md-12" data-toggle="modal" data-target="#modalCobrar" onclick="fnButtonCobrar()"><i class="fas fa-dollar-sign mr-3"></i><b>COBRAR</b></button>
                                            </div>
                                        </div>
                                    <?php }else{ ?>
                                        <div class="col-12 d-flex justify-content-center">
                                            <div class="card col-3">
						                        <div class="card-body">
							                        <div class="row">
								                        <div class="col mt-0">
									                        <h5 class="card-title">CAJA 1</h5>
								                        </div>
                                                        <div class="col-auto">
                                                            <div class="avatar">
                                                                <div class="avatar-title rounded-circle bg-primary-light">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                                                                </div>
                                                            </div>
                                                        </div>
							                        </div>
							                        <img src="<?php echo media() ?>/images/icons/close.png" width="80px"></img>
                                                    <span class="badge badge-warning">Cerrado</span>
                                                    <div class="m-2 text-center">
                                                        <button type="button" class="btn btn-primary btn-sm" onclick="fnAperturarCaja(<?php echo($data['estatus_caja']['id_caja']) ?>)">clik aqui para aperturar</button>
							                        </div>
						                        </div>
					                        </div>
                                        </div>
                                    <?php } ?>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php footerAdmin($data); ?>