<?php
  headerAdmin($data);
?>

<div class="contentAjax">

  <div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
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

            <div class="col-sm-5">
              <ol class="breadcrumb float-sm-right btn-block">
                <button type="button" onclick="openModalNI();" class="btn btn-inline btn-primary btn-sm btn-block" >
                  <i class="fa fa-times-circle fa-md"></i>No interesado
                </button>
              </ol>
              <ol class="breadcrumb float-sm-right btn-block">
                <button type="button" onclick="openModalPd();" class="btn btn-inline btn-primary btn-sm btn-block" >
                  <i class="fa fa-user-circle fa-md"></i>Prospecto del dia
                </button>
              </ol>
            </div>

          </div>
        </div>
      </div>

      <!-- Main content -->
      <div class="content">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">


              <div class="card">
                <div class="card-body">

                  <p class="card-text">

                    <table id="tableAgendaProspecto" class="table table-bordered table-striped table-hover table-sm">

                      <thead>

                        <tr>

                          <th width="7%">#</th>
                          <th>Nombre(s)</th>
                          <th>Apellido Paterno</th>
                          <th>Apellido Materno</th>
                          <th width="12%">Fecha Programada</th>
                          <th width="7%">Hora</th>
                          <th width="12%">Telefono</th>
                          <th width="12%">Estado</th>
                          <th width="12%">Acciones</th>

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

      <!--       /.content-header       -->
    </div>
    <!--            /.content-wrapper          -->

  </div>

</div>
<?php footerAdmin($data); ?>
