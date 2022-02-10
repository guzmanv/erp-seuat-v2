<?php
    headerAdmin($data);
    //getModal('VentasDia/modalVentasDia',$data);
    //getModal('VentasDia/modalDetallesVentaFolio',$data);
    var_dump($data);
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
                                    <!--Datos del Dia-->
                                    <div class="col-md-12">
                                        <div class="card p-2">
                                            <div class="card-body">
                                                <div class="row">
                                                    <label>Corte de caja No.</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" placeholder="000002">
                                                        <div class="input-group-append">
                                                            <span type="button" class="input-group-text" id="basic-addon2">Buscar</span>
                                                        </div>
                                                    </div>
                                                    <label>Cajero.</label>
                                                    <div class="input-group">
                                                        <select class="custom-select">
                                                            <option selected>Seleccionar...</option>
                                                            <option value="1">Jose Santiz</option>
                                                            <option value="2">Francisco Perez</option>
                                                            <option value="3">Emmanuel Espinoza</option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label>Desde.</label>
                                                        <input type="date" class="form-control" placeholder="">
                                                        <label>Hasta.</label>
                                                        <input type="date" class="form-control" placeholder="">
                                                    </div>
                                                    <div class="row col-12">
                                                        <div class="col-6"><label>Segun Sistema</label></div>
                                                        <div class="col-6"><label>Segun Sistema</label></div>
                                                    </div>
                                               </div>
                                            </div>
                                        </div>public function cortecaja()
		{
			$data['page_id'] = 2;
			$data['page_tag'] = "Corte caja";
			$data['page_title'] = "Corte caja";
			$data['page_name'] = "Corte caja";
			$this->views->getView($this,"cortecaja",$data);
		}
                                    </div>
                                </div>
                                <p class="card-text">
                                    <table id="tableVentasDia" class="table table-bordered table-striped table-hover table-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Folio</th>
                                                <th>Estudiante</th>
                                                <th>Plantel</th>
                                                <th>Carrera</th>
                                                <th>Grado</th>
                                                <th>Fecha</th>dfs
                                                <th>Factura</th>
                                                <th>Total</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </p>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php footerAdmin($data); ?>