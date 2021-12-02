var tableIngresos;
let arrServicios = [];
let idPersonaSeleccionada;
document.addEventListener('DOMContentLoaded', function(){
    $('.select2').select2();
    tableIngresos = $('#tableIngresos').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            //url:"<?php echo media(); ?>/plugins/Spanish.json"
            "url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Ingresos/getIngresos",
            "dataSrc":""
        },
        "columns":[
            {"data":"id"},
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
        "info": false,
        "autoWidth": false,
        "scrollY": '42vh',
        "scrollCollapse": true,
        "bDestroy": true,
        "order": [[ 0, "asc" ]],
        "iDisplayLength": 10
    });
    $('#tableIngresos').DataTable();
    fnServicios();
});
/* function fnPagosServicios(value){
    let idPer = value.getAttribute("idper");
    let nomPer = value.getAttribute("nomper");
    document.querySelector('#idAlumno').value = idPer;
    document.querySelector('#txtAlumno').innerHTML = nomPer;
} */
function fnServicios(){
    let url = `${base_url}/Ingresos/getServicios`;
    fetch(url).then(res => res.json()).then((resultado) => {
        arrServiciosTodos = resultado;
        document.querySelector("#listServicios").innerHTML = "<option value=''>Selecciona un servicio</option>";
		resultado.forEach(servicio => {
            document.querySelector("#listServicios").innerHTML += `<option pu='${servicio.precio_unitario}' value='${servicio.id}'>${servicio.nombre_servicio}</option>`;
        });
    }).catch(err => { throw err });
}

function fnServicioSeleccionado(value){
    let url = `${base_url}/Ingresos/getPromociones/${value}`;
    document.querySelector("#listPromociones").innerHTML = "<option value=''>Selecciona una promocion</option>";
    fetch(url).then(res => res.json()).then((resultado) => {
		resultado.forEach(promocion => {
            let nombrePromocion = `${promocion.nombre_promocion} (${promocion.porcentaje_descuento}%)`;
            document.querySelector("#listPromociones").innerHTML += `<option des='${promocion.porcentaje_descuento}'value='${promocion.id}'>${nombrePromocion}</option>`;
        });
    }).catch(err => { throw err });
    if(value != ""){
        document.querySelector('#txtCantidad').value = 1;
    }else{
        document.querySelector('#txtCantidad').value = 0;
    }
}

function fnInputBuscarPersona(){
    var textoBusqueda = $("input#inputBusquedaPersona").val();
    var tablePersonas;
    tablePersonas = $('#tablePersonas').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Ingresos/buscarPersonaModal?val="+textoBusqueda,
            "dataSrc":""
        },
        "columns":[
            {"data":"numeracion"},
            {"data":"nombre"},
            {"data":"nombre_carrera"},
            {"data":"grado"},
            {"data":"nombre_grupo"},
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
        "order": [[ 0, "asc" ]],
        "iDisplayLength": 5
    });
    $('#tablePersonas').DataTable();
}

function seleccionarPersona(answer){
    idPersonaSeleccionada = answer.id;
    let nombrePersona = answer.getAttribute('rl');
    document.querySelector('#txtNombreNuevo').value = nombrePersona;
    $('#cerrarModalBuscarPersona').click();
}
function fnBtnAgregarServicioTabla(){
    let servicio = document.querySelector('#listServicios');
    let cantidad = document.querySelector('#txtCantidad').value;
    let idServicio = servicio.value;
    let nombreServicio = servicio.options[servicio.selectedIndex].text;
    let precioUnitarioServicioSel = servicio.options[servicio.selectedIndex].getAttribute('pu');
    let subtotal = (precioUnitarioServicioSel*cantidad).toFixed(2);
    let acciones = `<td style='text-align:center'><a class='btn' onclick='fnBorrarServicioTabla(${idServicio})'><i class='fas fa-trash text-danger'></i></a></td>`;
    let arrServicio = {id_servicio:idServicio,nombre_servicio:nombreServicio,cantidad:cantidad,precio_unitario:precioUnitarioServicioSel,subtotal:subtotal,acciones:acciones,promociones:obtenerPromSeleccionados('listPromociones')};
    if(idServicio == "" || cantidad == ""){
        swal.fire("Atención","Atención todos los campos son obligatorios","warning");
        return false;
    }
    let isExist = false;
    arrServicios.forEach(servicio => {
        if(servicio.id_servicio == idServicio){
            isExist = true;
        }
    });
    if(isExist){
        swal.fire("Atención","Ya existe el servicio","warning").then((result) =>{
            if(result.isConfirmed){
                fnServicios();
                document.querySelector('#listPromociones').innerHTML = "";
            }
        });
        return false;
    }else{
        Swal.fire({
            title: 'Agregar?',
            text: "Agregar el nuevo servicio",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
          }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector("#tableServicios").innerHTML ="";
                document.querySelector('#listPromociones').innerHTML = "";
                arrServicios.push(arrServicio);
                mostrarServiciosTabla();
                fnServicios();
                document.querySelector('#listPromociones').innerHTML ="<option value=''>Selecciona una promocion</option>";
                document.querySelector('#txtCantidad').value = 0;
                mostrarTotalCuentaServicios();
            }
          })
    }
}  
function fnBorrarServicioTabla(value){
    let arrServicioNew = [];
    arrServicios.forEach(servicio => {
        if(servicio.id_servicio != value){
            let arrServicio = {id_servicio:servicio.id_servicio,nombre_servicio:servicio.nombre_servicio,promociones:servicio.promociones,cantidad:servicio.cantidad,precio_unitario:servicio.precio_unitario,subtotal:servicio.subtotal,acciones:servicio.acciones};
            arrServicioNew.push(arrServicio);
        }
    });
    arrServicios = arrServicioNew;
    mostrarServiciosTabla();
} 
function mostrarServiciosTabla(){
    document.querySelector("#tableServicios").innerHTML ="";
    let totalServicios = 0;
    arrServicios.forEach(servicio => {
        totalServicios += 1;
        let descuentoPorc = 0;
        servicio.promociones.forEach(promocion => {
            let descuento = parseFloat(promocion.descuento);
            descuentoPorc += descuento;
        });
        document.querySelector("#tableServicios").innerHTML += `<tr><td>${totalServicios}</td><td>${servicio.nombre_servicio}</td><td>$${servicio.precio_unitario}</td><td>${servicio.cantidad}</td><td>${descuentoPorc}%</td><td>$${servicio.subtotal}</td>${servicio.acciones}</tr>`
    });
    mostrarTotalCuentaServicios();
}
function mostrarTotalCuentaServicios(){
    let total = 0;
    arrServicios.forEach(servicio => {
        let subtotal = parseFloat(servicio.subtotal);
        total += subtotal;
    });
    document.querySelector('#txtTotal').innerHTML = `$ ${parseFloat(total).toFixed(2)}`;
}
function obtenerPromSeleccionados(param){
    let idList = param;
    var values = Array.prototype.slice.call(document.querySelectorAll('#'+idList+' option:checked'),0).map(function(v,i,a,) { 
        return {id_promocion:v.value,descuento:v.getAttribute('des'),nombre_promocion:v.text};
    });
    return values;
}