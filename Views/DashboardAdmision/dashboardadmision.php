<?php
  headerAdmin($data);
  getModal("DashboardDirc/modalRvoesExp",$data);

?>

<div class="wrapper">
  <!-- Navbar -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo $data['page_tag']?></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <!-- CARDS DE TOTALES-->
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="col-lg-6 col-md-6">
                        <label>Selecciona una plantel</label>
                        <select class="custom-select" id="listPlataformas" onchange="plataformaSeleccionada(value)">
                            <option value="all" selected="">Todos</option>
                        <?php 
                        foreach ($data['planteles'] as $key => $value) {
                            ?>
                                <option value="<?php echo $value['id'] ?>"><?php echo($value['nombre_plantel'].'('.$value['municipio'].')')?></option>
                            <?php
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-6 divnomplant">
                    <div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
								</div>
                                <div class="col-auto">
                                    <div class="avatar">
                                        
                                    </div>
                                </div>
							</div>
							<h5 class="mt-1 mb-3 plntuno"></h5>
                            <div class="mb-0">
                                <span class="text-muted">Click aquí para </span>
								<a class="btn"  href="<?php echo BASE_URL?>/Plantel" role="button"><span class="badge badge-primary"> <i class="mdi mdi-arrow-bottom-right"></i> ver más </span></a>
							</div>
						</div>
					</div>
                </div>
                <div class="col-lg-3 col-6 divplant">
                    <div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
									<h5 class="card-title">Planteles con inscripcion</h5>
								</div>
                                <div class="col-auto">
                                    <div class="avatar">
                                        <div class="avatar-title rounded-circle bg-primary-light">
                                            <i data-feather="layout"></i>
                                        </div>
                                    </div>
                                </div>
							</div>
							<h1 class="mt-1 mb-3 plnt">0</h1>
                            <div class="mb-0">
                                <span class="text-muted">Click aquí para </span>
								<a class="btn"  href="<?php echo BASE_URL?>/Plantel" role="button"><span class="badge badge-primary"> <i class="mdi mdi-arrow-bottom-right"></i> ver más </span></a>
							</div>
						</div>
					</div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
									<h5 class="card-title">Prospectos</h5>
								</div>
                                <div class="col-auto">
                                    <div class="avatar">
                                        <div class="avatar-title rounded-circle bg-primary-light">
                                            <i data-feather="server"></i>
                                        </div>
                                    </div>
                                </div>
							</div>
							<h1 class="mt-1 mb-3 pros">0</h1>
                            <div class="mb-0">
                                <span class="text-muted">Click aquí para </span>
								<a class="btn" href="<?php echo BASE_URL?>/PlanEstudios" role="button"><span class="badge badge-primary"> <i class="mdi mdi-arrow-bottom-right"></i> ver más </span></a>
							</div>
						</div>
					</div>
                </div>
                <!-- ./col -->
               <div class="col-lg-3 col-6">
                    <div class="card">
						<div class="card-body">
						    <div class="row">
								<div class="col mt-0">
								    <h5 class="card-title">Inscritos</h5>
								</div>
                                <div class="col-auto">
                                    <div class="avatar">
                                        <div class="avatar-title rounded-circle bg-primary-light">
                                            <i data-feather="layers"></i>
                                        </div>
                                    </div>
                                </div>
							</div>
							<h1 class="mt-1 mb-3 ins">0</h1>
                            <div class="mb-0">
                                <span class="text-muted">Click aquí para </span>
								<a class="btn"  href="<?php echo BASE_URL?>/Materias" role="button"><span class="badge badge-primary"> <i class="mdi mdi-arrow-bottom-right"></i> ver más </span></a>
							</div>
						</div>
					</div>
                </div>
                <!-- ./col -->
            </div>
            <div class="row">
                <div class="col-6 divchar">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Prospectos & inscritos - Plantel</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex"><br><br>
                            </div>
                            <div class="position-relative mb-4">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="sales-chart" height="200" width="605"></canvas>
                            </div>
                            <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2">
                                    <i class="fas fa-square text-primary"></i> Prospectos
                                </span>
                                <span>
                                    <i class="fas fa-square text-gray"></i> Inscritos
                                </span>
                            </div>
                        </div>        
                    </div>
                </div>
                <div class="col-6 divcharPlantel">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Prospectos & inscritos</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="position-relative">
                                <div id='oilChartGral' width='400' height='300'></div>
                            </div>
                        </div>        
                    </div>
                </div>
            </div>
        <!-- /.row -->
        </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php footerAdmin($data); ?>