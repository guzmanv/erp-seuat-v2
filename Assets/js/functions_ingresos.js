var tableIngresos;
let arrServicios = [];
let idPersonaSeleccionada;
document.querySelector('#alertSinEdoCta').style.display = "none";
document.querySelector('#btnAgregarServicio').disabled = true;
var formGenerarEdoCuenta = document.querySelector("#formGenerarEdoCuenta");

document.addEventListener('DOMContentLoaded', function(){
    //Iniciar Select2
    $('.select2').select2(); 
    fnServicios();
});
//Lista de servicios     
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
//Lista de Promociones del Servicio seleccionado
function fnServicioSeleccionado(value){
    if(value != ""){
        let url = `${base_url}/Ingresos/getPromociones/${value}`;
        document.querySelector("#listPromociones").innerHTML = "<option value=''>Selecciona una promocion</option>";
        fetch(url).then(res => res.json()).then((resultado) => {
            resultado.forEach(promocion => {
                let nombrePromocion = `${promocion.nombre_promocion} (${promocion.porcentaje_descuento}%)`;
                document.querySelector("#listPromociones").innerHTML += `<option des='${promocion.porcentaje_descuento}'value='${promocion.id}'>${nombrePromocion}</option>`;
            });
        }).catch(err => { throw err });
        document.querySelector('#txtCantidad').value = 1;
        document.querySelector('#listPromociones').focus();
    }else{
        document.querySelector('#txtCantidad').value = 0;
    }
}
//Buscar persona por Modal
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
//Seleccionar una persona en el modal
function seleccionarPersona(answer){
    idPersonaSeleccionada = answer.id;
    let nombrePersona = answer.getAttribute('rl');
    document.querySelector('#txtNombreNuevo').value = nombrePersona;
    $('#cerrarModalBuscarPersona').click();
    let url = `${base_url}/Ingresos/getEstatusEstadoCuenta/${idPersonaSeleccionada}`;
    fetch(url).then(res => res.json()).then((resultado) => {
        //true = tiene estado de cuenta

        if(resultado == true){
            document.querySelector('#btnAgregarServicio').disabled = false;
        }else{
            document.querySelector('#btnAgregarServicio').disabled = true;
            document.querySelector('#alertSinEdoCta').style.display = "flex";
        }
    }).catch(err => { throw err });
    document.querySelector('#alertAgregarAlumno').style.display = "none";
}
//Agregar datos del servicio en la Tabla
function fnBtnAgregarServicioTabla(){
    let servicio = document.querySelector('#listServicios');
    let cantidad = document.querySelector('#txtCantidad').value;
    let idServicio = servicio.value;
    let nombreServicio = servicio.options[servicio.selectedIndex].text;
    let precioUnitarioServicioSel = servicio.options[servicio.selectedIndex].getAttribute('pu');
    let subtotal = precioUnitarioServicioSel*cantidad;
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
            document.querySelector(`#cantidad${idServicio}`).focus();
        }
    });
    if(isExist){
        swal.fire("Atención","Ya existe el servicio, modifica la cantidad en la tabla","warning").then((result) =>{
            if(result.isConfirmed){
                fnServicios();
                document.querySelector('#listPromociones').innerHTML = "";
            }
        });
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
//Funcion para el boton de borrar un servicio agregado en la Tabla  
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
//Mostrar los servicios en la Tabla
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
        document.querySelector("#tableServicios").innerHTML += `<tr><td>${totalServicios}</td><td>${servicio.nombre_servicio}</td><td>${formatoMoneda(servicio.precio_unitario)}</td><td><input id='cantidad${servicio.id_servicio}' type='number' style='width: 6em;' value='${servicio.cantidad}' min='0' onkeyup='modCantidadServ(this)'></td><td>${descuentoPorc}%</td><td>${formatoMoneda(servicio.subtotal.toFixed(2))}</td>${servicio.acciones}</tr>`
    });
    mostrarTotalCuentaServicios();
}
function mostrarTotalCuentaServicios(){
    let total = 0;
    let descuentoPorc = 0;
    let totalDesc = 0;
    arrServicios.forEach(servicio => {
        let subtotal = parseFloat(servicio.subtotal);
        servicio.promociones.forEach(promocion => {
            let descuento = parseFloat(promocion.descuento);
            descuentoPorc += descuento;
        });
        total += subtotal;
    });
    totalDesc = total - (total * (descuentoPorc/100));
    document.querySelector('#txtSubtotal').innerHTML = `${formatoMoneda(total)}`;
    document.querySelector('#txtDescuento').innerHTML = `${descuentoPorc}%`;
    document.querySelector('#txtTotal').innerHTML = `${formatoMoneda(totalDesc.toFixed(2))}`;
}
function modCantidadServ(val){
    let cantidad = val.value;
    let idServicio = val.id.split('cantidad')[1];
    arrServicios.forEach(servicio => {
        if(servicio.id_servicio == idServicio){
            servicio.cantidad = cantidad;
            servicio.subtotal = servicio.precio_unitario*cantidad;
        }
    });
    if(cantidad != 0){
        mostrarServiciosTabla();
    }
}
//Generar estado de cuenta de la persona seleccionada
function fnGenerarEstadoCuenta(){
    Swal.fire({
        title: 'Estado de cuenta',
        text: "Generar un estado de cuenta para el Alumno?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            let url = `${base_url}/Ingresos/generarEdoCuenta/${idPersonaSeleccionada}`;
            fetch(url).then(res => res.json()).then((resultado) => {
                console.log(resultado);
                /* swal.fire("Estado de cuenta","Estado de cuenta generado correctamente!","success").then((result) =>{
                    document.querySelector('#btnAgregarServicio').disabled = false;
                    document.querySelector('#alertSinEdoCta').style.display = "none";
                }); */
            }).catch(err => { throw err });    
        }
    })
}
function fnButtonPagar(){
    let total = 0;
    let descuentoPorc = 0;
    let totalDesc = 0;
    arrServicios.forEach(servicio => {
        let subtotal = parseFloat(servicio.subtotal);
        servicio.promociones.forEach(promocion => {
            let descuento = parseFloat(promocion.descuento);
            descuentoPorc += descuento;
        });
        total += subtotal;
    });
    totalDesc = total - (total * (descuentoPorc/100));

    if(arrServicios.length == 0){
        swal.fire("Atención","Agrega al menos un servicio","warning");
    }else{
        Swal.fire({
            title: 'Pagar',
            html: '<h2><b>Total: </b>'+formatoMoneda(totalDesc.toFixed(2))+'</h2>',
            input: 'text',
            inputPlaceholder: 'Ingresa la cantidad a pagar',
            inputAttributes: {
              autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Pagar',
            showLoaderOnConfirm: true,
            preConfirm: (login) => {
              return fetch(`//api.github.com/users/${login}`)
                .then(response => {
                  if (!response.ok) {
                    throw new Error(response.statusText)
                  }
                  return response.json()
                })
                .catch(error => {
                  Swal.showValidationMessage(
                    'Ingrese una cantidad!'
                  )
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
          }).then((result) => {
            if (result.isConfirmed) {
                swal.fire("Exito","Venta guardado correctamente!","success");
            }
          })
    }
}
function obtenerPromSeleccionados(param){
    let idList = param;
    var values = Array.prototype.slice.call(document.querySelectorAll('#'+idList+' option:checked'),0).map(function(v,i,a,) { 
        return {id_promocion:v.value,descuento:v.getAttribute('des'),nombre_promocion:v.text};
    });
    return values;
}
function formatoMoneda(numero){
    let str = numero.toString().split(".");
    str[0] = str[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return "$"+str.join(".");
}