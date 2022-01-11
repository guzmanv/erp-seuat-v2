var tableIngresos;
let arrServicios = [];
let idPersonaSeleccionada;
document.querySelector('#alertSinEdoCta').style.display = "none";
document.querySelector('#btnAgregarServicio').disabled = true;
document.querySelector('.listServicios').style.display = "none";
document.querySelector('.listPromociones').style.display = "none";
document.querySelector('#listTipoCobro').disabled = true;
var formGenerarEdoCuenta = document.querySelector("#formGenerarEdoCuenta");

document.addEventListener('DOMContentLoaded', function(){
    //Iniciar Select2
    $('.select2').select2(); 
});
//Lista de servicios     
function fnServicios(value){
    let url = `${base_url}/Ingresos/getServicios/${value}/${idPersonaSeleccionada}`;
    fetch(url).then(res => res.json()).then((resultado) => {
        arrServiciosTodos = resultado.data;
        document.querySelector("#listServicios").innerHTML = "<option value=''>Selecciona un servicio</option>";
        if(resultado.tipo == "COL"){
            resultado.data.forEach(colegiatura => {
                document.querySelector("#listServicios").innerHTML += `<option pu='${colegiatura.precio_unitario}' value='${colegiatura.id_ingresos}'>${colegiatura.descripcion}</option>`;
            });
        }else{
            resultado.data.forEach(servicio => {
                document.querySelector("#listServicios").innerHTML += `<option pu='${servicio.precio_unitario}' value='${servicio.id}'>${servicio.nombre_servicio}</option>`;
            });
        }
    }).catch(err => { throw err });
}
//Lista de Promociones del Servicio seleccionado
function fnServicioSeleccionado(value){
    if(value != ""){
        let url = `${base_url}/Ingresos/getPromociones/${value}`;
        document.querySelector("#listPromociones").innerHTML = "<option value=''>Selecciona una promocion</option>";
        fetch(url).then(res => res.json()).then((resultado) => {
            if(resultado.length == 0){
                $('#listPromociones').val(null).trigger('change');
            }else{
                resultado.forEach(promocion => {
                    let nombrePromocion = `${promocion.nombre_promocion} (${promocion.porcentaje_descuento}%)`;
                    document.querySelector("#listPromociones").innerHTML += `<option des='${promocion.porcentaje_descuento}'value='${promocion.id}'>${nombrePromocion}</option>`;
                });
            }
        }).catch(err => { throw err });
        document.querySelector('#listPromociones').focus();
    }else{

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
            "url": ` ${base_url}/Assets/plugins/Spanish.json`
        },
        "ajax":{
            "url": ` ${base_url}/Ingresos/buscarPersonaModal?val=${textoBusqueda}`,
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
            document.querySelector('#alertSinEdoCta').style.display = "none";
            document.querySelector('#btnAgregarServicio').disabled = false;
            //document.querySelector('#listServicios').disabled = false;
            //document.querySelector('#txtCantidad').disabled = false;
            document.querySelector('#listTipoCobro').disabled = false;
            
        }else{
            document.querySelector('#btnAgregarServicio').disabled = true;
            document.querySelector('#alertSinEdoCta').style.display = "flex";
            //document.querySelector('#listServicios').disabled = true;
            //document.querySelector('#txtCantidad').disabled = true;
            document.querySelector('#listTipoCobro').disabled = true;
        }
    }).catch(err => { throw err });
    document.querySelector('#alertAgregarAlumno').style.display = "none";
}
//Agregar datos del servicio en la Tabla
function fnBtnAgregarServicioTabla(){
    let servicio = document.querySelector('#listServicios');
    let cantidad = 1;
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
            if(promocion.descuento == null){
                descuentoPorc += 0;
            }else{
                let descuento = parseFloat(promocion.descuento);
                descuentoPorc += descuento;
            }
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
            if(promocion.descuento != null){
                let descuento = parseFloat(promocion.descuento);
                descuentoPorc += descuento;
            }else{
                descuentoPorc += 0;
            }
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
            Swal.fire({
                title:'Generando estado de cuenta',
                html: "<div class='overlay'><i class='fas fa-3x fa-sync-alt fa-spin'></i><div class='text-bold pt-2'>espere...</div></div>",
                icon:'question',
                showConfirmButton:false,
                didOpen: () =>{
                    fetch(url).then(res => res.json()).then((resultado) => {
                       /* swal.fire("Estado de cuenta","Estado de cuenta generado correctamente!","success").then((result) =>{
                        document.querySelector('#btnAgregarServicio').disabled = false;
                        document.querySelector('#alertSinEdoCta').style.display = "none";
                        }); */
                    }).catch(err => { throw err });
                }
            })  
        }
    })
}
function fnButtonCobrar(){
    let total = 0;
    let descuentoPorc = 0;
    let totalDesc = 0;
    arrServicios.forEach(servicio => {
        let subtotal = parseFloat(servicio.subtotal);
        servicio.promociones.forEach(promocion => {
            if(promocion.descuento != null){
                let descuento = parseFloat(promocion.descuento);
                descuentoPorc += descuento;
            }else{
                descuentoPorc += 0;
            }
        });
        total += subtotal;
    });
    totalDesc = total - (total * (descuentoPorc/100));
    if(arrServicios.length == 0){
        document.querySelector('#alertSinServicio').style.display = "inline";
        document.querySelector('#cobro').style.display = "none";
    }else{
        document.querySelector('#alertSinServicio').style.display = "none";
        document.querySelector('#cobro').style.display = "inline";
        document.querySelector('#txtSubtotalModal').innerHTML= formatoMoneda(total.toFixed(2));
        document.querySelector('#txtDescuentoModal').innerHTML= `${descuentoPorc} %`;
        document.querySelector('#txtTotalModal').innerHTML= formatoMoneda(totalDesc.toFixed(2));
    }
}
function obtenerPromSeleccionados(param){
    let idList = param;
    var values = Array.prototype.slice.call(document.querySelectorAll(`#${idList} option:checked`),0).map(function(v,i,a,) { 
        return {id_promocion:v.value,descuento:v.getAttribute('des'),nombre_promocion:v.text};
    });
    return values;
}
function formatoMoneda(numero){
    let str = numero.toString().split(".");
    str[0] = str[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return "$"+str.join(".");
}
function fnTiposCobro(value){
    if(value != ""){
        $('#listPromociones').val(null).trigger('change');
        document.querySelector("#listPromociones").innerHTML = "<option value=''>Selecciona una promocion</option>";
        if(value == 1){
            fnServicios(value);
            document.querySelector('.listServicios').style.display = "inline";
            document.querySelector('.listPromociones').style.display = "inline";
                
        }else{
            fnServicios(value);
            document.querySelector('.listServicios').style.display = "block";
            document.querySelector('.listPromociones').style.display = "inline";
        }
    }else{
        document.querySelector('.listPromociones').style.display = "none";
        document.querySelector('.listServicios').style.display = "none";
    }
}
function btnCobrarCmbio(){
    let total = 0;
    let descuentoPorc = 0;
    let totalDesc = 0;
    arrServicios.forEach(servicio => {
        let subtotal = parseFloat(servicio.subtotal);
        servicio.promociones.forEach(promocion => {
            if(promocion.descuento != null){
                let descuento = parseFloat(promocion.descuento);
                descuentoPorc += descuento;
            }else{
                descuentoPorc += 0;
            }
        });
        total += subtotal;
    });
    totalDesc = total - (total * (descuentoPorc/100));

    let intEfectivo = document.querySelector('#txtEfectivo').value;

    if(intEfectivo == ''){
        swal.fire("Atención","Inserte la cantidad de efectivo","warning");
        return false;
    }else if(parseInt(intEfectivo) < total){
        swal.fire("Atención","La cantidad insertada es menor que el total","warning");
        return false;
    }else{
        let url = ` ${base_url}/Ingresos/setVenta/${convStrToBase64(arrServicios)}`
        fetch(url).then(res => res.json()).then((resultado) => {
           console.log(resultado);
        }).catch(err => { throw err });
    }
}
function convStrToBase64(str){
    return window.btoa(unescape(encodeURIComponent( str ))); 
}