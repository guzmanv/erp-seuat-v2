var tableIngresos;
document.addEventListener('DOMContentLoaded', function(){
    tableIngresos = $('#tableIngresos').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            //url:"<?php echo media(); ?>/plugins/Spanish.json"
            "url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Ingresos/getAlumnos",
            "dataSrc":""
        },
        "columns":[
            {"data":"numeracion"},
            {"data":"nombre_persona"},
            {"data":"apellidos"},
            {"data":"nombre_carrera"},
            {"data":"grado"},
            {"data":"nombre_salon"},
            {"data":"options"}
        ],
        "responsive": true,
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "scrollY": '42vh',
        "scrollCollapse": true,
        "bDestroy": true,
        "order": [[ 0, "asc" ]],
        "iDisplayLength": 10
    });
    $('#tableIngresos').DataTable();
});
function fnPagosServicios(value){
    let idPer = value.getAttribute("idper");
    let nomPer = value.getAttribute("nomper");
    document.querySelector('#idAlumno').value = idPer;
    document.querySelector('#txtAlumno').innerHTML = nomPer;
}