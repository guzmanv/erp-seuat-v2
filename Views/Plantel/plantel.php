<?php
  headerAdmin($data);
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">  Administración de planteles</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Plantel</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">


            <div class="card">
              <div class="card-body">
                <h3 class="card-title">Listado de planteles</h3>
                <p class="card-text">
              <!-- /.card-header -->
                <table id="tableRoles" class="table table-bordered table-striped table-sm">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Estatus</th>
                  </tr>
                  </thead>
                  <tbody>

                  </tbody>

                </table>
              </p>
              </div>
              <!-- /.card-body -->
            </div>


<!--
            <div class="card shadow-sm p-3 mb-5 bg-white rounded">
              <div class="card-body">
                <h5 class="card-title">Planteles</h5>

                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk of the card's
                  content.
                </p>

                <a href="#" class="card-link">link uno</a>
                <a href="#" class="card-link">link dos</a>
              </div>
            </div>-->


          <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
       <!--   <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h5 class="m-0">Featured</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title">Special title treatment</h6>

                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
          </div>-->
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->

  <!--<aside class="control-sidebar control-sidebar-dark">
     Control sidebar content goes here -->
    <!--<div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>-->
  <!-- /.control-sidebar -->



<?php footerAdmin($data); ?>



<!-- Page specific script -->
<script>
  //$(function () {
  $(document).ready(function() {
    $("#tableRoles").DataTable({
      "responsive": true,
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "scrollY": '42vh',
      "scrollCollapse": true,
      "bDestroy": true,
      "order": [[ 0, "desc" ]],
      "iDisplayLength": 25,
      language: {
            url:"<?php echo media(); ?>/plugins/Spanish.json",
        }

    });




   /* $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      language: {
            url: '<?php echo media(); ?>/plugins/Spanish.json'
        }
    });*/
  });

</script>


