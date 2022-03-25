<?php
    headerAdmin($data);
/*     getModal("Inscripcion/modalNuevaInscripcion",$data);
    getModal("Inscripcion/modalDocumentacion",$data);
    getModal("Inscripcion/modalEditInscripcion",$data);
    getModal("Inscripcion/modalListaInscritos",$data); */
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
                            <button type="button" class="btn btn-inline btn-primary btn-sm btn-block"
                                data-toggle="modal" data-target="#ModalFormNuevaInscripcion"><i
                                    class="fa fa-plus-circle fa-md"></i>Nuevo</button>
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
                                <div class="col-md-6">
                                    <label>Selecciona un plantel</label>
                                    <select class="custom-select" id="listPlantelDatatable"
                                        onchange="fnPlantelSeleccionadoDatatable(value)">
                                        <option selected>Todos</option>
                                        <?php 
                                            foreach ($data['planteles'] as $key => $value) {
                                                ?>
                                        <option value="<?php echo $value['id']?>">
                                            <?php echo $value['nombre_plantel'].' ('.$value['municipio'].')'?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title" id="nombrePlantelDatatable"></h2>
                                <p class="card-text">
                                <table id="tablePlanEstudios"
                                    class="table table-bordared table-hover table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Plantel</th>
                                            <th>Plan de estudios</th>
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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="alert alert-dark text-center" role="alert">
                                    <b>PRECARGA CUENTA</b>
                                </div>      
                                <div class="row">
                                    <div class="col-md-8">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox"aria-label="Checkbox for following text input"></th>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Codigo</th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Precio unitario</th>
                                                    <th scope="col">Categoria</th>
                                                    <th scope="col">Editar</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tableServicios">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Periodo:
                                                            </th>
                                                            <th>
                                                            </th>
                                                            <th class="text-center">Grado:
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <label>Periodo</label>
                                                                <select class="custom-select">
                                                                    <option selected="">Seleccionar...</option>
                                                                    <option value="1">Septiembre - Diciembre 2022</option>
                                                                    <option value="2">Enero - Febrero 2023</option>
                                                                    <option value="3">Marzo - Abril 2023</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <div
                                                                    style="border-left: 2px solid black;height:80px;position:absolute;">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <label>Grado</label>
                                                                <select class="custom-select">
                                                                    <option selected="">Seleccionar...</option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="3">4</option>
                                                                    <option value="3">5</option>
                                                                    <option value="3">6</option>
                                                                    <option value="3">7</option>
                                                                    <option value="3">8</option>
                                                                    <option value="3">9</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table><br>
                                                <div class="col-12 text-center">
                                                    <button type="button" class="btn btn-primary col-6">Guardar</button>
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
<?php
    footerAdmin($data);
?>