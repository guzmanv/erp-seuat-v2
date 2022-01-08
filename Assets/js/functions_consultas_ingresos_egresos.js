let buscarAlumno = document.querySelector("#btnBuscarAlumno");
//click en boton buscar alumno
buscarAlumno.addEventListener('click',function() {
    let strBuscarAlumno = document.querySelector('#txtNombrealumno').value;
    fnGetEstadoCuentaAlumno(strBuscarAlumno);
    fnGetDatosAlumno(strBuscarAlumno);
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
            {"data":"descripcion"},
            {"data":"cargo"},
            {"data":"abono"},
            {"data":"saldo"},
            {"data":"fecha_pago"},
            {"data":"referencia"},
            {"data":"factura"},
            {"data":"options"},
        ],
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
btnImprimirEdoCta.addEventListener('click',function(){
    let url = `${base_url}/ConsultasIngresosEgresos/imprimir_edo_cta`;
    window.open(url,'_blank');
})
function fnGetDatosAlumno(str){
    let url = `${base_url}/ConsultasIngresosEgresos/getDatosAlumno/${str}`;
    fetch(url).then(res => res.json()).then((resultado) => {
        if(resultado){
            let nomCompleto = resultado.nombre_persona+' '+resultado.ap_paterno+' '+resultado.ap_materno;
            document.querySelector('#nomAlumEdoCta').innerHTML = nomCompleto;
        }
    }).catch(err => { throw err });
}