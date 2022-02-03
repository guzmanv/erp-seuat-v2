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
                        <h1 class="m-0"> <?= $data['page_title'] ?></h1>
                        <h1 class="nombre_pagina" hidden><?= $data['page_name'] ?></h1>
                    </div>
                    <div class="col-sm-5">
                        <ol class="breadcrumb float-sm-right btn-block">
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
                                <div class="container-fluid p-0">
                                    <div class="mb-3">
                                        <h1 class="h3 d-inline align-middle">Alumnos</h1>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-8">
                                            <div class="card">
                                                <div class="card-header pb-0">
                                                    <h5 class="card-title mb-0">Alumnos</h5>
                                                </div>
                                                <div class="card-body">
                                                   
                                                    <table id="tableAlumnos" class="table table-bordared table-hover table-striped table-sm">
                                        <thead>
                                            <tr>
                                            <th>#</th>
                                                                <th>Nombre del servicio</th>
                                                                <th>Precio unitario</th>
                                                                <th>Cantidad</th>
                                                                <th>Descuento</th>
                                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                        </tbody>
                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="card-actions float-end">
                                                        <div class="dropdown position-relative">
                                                            <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal align-middle"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else here</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h5 class="card-title mb-0">Angelica Ramos</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row g-0">
                                                        <div class="col-sm-3 col-xl-12 col-xxl-3 text-center">
                                                            <img src="img/avatars/avatar-3.jpg" width="64" height="64" class="rounded-circle mt-2" alt="Angelica Ramos">
                                                        </div>
                                                        <div class="col-sm-9 col-xl-12 col-xxl-9">
                                                            <strong>About me</strong>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                                            magna aliqua.</p>
                                                        </div>
                                                    </div>
                                                    <table class="table table-sm mt-2 mb-4">
                                                        <tbody>
                                                            <tr>
                                                                <th>Name</th>
                                                                <td>Angelica Ramos</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Company</th>
                                                                <td>The Wiz</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Email</th>
                                                                <td>angelica@ramos.com</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Phone</th>
                                                                <td>+1234123123123</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Status</th>
                                                                <td><span class="badge bg-success">Active</span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <strong>Activity</strong>
                                                    <ul class="timeline mt-2 mb-0">
                                                        <li class="timeline-item">
                                                            <strong>Signed out</strong>
                                                            <span class="float-end text-muted text-sm">30m ago</span>
                                                            <p>Nam pretium turpis et arcu. Duis arcu tortor, suscipit...</p>
                                                        </li>
                                                        <li class="timeline-item">
                                                            <strong>Created invoice #1204</strong>
                                                            <span class="float-end text-muted text-sm">2h ago</span>
                                                            <p>Sed aliquam ultrices mauris. Integer ante arcu...</p>
                                                        </li>
                                                        <li class="timeline-item">
                                                            <strong>Discarded invoice #1147</strong>
                                                            <span class="float-end text-muted text-sm">3h ago</span>
                                                            <p>Nam pretium turpis et arcu. Duis arcu tortor, suscipit...</p>
                                                        </li>
                                                        <li class="timeline-item">
                                                            <strong>Signed in</strong>
                                                            <span class="float-end text-muted text-sm">3h ago</span>
                                                            <p>Curabitur ligula sapien, tincidunt non, euismod vitae...</p>
                                                        </li>
                                                        <li class="timeline-item">
                                                            <strong>Signed up</strong>
                                                            <span class="float-end text-muted text-sm">2d ago</span>
                                                            <p>Sed aliquam ultrices mauris. Integer ante arcu...</p>
                                                        </li>
                                                    </ul>
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