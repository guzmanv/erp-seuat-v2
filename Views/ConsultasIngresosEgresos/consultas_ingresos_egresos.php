<?php
    headerAdmin($data);
    getModal('ConsultasIngresosEgresos/modalBuscarAlumno',$data);
    //getModal('CategoriaCarrera/modalVerCategoriaCarrera',$data);
    //getModal('CategoriaCarrera/modalEditCategoriaCarrera',$data);
?>
<div id="contentAjax"></div>
<div class="wrapper">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-7">
                        <h1 class="m-0">  <?= $data['page_title'] ?></h1>
                    </div>
                    <div class="col-sm-5">
                        <ol class="breadcrumb float-sm-right btn-block">
                            <!--<button type="button"  class="btn btn-inline btn-primary btn-sm btn-block" data-toggle="modal" data-target="#ModalFormNuevaCategoriaCarrera"><i class="fa fa-plus-circle fa-md"></i> Nuevo</button>-->
                        </ol>
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
                                <div class="col-12 row">
                                <div class="col-md-6 col-sm-12">
                                        <h3 class="card-title">Estados de cuenta</h3><br>                                
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="d-flex justify-content-end">
                                            <div class="col-6"><input type="text" id="txtNombrealumno" class="form-control" placeholder="Matricula o RFC"></div>
                                            <div class="col-2"><button type="button" id="btnBuscar" class="btn btn-primary">Buscar</button></div>
                                            <div class="col-1"><p>o</p></div>
                                            <div class="col-4"><button type="button" id="btnBuscarAlumno"class="btn btn-primary" data-toggle="modal" data-target="#ModalBuscarAlumno">Buscar por Nombre</button></div>
                                        </div> 
                                    </div>
                                    <div class="col-12 row">
                                        <div class="col-8 text-center"><h1 id="nomAlumEdoCta"></h1></div>
                                        <div class="col-4 mt-2" style="text-align:right"><button type="button" id="btnImprimirEdoCta" class="btn btn-secondary">Imprimir</button></div>
                                    </div>
                                </div>                             
                                <p class="card-text">
                                    <table id="tableEstadoCuenta" class="table table-bordered table-striped table-hover table-sm">
                                        <thead>
                                            <tr>
                                                <th width="5%">#</th>
                                                <th>Fecha</th>
                                                <th>Concepto</th>
                                                <th>Subconcepto</th>
                                                <th>Descripcion</th>
                                                <th>Cargo</th>
                                                <th>Abono</th>
                                                <th>Fecha pago</th>
                                                <th>Referencia</th>
                                                <th>Tipo comprobante</th>
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


