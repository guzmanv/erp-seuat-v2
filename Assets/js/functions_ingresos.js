var tableIngresos;
let arrServicios = [];
document.addEventListener('DOMContentLoaded', function(){
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
});
/* function fnPagosServicios(value){
    let idPer = value.getAttribute("idper");
    let nomPer = value.getAttribute("nomper");
    document.querySelector('#idAlumno').value = idPer;
    document.querySelector('#txtAlumno').innerHTML = nomPer;
} */
function fnNuevoIngreso(){
    let url = `${base_url}/Ingresos/getServicios`;
    fetch(url).then(res => res.json()).then((resultado) => {
		resultado.forEach(servicio => {
            document.querySelector("#listServicios").innerHTML += `<option value='${servicio.id}'>${servicio.nombre_servicio}</option>`;
        });
    }).catch(err => { throw err });
}

function fnServicioSeleccionado(value){
    let url = `${base_url}/Ingresos/getPromociones/${value}`;
    document.querySelector("#listPromociones").innerHTML = "<option value=''>Selecciona una promocion</option>";
    fetch(url).then(res => res.json()).then((resultado) => {
		resultado.forEach(promocion => {
            let nombrePromocion = `${promocion.nombre_promocion} (${promocion.porcentaje_descuento}%)`;
            document.querySelector("#listPromociones").innerHTML += `<option value='${promocion.id}'>${nombrePromocion}</option>`;
        });
    }).catch(err => { throw err });
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
    document.querySelector('#idPersonaSeleccionada').value = idPersonaSeleccionada; 
    $('#cerrarModalBuscarPersona').click();
}
function fnBtnAgregarServicioTabla(){
    let servicio = document.querySelector('#listServicios');
    let promociones = document.querySelector('#listPromociones');
    let descuento = document.querySelector('#txtDescuento').value;
    let cantidad = document.querySelector('#txtCantidad').value;
    let idServicio = servicio.value;
    let nombreServicio = servicio.options[servicio.selectedIndex].text;
    let idPromocion = promociones.value;
    let nombrePromocion = promociones.options[promociones.selectedIndex].text;
    let precioUnitario = 100;
    let subtotal = 500;
    let acciones = `<td style='text-align:center'><a class='btn' onclick='fnBorrarServicioTabla(${idServicio})'><i class='fas fa-trash text-danger'></i></a></td>`;
    let arrServicio = {id_servicio:idServicio,nombre_servicio:nombreServicio,id_promocion:idPromocion,nombre_promocion:nombrePromocion,cantidad:cantidad,descuento:descuento,precio_unitario:precioUnitario,subtotal:subtotal,acciones:acciones};
    if(idServicio == "" || descuento == "" || cantidad == ""){
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
        swal.fire("Atención","Ya existe el servicio","warning");
        document.querySelector('#formPagosServicios').reset();
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
                arrServicios.push(arrServicio);
                mostrarServiciosTabla();
                document.querySelector('#formPagosServicios').reset();
                mostrarTotalCuentaServicios();
            }
          })
    }
}  
function fnBorrarServicioTabla(value){
    let arrServicioNew = [];
    arrServicios.forEach(servicio => {
        if(servicio.id_servicio != value){
            let arrServicio = {id_servicio:servicio.id_servicio,nombre_servicio:servicio.nombre_servicio,id_promocion:servicio.id_promocion,nombre_promocion:servicio.nombre_promocion,cantidad:servicio.cantidad,descuento:servicio.descuento,precio_unitario:servicio.precio_unitario,subtotal:servicio.subtotal,acciones:servicio.acciones};
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
        document.querySelector("#tableServicios").innerHTML += `<tr><td>${totalServicios}</td><td>${servicio.nombre_servicio}</td><td>${servicio.precio_unitario}</td><td>${servicio.cantidad}</td><td>${servicio.descuento}</td><td>${servicio.subtotal}</td>${servicio.acciones}</tr>`
    });
    mostrarTotalCuentaServicios();
}
function mostrarTotalCuentaServicios(){
    let total = 0;
    arrServicios.forEach(servicio => {
        total += servicio.subtotal;
    });
    document.querySelector('#txtTotal').innerHTML = `$ ${total}`;
}