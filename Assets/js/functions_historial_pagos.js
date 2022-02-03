document.addEventListener('DOMContentLoaded', function(){
    var tableEstudiantes = $('#tableAlumnos').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/HistorialPagosAlumno/getEstudiantes",
            "dataSrc":""
        },
        "columns":[
            {"data":"id"},
            {"data":"id"},
            {"data":"id"},
            {"data":"id"},
            {"data":"id"},
            {"data":"id"}
        ],
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
        "order": [[ 0, "asc" ]],
        "iDisplayLength": 30
    });
});
$('#tableAlumnos').DataTable();