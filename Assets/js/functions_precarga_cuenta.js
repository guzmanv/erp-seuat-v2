let idPlantel = null;
let nivel = null;
let formEditServicio = document.querySelector("#form_servicio_edit");
let arrDatosNew = [];

document.addEventListener('DOMContentLoaded', function(){
    let selectPlantel = document.querySelector('#listPlantelDatatable');
    if(selectPlantel){
        nivel = null;
        fnPlantelSeleccionadoDatatable(selectPlantel.value, nivel);
    }
});

function fnPlantelSeleccionadoDatatable(value,nivel){
    idPlantel = value;
    let url = `${base_url}/PrecargaCuenta/getPlanEstudios/${idPlantel}/${nivel}`;
    let tablePlanEstudios = $('#tablePlanEstudios').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": url,
            "dataSrc":""
        },
        "columns":[
            {"data":"numeracion"},
            {"data":"nombre_plantel"},
            {"data":"nombre_carrera"},
            {"data":"nombre_nivel_educativo"},
            {"data":"options"}
        ],
        "responsive": true,
	    "paging": true,
	    "lengthChange": true,
	    "searching": true,
	    "ordering": true,
	    "info": true,
	    "autoWidth": false,
	    //"scrollY": '42vh',
	    "scrollCollapse": true,
	    "bDestroy": true,
	    "order": [[ 0, "asc" ]],
	    "iDisplayLength": 5
    });
    $('#tablePlanEstudios').DataTable();
    fnListNiveles(idPlantel,nivel);
}
function fnServicios(idPlantel){
    let url = `${base_url}/PrecargaCuenta/getServicios/${idPlantel}`;
    //window.scrollTo(0,document.body.scrollHeight);
    $('html,body').animate({scrollTop: $(".div_precarga").offset().top},'slow');
    //window.scrollTo:{y:"#tableServicios", offsetY: $(window).innerHeight() / 2 - $('#tableServicios').height() / 2, x:"#tableServicios", offsetX: $(window).innerWidth() / 2 - $('#tableServicios').width() / 2, autoKill:false};
    fetch(url).then((res) => res.json()).then(resultado =>{
        if(resultado.length > 0){
            arrDatosNew = resultado;
            mostrarServiciosTabla();
 
        }else{
            document.querySelector('#tableServicios').innerHTML = "<tr><td colspan='7'><div class='alert alert-danger text-center' role='alert'>No hay datos.</div></td></tr>";
            
        }
    }).catch(err => {throw err});
}
function fnListNiveles(idPlantel,nivel){
    let url = `${base_url}/PrecargaCuenta/getNivelesByPlantel/${idPlantel}`;
    fetch(url).then((res) => res.json()).then(resultado =>{
        document.querySelector('#listNivelDatatable').innerHTML = "<option>Todos</option>";
        resultado.forEach(nivel => {
            document.querySelector('#listNivelDatatable').innerHTML += '<option value="'+nivel.id+'">'+nivel.nombre_nivel_educativo+'</option>';
        });
        if(nivel > 0){
            document.querySelector('#listNivelDatatable').querySelector('option[value="'+nivel+'"]').selected = true;
        }
    }).catch(err => {throw err});
}
function fnNivelSeleccionadoDatatable(value){
    nivel = value;
    fnPlantelSeleccionadoDatatable(idPlantel, nivel);
}

function fnEditServicio(value,id){
    formEditServicio.reset();
    let nombreServicio = value.getAttribute('n');
    let idServicio = id;
    let precioUnitario = value.getAttribute('p');
    document.querySelector('#txtNombre_servicio_edit').textContent = nombreServicio;
    document.querySelector('#intId_servicio_edit').value = idServicio;
    document.querySelector('#intPrecio_actual_edit').value = formatoMoneda(precioUnitario);
    document.querySelector('#intId_precio_unitario').value = precioUnitario;
}


formEditServicio.onsubmit = function(e){
    e.preventDefault();
    let nombreServicio = document.querySelector('#txtNombre_servicio_edit').textContent;
    
    let idServicio = document.querySelector('#intId_servicio_edit').value;
    let nuevoPrecio = document.querySelector('#intNuevo_precio_edit').value;
    let fechaLimitePago = document.querySelector('#txtFecha_limite_pago').value;
    let intPrecioActual = document.querySelector('#intId_precio_unitario').value;
    if (idServicio == '' || nuevoPrecio == '' || fechaLimitePago == '' || intPrecioActual == ''){
        swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
        return false;
    }
    document.querySelector('#np-'+idServicio).textContent = formatoMoneda(parseInt(nuevoPrecio).toFixed(2));
    arrDatosNew.forEach(servicios => {
        if(servicios.id == idServicio){
            servicios.precio_unitario = parseInt(nuevoPrecio).toFixed(2);
            servicios.fecha_limite_pago = fechaLimitePago;
        }
    });
    console.log(arrDatosNew);
    /* let estatus = false;
    arrDatosNew.forEach(element => {
        if(element.id_servicio == idServicio){
            estatus = true;
        }else{
            estatus = false;
        }
    });
    if(estatus){
        arrDatosNew.forEach(element => {
            if(element.idServicio == idServicio){
                element.nuevo_precio = nuevoPrecio;
                element.fecha_limite_pago = fechaLimitePago;
            }
        });
    }else{
        
    }
    let arr = {'nombre_servicio': nombreServicio,'id_servicio':idServicio,'precio_actual':intPrecioActual,'nuevo_precio':nuevoPrecio,'fecha_limite_pago':fechaLimitePago};
    arrDatosNew.push(arr); */
    $(".close").click();

}

function fnGuardarPrecarga(){
    let grado = document.querySelector('#selectGrado').value;
    let periodo = document.querySelector('#selectPeriodo').value;
    let datos = convStrToBase64(JSON.stringify(arrDatosNew));
    let url = `${base_url}/PrecargaCuenta/setPrecarga/${grado}/${periodo}/${datos}/${idPlantel}/${nivel}`;
    fetch(url).then((res) => res.json()).then(resultado =>{
        console.log(resultado);
    }).catch(err => {throw err});
    
}

function mostrarServiciosTabla(){
    let contador = 0;
    document.querySelector('#tableServicios').innerHTML = "";
    arrDatosNew.forEach(element => {
        contador += 1;
        document.querySelector('#tableServicios').innerHTML += '<tr><th><input type="checkbox" aria-label="Checkbox for following text input"></th><th scope="row">'+contador+'</th><td>'+element.codigo_servicio+'</td><td>'+element.nombre_servicio+'</td><td>'+formatoMoneda(element.precio_unitario)+'</td><td id="np-'+element.id+'">$0.00</td><td><a type="button" n="'+element.nombre_servicio+'" p="'+element.precio_unitario+'" onclick="fnEditServicio(this,'+element.id+')" data-toggle="modal" data-target="#modal_editar_servicio"><i class="fas fa-pencil-alt"></i></a><a type="button" data-toggle="modal" data-target="#exampleModal"><i class="far fa-eye ml-3"></i></a></td></tr>';
    });
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