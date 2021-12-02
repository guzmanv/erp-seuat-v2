<?php
    headerAdmin($data);
    //getModal("Ingresos/modalPagosServicios",$data);
    getModal("Ingresos/modalBuscarPersona",$data);
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nombre de la Persona</label>
                                            <div class="row">
                                                <div class="col-md-4"><input type="text" id="txtNombreNuevo" name="txtNombreNuevo" class="form-control form-control-sm" placeholder="Nombre de la Persona"  name="" readonly required></div>
                                                <div class="col-md-3"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalNombrePersona"><i class="fa fa-search"></i> Buscar</button></div>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Servicios</label>
                                        <select class="form-control form-control-sm" id="listServicios" name="listServicios" onchange="fnServicioSeleccionado(value)"required >
                                            <option value="">Selecciona un servicio</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Promociones</label>
                                        <select class="form-control form-control-sm" id="listPromociones" name="listPromociones" onchange="fnPromocionSeleccionado(value)"required >
                                        <option value="">Selecciona una promocion</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>Cantidad</label>
                                        <input type="number" id="txtCantidad" name="txtCantidad" class="form-control form-control-sm" value="0">
                                    </div>
                                    <div class="form-group col-md-4" style="display:flex;align-items:end">
                                        <button type="button" class="btn btn-primary btn-block form-control btn-sm form-control-sm" onclick="fnBtnAgregarServicioTabla()"><i class="fa fa-plus"></i>Agregar</button>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <hr>
                                    </div>
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre del servicio</th>
                                                <th>Precio unitario</th>
                                                <th>Cantidad</th>
                                                <th>Descuento</th>
                                                <th>Subtotal</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableServicios">
                                        </tbody>
                                    </table>
                                    <div class="form-group col-md-12 d-flex flex-row-reverse">
                                        <h3><span>Total: </span><b id="txtTotal">$0.00</b></h3>
                                    </div>
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>Aviso!</strong> Para poder pagar servicios es necesario tener un estado de cuenta.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
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