<?php
headerAdmin($data);
getModal('Campanias/modalNuevoCampania', $data);
getModal('Campanias/modalEditCampanias', $data);
?>

<div id="contentAjax"></div>

<div class="wrapper">

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-7">
                        <h1 class="m-0">
                            <?= $data['page_title'] ?>
                        </h1>
                    </div>
                    <!-- <div class="col-sm-5">
                        <ol class="breadcrumb float-sm-right btn-block">
                            <button type="button" onclick="openModal();" class="btn btn-inline btn-primary btn-sm btn-block"><i class="fa fa-plus-circle fa-md"></i> Nuevo</button>
                        </ol>
                    </div> -->
                </div>
            </div>
        </div>
        <!-- Main content -->

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Agenda</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="avatar">
                                            <div class="avatar-title rounded-circle bg-primary-light">
                                                <i data-feather="phone"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <h3 class="mt-1 mb-3">Gestiona las llamadas</h3> -->
                                <div class="mb-0">
                                    <span class="text-muted">Dando click</span>
                                    <a class="btn" href="<?php echo BASE_URL ?>/AgendaProspecto" role="button"><span class="badge badge-primary"> <i class="mdi mdi-arrow-bottom-right"></i> aquí </span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                    <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Bitácora</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="avatar">
                                            <div class="avatar-title rounded-circle bg-primary-light">
                                                <i data-feather="phone"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <h3 class="mt-1 mb-3">Consulta el seguimiento de prospección</h3> -->
                                <div class="mb-0">
                                    <span class="text-muted">Dando click</span>
                                    <a class="btn" href="<?php echo BASE_URL ?>/Seguimiento/seguimiento_prospectos" role="button"><span class="badge badge-primary"> <i class="mdi mdi-arrow-bottom-right"></i> aquí </span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </div>


</div>

<?php footerAdmin($data); ?>