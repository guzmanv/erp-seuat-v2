    <?php
    headerAdmin($data);
    //getModal('VentasDia/modalVentasDia',$data);
    //getModal('VentasDia/modalDetallesVentaFolio',$data);
?>
<div class="wrapper">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-7">
                        <h1 class="m-0">  <?= $data['page_title'] ?></h1>
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
                                        <div class="card p-2">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Corte de caja No.</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" value="<?php echo substr(str_repeat(0,3).$data['corte_actual'],-3) ?>" disabled>
                                                            <div class="input-group-append">
                                                                <span type="button" class="input-group-text" id="basic-addon2">Buscar</span>
                                                            </div>
                                                        </div>
                                                        <label>Fecha</label>
                                                        <input type="text" class="form-control" value="<?php echo date("j/m/Y H:i:s A"); ?>">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label>Cajero</label>
                                                        <div class="input-group">
                                                            <select class="custom-select" onchange="fnSelectCajero(value)">
                                                                <option value="">Seleccionar...</option>
                                                                <?php foreach ($data['cajeros'] as $key => $cajero) { ?>
                                                                    <option value="<?php echo $cajero['id_caja'] ?>"><?php echo $cajero['nombre_persona'].' '.$cajero['ap_paterno'].' '.$cajero['ap_materno']  ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <label>Caja No</label>
                                                        <input type="text" id="num_caja" class="form-control" value="" disabled>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div>
                                                            <label>Desde.</label>
                                                            <input type="text" class="form-control" id="dateCorteDesde" placeholder="" value="" disabled>
                                                            <label>Hasta.</label>
                                                            <input type="text" class="form-control" id="dateCorteHasta" placeholder="" value="" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card p-2">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <table class="table table-striped col-md-12">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col"></th>
                                                                    <th scope="col">Segun sistema</th>
                                                                    <th scope="col">Segun caja</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <th scope="row">Efectivo</th>
                                                                    <td><input type="text" class="form-control" value="$10.00"></td>
                                                                    <td><input type="text" class="form-control" value="$20.00"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Cheque</th>
                                                                    <td><input type="text" class="form-control" value="$25.00"></td>
                                                                    <td><input type="text" class="form-control" value="$16.00"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Trajeta de crédito</th>
                                                                    <td><input type="text" class="form-control" value="$14.50"></td>
                                                                    <td><input type="text" class="form-control" value="$85.00"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Trajeta de débito</th>
                                                                    <td><input type="text" class="form-control" value="$14.00"></td>
                                                                    <td><input type="text" class="form-control" value="$98.00"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Tickets</th>
                                                                    <td><input type="text" class="form-control" value="$0.00"></td>
                                                                    <td><input type="text" class="form-control" value="$1000,00.00"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Total de ingresos</th>
                                                                    <td><input type="text" class="form-control" value="$1000.00"></td>
                                                                    <td><input type="text" class="form-control" value="$1000,00.00"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="card card-secondary">
                                                            <nav>
                                                                <div class="nav nav-pills nav-fill" id="nav-tab" role="tablist">
                                                                    <a class="nav-link tab-nav" id="step1-tab" data-toggle="tab" href="" >Efectivo</a>
                                                                    <a class="nav-link tab-nav" id="step2-tab" data-toggle="tab" href="" >Cheque</a>
                                                                    <a class="nav-link tab-nav" id="step3-tab" data-toggle="tab" href="" >Tarjeta crédito</a>
                                                                    <a class="nav-link tab-nav" id="step4-tab" data-toggle="tab" href="" >Tarjeta débito</a>
                                                                    <a class="nav-link tab-nav" id="step5-tab" data-toggle="tab" href="" >Tickets</a>
                                                                </div>
                                                            </nav>
                                                            <form>
                                                                <div class="card-body"> 
                                                                    <div class="tab">
                                                                        <div class="row">
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab">
                                                                        <div class="row">
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab">
                                                                        <div class="row">
                                                                            <div class="form-group col-md-4">
                                                                            </div>
                                                                        </div>               
                                                                    </div>   
                                                                    <div class="tab">
                                                                        <div class="row">
                                                                            <div class="form-group col-md-4">
                                                                                <label>Estado</label>
                                                                            </div>
                                                                        </div>               
                                                                    </div>
                                                                    <div class="tab">
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                
                                                                            </div>
                                                                        </div>               
                                                                    </div>    
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="card p-2">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <p class="card-text">
                                                            <table id="tableVentasDia" class="table table-bordered table-striped table-hover table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Fecha</th>
                                                                        <th>Codigo</th>
                                                                        <th>concepto</th>
                                                                        <th>Monto</th>
                                                                        <th>Referencia</th>
                                                                        <th>autorizado por</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Devoluciones.</label>
                                                        <input type="text" class="form-control" value="$100,500.00">
                                                        <label>Total egresos</label>
                                                        <input type="text" class="form-control" value="$250,245.00">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card p-2">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Total CAJA</label>
                                                        <input type="text" class="form-control" value="$200,500.00">
                                                        <label>Sobrante</label>   
                                                        <input type="text" class="form-control" value="$14,526.00">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Observaciones</label>
                                                        <textarea type="text" class="form-control" rows="4" placeholder="Username"></textarea>
                                                    </div>
                                                    <div class="col-md-2 block">
                                                        <button type="button" class="btn btn-primary col-12 mb-2 mt-2">Guardar</button>
                                                        <button type="button" class="btn btn-primary col-12">Imprimir</button>
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
            </div>
        </div>
    </div>
</div>

<?php footerAdmin($data); ?>