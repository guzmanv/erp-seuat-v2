let buscarAlumno = document.querySelector("#btnBuscarAlumno");

//click en boton buscar alumno
buscarAlumno.addEventListener('click',function() {
    let strBuscarAlumno = document.querySelector('#txtNombrealumno').value;
    fnGetEstadoCuentaAlumno(strBuscarAlumno);
})

function fnGetEstadoCuentaAlumno(str){
    var tableEdoCta;
    tableEdoCta = $('#tableEstadoCuenta').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/ConsultasIngresosEgresos/getEstadoCuenta/"+str,
            "dataSrc":""
        },
        "columns":[
            {"data":"numeracion"},
            {"data":"fecha"},
            {"data":"concepto"},
            {"data":"subconcepto"},
            {"data":"observaciones"},
            {"data":"cargo"},
            {"data":"abono"},
            {"data":"saldo"},
            {"data":"fecha_apgo"},
            {"data":"referencia"},
            {"data":"factura"}        ],
        "responsive": true,
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "scrollY": '42vh',
        "scrollCollapse": true,
        "bDestroy": true,
        "order": [[ 0, "asc" ]],
        "iDisplayLength": 20
    });
    $('#tableEstadoCuenta').DataTable();
}