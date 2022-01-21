let buscar = document.querySelector("#btnBuscar");
let verEdoCta = document.querySelector("#btnVerEdoCta");
let buscarAlumno = document.querySelector("#btnBuscarAlumno");
let cardsEdoCta = document.querySelector('.card_dato_cta');
let dataTableEdoCta = document.querySelector('#tableEstadoCuenta');
let strAlumno = "";
cardsEdoCta.style.display = "none";
dataTableEdoCta.style.display = "row";
//click en boton buscar alumno
buscar.addEventListener('click',function() {
    let strBuscarAlumno = document.querySelector('#txtNombrealumno').value;
    if(strBuscarAlumno == ''){
        swal.fire("Atención","Campo vacio de Matricula o RFC","warning");
        cardsEdoCta.style.display = "none";
        return false;
    }else{
        fnGetDatosAlumno(strBuscarAlumno);  
    }
})
//click en boton buscar alumno
verEdoCta.addEventListener('click',function() {
    let strBuscarAlumno = document.querySelector('#txtNombrealumno').value;
    fnGetEstadoCuentaAlumno(strBuscarAlumno);   
})

function fnGetEstadoCuentaAlumno(str){
    var tableEdoCta;
    tableEdoCta = $('#tableEstadoCuenta').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": ` ${base_url}/Assets/plugin/Spanish.json`
        },
        "ajax":{
            "url": ` ${base_url}/ConsultasIngresosEgresos/getEstadoCuenta/${str}`,
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
            {"data":"precio_unitario"},
            {"data":"fecha_pago"},
            {"data":"referencia"},
            {"data":"tipo_comprobante"},
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
    let url = `${base_url}/ConsultasIngresosEgresos/imprimir_edo_cta/${strAlumno}`;
    window.open(url,'_blank');
})
function fnGetDatosAlumno(str){
    let url = `${base_url}/ConsultasIngresosEgresos/getDatosAlumno/${str}`;
    fetch(url).then(res => res.json()).then((resultado) => {
        if(resultado.datos){
            console.log(resultado);
            cardsEdoCta.style.display = "block";
            strAlumno = str;
            let nomCompleto = resultado.datos.nombre_persona+' '+resultado.datos.ap_paterno+' '+resultado.datos.ap_materno;
            document.querySelector('#nomAlumEdoCta').innerHTML = nomCompleto;
            document.querySelector('#totalSaldo').innerHTML = formatoMoneda(resultado.totalSaldo.toFixed(2));
            document.querySelector('#telCelAlumno').innerHTML = " "+resultado.datos.tel_celular;
            document.querySelector('#emailAlumno').innerHTML = " "+resultado.datos.email;
            document.querySelector('#domicilioAlumno').innerHTML = " "+resultado.datos.domicilio;
            document.querySelector('#carreraAlumno').innerHTML = " "+resultado.datos.nombre_carrera;
            document.querySelector('#nombreSalon').innerHTML = " "+resultado.datos.nombre_salon;
            document.querySelector('#saldoColegiaturas').innerHTML = formatoMoneda(resultado.saldoColegiaturas.toFixed(2));
            document.querySelector('#saldoServicios').innerHTML = formatoMoneda(resultado.saldoServicios.toFixed(2));
        }else{
            swal.fire("Atención","Datos del alumno no encontrado","warning");
            cardsEdoCta.style.display = "none";
            return false;
        }
    }).catch(err => { throw err });
}
function buscarPersona(){
    let textoBusqueda = $("input#busquedaPersona").val();
    var tablePersonas;
    tablePersonas = $('#tablePersonas').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": ` ${base_url}/Assets/plugin/Spanish.json`
        },
        "ajax":{
            "url": ` ${base_url}/ConsultasIngresosEgresos/buscarPersonaModal?val=${textoBusqueda}`,
            "dataSrc":""
        },
        "columns":[
            {"data":"nombre"},
            {"data":"rfc"},
            {"data":"matricula_interna"},
            {"data":"options"}
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
        "order": [[ 0, "desc" ]],
        "iDisplayLength": 5
    });
    $('#tablePersonas').DataTable();
}
function seleccionarPersona(value){
    $('#cerrarModalBuscarPersona').click();
    let nombreCompleto = value.getAttribute('rl');
    let matricula = value.getAttribute('m');
    fnGetEstadoCuentaAlumno(matricula);
    fnGetDatosAlumno(matricula);
}
function fnPagarServicio(idServicio,matricula){
    location.href = `${base_url}/Ingresos/set_date_ingreso?i=${convStrToBase64(idServicio)}&m=${convStrToBase64(matricula)}`;
}
//Function para dar formato un numero a Moneda
function formatoMoneda(numero){
    let str = numero.toString().split(".");
    str[0] = str[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return "$"+str.join(".");
}
//Function para convertir un string  a  Formato Base64
function convStrToBase64(str){
    return window.btoa(unescape(encodeURIComponent( str ))); 
}