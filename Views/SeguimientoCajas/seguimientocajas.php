<?php
  headerAdmin($data);
?>
<div id="contentAjax"></div>
<div class="wrapper">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-7">
                        <h1 class="m-0">
                            <?= $data['page_title']?>
                        </h1>
                    </div>
                    <div class="col-sm-5">
                        <ol class="breadcrumb float-sm-right btn-block">
                            <button type="button" onclick="openModal();"
                                class="btn btn-inline btn-primary btn-sm btn-block">
                                <i class="fa fa-plus-circle fa-md">Nuevo</i>
                            </button>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 row">
                        <!--
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="myChart" style="width:100%;max-width:100%"></canvas>
                                </div>
                            </div>
                        </div>-->
                        <!--
                        <div class="col-4 overflow-auto" style="height:435px;">
                            <div class="card">
						        <div class="card-body">
							        <div class="row">
								        <div class="col mt-0">
									        <h5 class="card-title">SEUAT Tuxtla Gutierrez</h5>
								        </div>
                                        <div class="col-auto">
                                            <div class="avatar">
                                                <div class="avatar-title rounded-circle bg-primary-light">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                                                </div>
                                            </div>
                                        </div>
							        </div>
							        <h1 class="mt-1 mb-3 plnt">$125,000.00  <i class="fas fa-arrow-alt-circle-up" style="color:#20c997"></i></h1>
                                    <div class="mb-0">
                                        <span class="text-muted">Click aquí para </span>
								        <a class="btn" href="http://10.10.2.185/erp-seuat-v2/Plantel" role="button"><span class="badge badge-primary"> <i class="mdi mdi-arrow-bottom-right"></i> ver más </span></a>
							        </div>
						        </div>
					        </div>
                            <div class="card">
						        <div class="card-body">
							        <div class="row">
								        <div class="col mt-0">
									        <h5 class="card-title">SEUAT Reforma</h5>
								        </div>
                                        <div class="col-auto">
                                            <div class="avatar">
                                                <div class="avatar-title rounded-circle bg-primary-light">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                                                </div>
                                            </div>
                                        </div>
							        </div>
							        <h1 class="mt-1 mb-3 plnt">$25,000.00 <i class="fas fa-arrow-alt-circle-down" style="color:red"></i> </h1>
                                    <div class="mb-0">
                                        <span class="text-muted">Click aquí para </span>
								        <a class="btn" href="http://10.10.2.185/erp-seuat-v2/Plantel" role="button"><span class="badge badge-primary"> <i class="mdi mdi-arrow-bottom-right"></i> ver más </span></a>
							        </div>
						        </div>
					        </div>
                            <div class="card">
						        <div class="card-body">
							        <div class="row">
								        <div class="col mt-0">
									        <h5 class="card-title">SEUAT Reforma</h5>
								        </div>
                                        <div class="col-auto">
                                            <div class="avatar">
                                                <div class="avatar-title rounded-circle bg-primary-light">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                                                </div>
                                            </div>
                                        </div>
							        </div>
							        <h1 class="mt-1 mb-3 plnt">$25,000.00 <i class="fas fa-arrow-alt-circle-down" style="color:red"></i> </h1>
                                    <div class="mb-0">
                                        <span class="text-muted">Click aquí para </span>
								        <a class="btn" href="http://10.10.2.185/erp-seuat-v2/Plantel" role="button"><span class="badge badge-primary"> <i class="mdi mdi-arrow-bottom-right"></i> ver más </span></a>
							        </div>
						        </div>
					        </div>
                            <div class="card">
						        <div class="card-body">
							        <div class="row">
								        <div class="col mt-0">
									        <h5 class="card-title">SEUAT Reforma</h5>
								        </div>
                                        <div class="col-auto">
                                            <div class="avatar">
                                                <div class="avatar-title rounded-circle bg-primary-light">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                                                </div>
                                            </div>
                                        </div>
							        </div>
							        <h1 class="mt-1 mb-3 plnt">$25,000.00 <i class="fas fa-arrow-alt-circle-down" style="color:red"></i> </h1>
                                    <div class="mb-0">
                                        <span class="text-muted">Click aquí para </span>
								        <a class="btn" href="http://10.10.2.185/erp-seuat-v2/Plantel" role="button"><span class="badge badge-primary"> <i class="mdi mdi-arrow-bottom-right"></i> ver más </span></a>
							        </div>
						        </div>
					        </div>
                            

                        </div>      -->
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header border-0">
                                    <h4 class="card-title">Cajeros</h4>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="transaction-table">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th scope="col"></th>
                                                        <th scope="col">Sistema</th>
                                                        <th scope="col">Plantel</th>
                                                        <th scope="col">Cajero</th>
                                                        <th scope="col">Caja</th>
                                                        <th scope="col">Ventas</th>
                                                        <th scope="col">Estatus</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($data['cajeros'] as $key => $cajero) {  ?>
                                                        <tr>
                                                            <th scope="row"><i class="fas fa-arrow-alt-circle-down" style="color:red"></i></th>
                                                            <td><?php echo $cajero['nombre_sistema'] ?></td>
                                                            <td><?php echo $cajero['nombre_plantel'] ?></td>
                                                            <td><?php echo($cajero['nombre_persona'].' '.$cajero['ap_paterno'].' '.$cajero['ap_materno']) ?></td>
                                                            <td><?php echo $cajero['nombre_caja']?></td>
                                                            <td><?php echo $cajero['total_venta'] ?></td>
                                                            <?php 
                                                                if($cajero['estatus_caja'] == 1){ ?>
                                                                    <td><span class="badge badge-success">Abieto</span></td>
                                                                <?php } else{ ?>
                                                                    <td><span class="badge badge-danger">Cerrado</span></td>
                                                                <?php }
                                                            ?>
                                                        </tr>
                                                    <?php }?>                  
                                                </tbody>
                                            </table>
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