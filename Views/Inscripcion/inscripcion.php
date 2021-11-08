<?php
    headerAdmin($data);
    getModal("Inscripcion/modalNuevaInscripcion",$data);
    getModal("Inscripcion/modalDocumentacion",$data);
    getModal("Inscripcion/modalEditInscripcion",$data);
;
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
                    <div class="col-sm-5">
                        <ol class="breadcrumb float-sm-right btn-block">
                            <button type="button" class="btn btn-inline btn-primary btn-sm btn-block" data-toggle="modal" data-target="#ModalFormNuevaInscripcion"><i class="fa fa-plus-circle fa-md"></i>Nuevo</button>
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
                                <h3 class="card-title">Listado de Inscripciones</h3>
                                <p class="card-text">
                                    <table id="tableInscripciones" class="table table-bordared table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre de la Persona</th>
                                                <th>Plantel</th> 
                                                <th>Carrera</th>
                                                <th>Grado</th>
                                                <th>Grupo</th>
                                                <th>Validacion</th>
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
<?php
    footerAdmin($data);
?>