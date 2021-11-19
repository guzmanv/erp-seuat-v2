var tableEstudiantes;
document.getElementById("btnActionFormNueva").style.display = "none";
document.getElementById("btnActionFormEdit").style.display = "none";
var formDocumentacion = document.querySelector("#formDocumentacionNueva");
var formDatosPersonales = document.querySelector("#formPersonaEdit");
var formPrestamoDocumentos = document.querySelector("#formDocumentosEntregados");
document.getElementById("btnAnterior").style.display = "none";
document.getElementById("btnSiguiente").style.display = "none";
document.getElementById("btnConfirmPrestamo").style.display = "none";
document.getElementById("btnConfirmDevolucion").style.display = "none";
var tabActual = 0;
var cantidadDocPrestados = 0;
var statusConfirmacionDevolucionDoc = false;
mostrarTab(tabActual);

document.addEventListener('DOMContentLoaded',function(){ 
    resaltarInputsObligatoriosDatosPersonales();
    $('#ModalFormDocumentacionVerificado').on('hidden.bs.modal', function(){
        formDocumentosEntregados.reset();
      });
});
//Funcion para Datatable de Mostrar todos los Estudiantes Verificados
if(getPagina() == "estudiantes"){
    document.addEventListener('DOMContentLoaded', function(){
        tableEstudiantes = $('#tableEstudiantes').dataTable( {
            "aProcessing":true,
            "aServerSide":true,
            "language": {
                "url": " "+base_url+"/Assets/plugins/Spanish.json"
            },
            "ajax":{
                "url": " "+base_url+"/Estudiantes/getEstudiantes",
                "dataSrc":""
            },
            "columns":[
                {"data":"numeracion"},
                {"data":"nombre_persona"},
                {"data":"apellidos"},
                {"data":"nombre_plantel"},
                {"data":"nombre_carrera"},
                {"data":"grado"},
                {"data":"nombre_salon"},
                {"data":"validacion_doctos_status"},
                {"data":"validacion_datos_personales_status"},
                {"data":"options"}
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
            "iDisplayLength": 25
        });
    });
    $('#tableEstudiantes').DataTable();
}else if(getPagina() == "verificados"){
    document.addEventListener('DOMContentLoaded', function(){
        tableEstudiantes = $('#tableEstudiantes').dataTable( {
            "aProcessing":true,
            "aServerSide":true,
            "language": {
                "url": " "+base_url+"/Assets/plugins/Spanish.json"
            },
            "ajax":{
                "url": " "+base_url+"/Estudiantes/getEstudiantesVerificados",
                "dataSrc":""
            },
            "columns":[
                {"data":"numeracion"},
                {"data":"nombre_persona"},
                {"data":"apellidos"},
                {"data":"nombre_plantel"},
                {"data":"nombre_carrera"},
                {"data":"grado"},
                {"data":"nombre_salon"},
                {"data":"validacion"},
                {"data":"options"}
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
            "iDisplayLength": 25
        });
    });
    $('#tableEstudiantes').DataTable();
}else if(getPagina() == "verificar_datos_personales"){
    document.addEventListener('DOMContentLoaded', function(){
        tableEstudiantes = $('#tableEstudiantes').dataTable( {
            "aProcessing":true,
            "aServerSide":true,
            "language": {
                "url": " "+base_url+"/Assets/plugins/Spanish.json"
            },
            "ajax":{
                "url": " "+base_url+"/Estudiantes/getEstudiantesVerificarDatosPersonales",
                "dataSrc":""
            },
            "columns":[
                {"data":"numeracion"},
                {"data":"nombre_persona"},
                {"data":"apellidos"},
                {"data":"nombre_plantel"},
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
            "info": true,
            "autoWidth": false,
            "scrollY": '42vh',
            "scrollCollapse": true,
            "bDestroy": true,
            "order": [[ 0, "asc" ]],
            "iDisplayLength": 25
        });
    });
    $('#tableEstudiantes').DataTable();
}else if(getPagina() == "verificar_documentos"){
    document.addEventListener('DOMContentLoaded', function(){
        tableEstudiantes = $('#tableEstudiantes').dataTable( {
            "aProcessing":true,
            "aServerSide":true,
            "language": {
                "url": " "+base_url+"/Assets/plugins/Spanish.json"
            },
            "ajax":{
                "url": " "+base_url+"/Estudiantes/getEstudiantesVerificarDocumentos",
                "dataSrc":""
            },
            "columns":[
                {"data":"numeracion"},
                {"data":"nombre_persona"},
                {"data":"apellidos"},
                {"data":"nombre_plantel"},
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
            "info": true,
            "autoWidth": false,
            "scrollY": '42vh',
            "scrollCollapse": true,
            "bDestroy": true,
            "order": [[ 0, "asc" ]],
            "iDisplayLength": 25
        });
    });
    $('#tableEstudiantes').DataTable();
}

function fntDocumentacionInscripcion(value){
    var idInscripcion = value.getAttribute('idins');
    var estatusValidacionDocumentacion = value.getAttribute('valdo');
    var usuarioValidado = value.getAttribute('usv');
    document.querySelector('#idInscripcion').value = idInscripcion;
    let urlDocumentacion = base_url+"/Estudiantes/getDocumentacion?idIns="+idInscripcion;
    fetch(urlDocumentacion)
    .then(res => res.json())
    .then((resultDocumentacion) =>{
        if(resultDocumentacion != 0){
            document.querySelector('#nomPersonaDocumentacion').innerHTML = resultDocumentacion[0]['nom_persona'];
            var numeracion = 0;
            document.querySelector('#tbDocumentacionIns').innerHTML="";
            resultDocumentacion.forEach(element => {
                numeracion +=1;
                document.querySelector('#card-documentacion').style.display = "block";
                document.querySelector('#alertSinDocumentacion').style.display = "none";
                document.querySelector('#tbDocumentacionIns').innerHTML+="<tr class='fila"+numeracion+"'><th scope='row'>"+numeracion+"</th><td>"+element.tipo_documento+"</td><td><div class='custom-control custom-switch custom-switch-off-danger custom-switch-on-success'><input id='"+element.id_detalle_documento+"' t='original' in='"+idInscripcion+"'class='original"+numeracion+" original"+element.id_detalle_documento+idInscripcion+"'type='checkbox' aria-label='Checkbox for following text input' onclick='clickOriginal(this)'></div></td><td><div class='custom-control custom-switch custom-switch-off-danger custom-switch-on-success'><input id='"+element.id_detalle_documento+"' t='copia' in='"+idInscripcion+"'class = 'copia"+numeracion+" copia"+element.id_detalle_documento+idInscripcion+"' type='checkbox' aria-label='Checkbox for following text input' onclick='clickCopia(this)'></div></td><td><div class='custom-control custom-switch custom-switch-off-danger custom-switch-on-success'><input type='number' id='cantidadCopia' idet='"+element.id_detalle_documento+"' t='cantidad_copia' in='"+idInscripcion+"'class='form-control form-control-sm detalledoc"+element.id_detalle_documento+" cantidad"+element.id_detalle_documento+idInscripcion+"' min='0' patten='[0-9]+' max='9' required onchange='inputCantidadCopia(this)'></div></td></tr>";
            });
            checkEstatusDocumentacion(idInscripcion);
        }else{
            document.querySelector('#nomPersonaDocumentacion').innerHTML = "";
            document.querySelector('#card-documentacion').style.display = "none";
            document.querySelector('#alertSinDocumentacion').style.display = "block";
        }
    })
    .catch(err => {throw err});
}
function fntDocumentacionInscripcionVerificado(value){
    cantidadDocPrestados = 0;
    statusConfirmacionDevolucionDoc = false;
    var idInscripcion = value.getAttribute('idins');
    var nombre = value.getAttribute('n');
    var estatusValidacionDocumentacion = value.getAttribute('valdo');
    var usuarioValidado = value.getAttribute('usv');
    document.querySelector('#idInscripcionPrestamo').value = idInscripcion;
    document.querySelector('#btnConfirmDevolucion').style.display = 'none';
    document.querySelector('#tipo').value = "";
    if(estatusValidacionDocumentacion == 1){
        document.querySelector('#checkDocumentacionValidado').checked = true;
        document.querySelector('#checkDocumentacionValidado').disabled = true;
        let urlUsuarioValidacion = base_url+"/Estudiantes/gettUsuarioValidacion?idUser="+usuarioValidado;
        fetch(urlUsuarioValidacion)
        .then(res => res.json())
        .then((resulUsuario) =>{
            if(resulUsuario){document.querySelector('#nomPersonaDocumentacionVerificado').innerHTML = nombre;}
            document.querySelector('#nombre_usuarios_verificacion').innerHTML = resulUsuario;
        })
        .catch(err => {throw err});

    }else{

    }
    fnGetDocumentosEntregados(idInscripcion);
    gnGetHistorialPrestamoDocumentos(idInscripcion);
}
function fnGetDocumentosEntregados(value){
    var idInscripcion = value;
    let urlDocumentacion = base_url+"/Estudiantes/getDocumentosEntregados?idIns="+idInscripcion;
    fetch(urlDocumentacion)
    .then(res => res.json())
    .then((resultDocumentacion) =>{
        var numeracion = 0;
        document.querySelector('#tbDocumentosEntregados').innerHTML="";
        document.querySelector('#tbDocumentosEntregadosPrestamos').innerHTML="";
        resultDocumentacion.forEach(element => {
            numeracion +=1;
            var nombreDocumento = element.tipo_documento;
            var statusOriginal = "";
            var statusCopia = "";
            var statusPrestamo = "";
            if(element.entrego_cantidad_original != 0){
                statusOriginal = "<span class='badge badge-success'>Entregado</span>";
            }else{
                statusOriginal = "<span class='badge badge-warning'>No entregado</span>"; 
            }
            if(element.entrego_cantidad_copias != 0){
                statusCopia = "<span class='badge badge-success'>"+element.entrego_cantidad_copias+"</span> copias entregadas";
            }else{
                statusCopia = "<span class='badge badge-warning'>No entregado</span>"; 
            }
            if(element.prestamo_original != 0){
                cantidadDocPrestados += 1;
                statusPrestamo = "<span class='badge badge-success'>Prestado</span>";
                var checked = "checked";
            }else{
                statusPrestamo = "<span class='badge badge-warning'>No prestado</span>"; 
                var checked = "";
            }
            document.querySelector('#tbDocumentosEntregados').innerHTML+="<tr><th scope='row'>"+numeracion+"</th><td>"+nombreDocumento+"</td><td>"+statusOriginal+"</div></td><td>"+statusCopia+"</td><td>"+statusPrestamo+"</td></tr>";
            document.querySelector('#tbDocumentosEntregadosPrestamos').innerHTML+="<tr><th scope='row'>"+numeracion+"</th><td>"+nombreDocumento+"</td><td><div class='custom-control custom-switch custom-switch-off-danger custom-switch-on-success'><input name='"+element.id+"' type='checkbox' aria-label='Checkbox for following text input' "+checked+" onclick='fnCheckDevolucionDoc(this)'></div></td></td></tr>";
        });
        if(cantidadDocPrestados != 0){
            document.querySelector('#btnConfirmPrestamo').disabled = true;
            document.querySelector('#divFechaDevolucion').style.display= 'none';
        }else{
            document.querySelector('#btnConfirmPrestamo').disabled = false;
            document.querySelector('#divFechaDevolucion').style.display= 'inline';
            document.querySelector('#btnConfirmDevolucion').style.display = 'none';
        }
    })
    .catch(err => {throw err});
}

function getPagina(){
    return document.querySelector('.nombre_pagina').textContent;
}
function validacionDocumentacion(value){
    comprobarDocumentosEntregados();
}
function comprobarDocumentosEntregados(){
    var documentos = document.querySelector('#tbDocumentacionIns');
    var valorcheck = document.querySelector('#checkDocumentacion').checked;
    const cantidadfilas = documentos.children.length;
    var arrayOriginal = [];
    for(i = 1; i<=cantidadfilas; i++){
        var valor = document.querySelector('.original'+i).checked;
        if(valor == true){
            arrayOriginal.push(valor);
        }
    }
    if(cantidadfilas == arrayOriginal.length){
        document.getElementById("btnActionFormNueva").style.display = "block";
    }else{
        document.querySelector('#checkDocumentacion').checked = false;
        Swal.fire({
            title: 'Mensaje!',
            html: "<p>Faltan documentos por entregar</p><small style='color:#3085d6'>Es importante que el estudiante tenga su documentación completa</small>",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
          }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector('#checkDocumentacion').checked = false;
            }
          })
    }
    if(valorcheck == false){
        document.getElementById("btnActionFormNueva").style.display = "none";
    }
}

formDocumentacion.onsubmit = function(e){
    e.preventDefault();
    var documentos = document.querySelector('#tbDocumentacionIns');
    //var valorcheck = document.querySelector('#checkDocumentacion').checked;
    const cantidadfilas = documentos.children.length;
    var arrayOriginal = [];
    for(i = 1; i<=cantidadfilas; i++){
        var valor = document.querySelector('.original'+i).checked;
        if(valor == true){
            arrayOriginal.push(valor);
        }
    }if(cantidadfilas == arrayOriginal.length){
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Estudiantes/setValidacionDocumentacion';
        var formData = new FormData(formDocumentacion);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                formDocumentacion.reset();
                Swal.fire({
                    icon: 'success',
                    title: 'Exito...',
                    text: 'Validacion guardada',
                  }).then((result) =>{
                    $('.close').click();
                  })
                  tableEstudiantes.api().ajax.reload();  
            }
            return false;
    }
    }else{
        Swal.fire({
            title: 'Mensaje!',
            html: "<p>Faltan documentos por entregar</p><small style='color:#3085d6'>Es importante que el estudiante tenga su documentación completa</small>",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
          }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector('#checkDocumentacion').checked = false;
            }
          })
    }
}

function clickOriginal(value){
    var tipoDocumentacion = value.getAttribute('t');
    var idDetalleDocumentacion = value.id;
    var estadoCkeck = value.checked;
    var idInscripcion = value.getAttribute('in');
    let url = base_url+"/Estudiantes/setOriginalDocumentacion?idInscripcion="+idInscripcion+"&idDetalle="+idDetalleDocumentacion+"&tipo="+tipoDocumentacion+"&estado="+estadoCkeck;
    fetch(url)
    .then(res => res.json())
    .then((resultado) => {
		//console.log(resultado);
    })
    .catch(err => { throw err });
}
function clickCopia(value){
    var tipoDocumentacion = value.getAttribute('t');
    var idDetalleDocumentacion = value.id;
    var estadoCkeck = value.checked;
    if(estadoCkeck != true){
        document.querySelector('.detalledoc'+idDetalleDocumentacion).value = 0;
    }else{
        document.querySelector('.detalledoc'+idDetalleDocumentacion).value = 1;
        document.querySelector("input[idet='"+value.id+"']").focus();
    }
    var idInscripcion = value.getAttribute('in');
    var cantidad = document.querySelector('.detalledoc'+idDetalleDocumentacion).value;
    let url = base_url+"/Estudiantes/setCopiaDocumentacion?idInscripcion="+idInscripcion+"&idDetalle="+idDetalleDocumentacion+"&tipo="+tipoDocumentacion+"&estado="+estadoCkeck+"&cantidad="+cantidad;
    fetch(url)
    .then(res => res.json())
    .then((resultado) => {
		//console.log(resultado);
    })
    .catch(err => { throw err });
}
function inputCantidadCopia(value){
    var tipoDocumentacion = value.getAttribute('t');
    var idDetalleDocumentacion = value.getAttribute('idet');
    var idInscripcion = value.getAttribute('in');
    var valor = document.querySelector('.detalledoc'+idDetalleDocumentacion).value;
    let url = base_url+"/Estudiantes/setCantidadCopiaDocumentacion?idInscripcion="+idInscripcion+"&idDetalle="+idDetalleDocumentacion+"&tipo="+tipoDocumentacion+"&cantidad="+valor;
    fetch(url)
    .then(res => res.json())
    .then((resultado) => {
		//console.log(resultado);
    })
    .catch(err => { throw err });
}   

function checkEstatusDocumentacion(value){
    let url = base_url+"/Estudiantes/getEstatusDocumentacion?idInscripcion="+value;
    fetch(url)
    .then(res => res.json())
    .then((resultado) => {
		resultado.forEach(element => {
            var idDocumentacion = element.id_detalle_documentos;
            var estatusOriginal;
            var estatusCopia;
            if(element.entrego_cantidad_original != 0){
                estatusOriginal = true;
            }else{
                estatusOriginal = false;
            }
            if(element.entrego_cantidad_copias != 0){
                estatusCopia = true;
            }else{
                estatusCopia = false;
            }
            document.querySelector('.original'+idDocumentacion+value).checked = estatusOriginal;
            document.querySelector('.copia'+idDocumentacion+value).checked = estatusCopia;
            document.querySelector('.cantidad'+idDocumentacion+value).value = element.entrego_cantidad_copias;     
        });
    })
    .catch(err => { throw err });
}

function resaltarInputsObligatoriosDatosPersonales(){
    var inputImportantes = ['txtNombreEdit','txtApellidoPaEdit','txtApellidoMaEdit','txtTelCelEdit','txtEmailEdit','listEstadoEdit','listMunicipioEdit','listLocalidadEdit','txtFechaNacimientoEdit'];
    inputImportantes.forEach(element => {
        document.getElementById(element).style.setProperty("background-color", "#F9D25A", "important");
    });
}
function estadoSeleccionadoEdit(value){
    const selMunicipio = document.querySelector('#listMunicipioEdit');
    let url = base_url+"/Estudiantes/getMunicipios?idestado="+value;
    fetch(url)
    .then(res => res.json())
    .then((resultado) => {
        selMunicipio.innerHTML = "";
        for (let i = 0; i < resultado.length; i++) {
            opcion = document.createElement('option');
            opcion.text = resultado[i]['nombre'];
            opcion.value = resultado[i]['id'];
            selMunicipio.appendChild(opcion);
            
        }
    })
    .catch(err =>{throw err});  
}
function municipioSeleccionadoEdit(value){
    const selLocalidades = document.querySelector('#listLocalidadEdit');
    let url = base_url+"/Estudiantes/getLocalidades?idmunicipio="+value;
    fetch(url)
        .then(res => res.json())
        .then((resultado) => {
            selLocalidades.innerHTML ="";
            for (let i = 0; i < resultado.length; i++) {
                opcion = document.createElement('option');
                opcion.text = resultado[i]['nombre'];
                opcion.value = resultado[i]['id'];
                selLocalidades.appendChild(opcion);
            }
        })
        .catch(err => {throw err});
}

function fnDatosPersonalesVerificacion(value){
    var idPersona = value.getAttribute('idper');
    var estatusValidacion = value.getAttribute('valda');
    var usuarioValidacion = value.getAttribute('usv');
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Estudiantes/getPersonaEdit/'+idPersona;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData){
                //console.log(objData);
                document.querySelector("#idEdit").value = objData.id;
                document.querySelector("#txtNombreEdit").value = objData.nombre_persona;    
                document.querySelector("#txtApellidoPaEdit").value = objData.ap_paterno;
                document.querySelector("#txtApellidoMaEdit").value = objData.ap_materno;
                document.querySelector("#txtDireccionEdit").value = objData.direccion;
                document.querySelector("#txtEdadEdit").value = objData.edad;
                document.querySelector('#listSexoEdit').querySelector('option[value="'+objData.sexo+'"]').selected = true;
                document.querySelector("#txtCPEdit").value = objData.cp;
                document.querySelector("#txtColoniaEdit").value = objData.colonia;
                document.querySelector("#txtTelCelEdit").value = objData.tel_celular;
                document.querySelector("#txtTelFiEdit").value = objData.tel_fijo;
                document.querySelector("#txtEmailEdit").value = objData.email;
                document.querySelector('#listEstadoCivilEdit').querySelector('option[value="'+objData.edo_civil+'"]').selected = true;
                document.querySelector("#txtOcupacionEdit").value = objData.ocupacion;
                document.querySelector('#listEscolaridadEdit').querySelector('option[value="'+objData.id_escolaridad+'"]').selected = true;
                document.querySelector('#txtFechaNacimientoEdit').value = objData.fecha_nacimiento;
                var idEstadoPersona = "";
                var idMunicipioPersona = "";
                var idLocalidadPersona = "";
                document.querySelector('#listMunicipioEdit').innerHTML = "";
                document.querySelector('#listLocalidadEdit').innerHTML = "";
                let url = base_url+"/Estudiantes/getListEstados";
                fetch(url)
                    .then(res => res.json())
                    .then((resultado) => {
                    for (let i = 0; i < resultado.length; i++) {
                        document.querySelector('#listEstadoEdit').innerHTML += "<option value='"+resultado[i]['id']+"'>"+resultado[i]['nombre']+"</option>"
                        if(resultado[i]['id'] == objData.idest){
                            idEstadoPersona = resultado[i]['id'];
                            select = document.querySelector('#listEstadoEdit');
                            var opt = document.createElement('option');
                            opt.value = resultado[i]['id'];
                            opt.innerHTML = resultado[i]['nombre'];
                            opt.setAttribute("selected","");
                            select.appendChild(opt);
                            let urlMunicipios = base_url+"/Estudiantes/getMunicipios?idestado="+idEstadoPersona;
                            fetch(urlMunicipios)
                                .then(res => res.json())
                                .then((resultadoMunicipio) =>{
                                    resultadoMunicipio.forEach(element => {
                                        document.querySelector('#listMunicipioEdit').innerHTML += "<option value='"+element['id']+"'>"+element['nombre']+"</option>"
                                        if(element['id'] == objData.idmun){
                                            idMunicipioPersona = element['id'];
                                            selectMunicipio = document.querySelector('#listMunicipioEdit');
                                            var optMunicipio = document.createElement('option');
                                            optMunicipio.value = element['id'];
                                            optMunicipio.innerHTML = element['nombre'];
                                            optMunicipio.setAttribute("selected","");
                                            selectMunicipio.appendChild(optMunicipio);
                                            let urlLocalidades = base_url+"/Estudiantes/getLocalidades?idmunicipio="+idMunicipioPersona;
                                            fetch(urlLocalidades)
                                                .then(res => res.json())
                                                .then((resultadoLocalidad) =>{
                                                    resultadoLocalidad.forEach(element => {
                                                        document.querySelector('#listLocalidadEdit').innerHTML += "<option value='"+element['id']+"'>"+element['nombre']+"</option>"
                                                        if(element['id'] == objData.id_localidad){
                                                            idLocalidadPersona = element['id'];
                                                            selectLocalidades = document.querySelector('#listLocalidadEdit');
                                                            var optLocalidad = document.createElement('option');
                                                            optLocalidad.value = element['id'];
                                                            optLocalidad.innerHTML = element['nombre'];
                                                            optLocalidad.setAttribute("selected","");
                                                            selectLocalidades.appendChild(optLocalidad);
                                                        }
                                                    });
                                                })
                                                .catch(err => {throw err});
                                        }

                                    });
                                })
                                .catch(err => {throw err});
                        }
                    }
                })
                .catch(err => { throw err });
                //document.querySelector('#listCategoriaEdit').querySelector('option[value="'+objData.id_categoria_persona+'"]').selected = true;
                //document.querySelector('#listEstatusEdit').querySelector('option[value="'+objData.estatus+'"]').selected = true;

            }
        }
    }
    var inputDesabilitar = ['txtNombreEdit','txtApellidoPaEdit','txtApellidoMaEdit','listSexoEdit','txtEdadEdit','listEstadoCivilEdit','txtFechaNacimientoEdit','txtOcupacionEdit','txtTelCelEdit','txtTelFiEdit','txtEmailEdit','listEscolaridadEdit','listEstadoEdit','listMunicipioEdit','listLocalidadEdit','txtColoniaEdit','txtCPEdit','txtDireccionEdit'];
    if(estatusValidacion == 1){
        document.querySelector('#checkValidacionDatos').disabled = true;
        inputDesabilitar.forEach(element => {
            document.querySelector('#'+element).disabled = true;
        });formPersonaEdit 
        let urlUsuarioValidacion = base_url+"/Estudiantes/gettUsuarioValidacion?idUser="+usuarioValidacion;
        fetch(urlUsuarioValidacion)
        .then(res => res.json())
        .then((resulUsuario) =>{
            document.querySelector('#usuario_verificacion_datper').innerHTML = '<p>Ya está <b style="color:#3b7ddd">validado</b> por: <span class="badge badge-success">'+resulUsuario+'</span></p>';
        })
        .catch(err => {throw err});    
    }else{
        document.querySelector('#checkValidacionDatos').disabled = false;
        document.querySelector('#usuario_verificacion_datper').innerHTML = "";
        inputDesabilitar.forEach(element => {
            document.querySelector('#'+element).disabled = false;
        });formPersonaEdit 
    }
}
function validacionDatosPersonales(value){
    if(value.checked == true){
        document.getElementById("btnActionFormEdit").style.display = "block";
    }else{
        document.getElementById("btnActionFormEdit").style.display = "none";
    }
}

formDatosPersonales.onsubmit = function(e){
    e.preventDefault();
    var strNombre = document.querySelector('#txtNombreEdit').value;
    var strAppPaterno = document.querySelector('#txtApellidoPaEdit').value;
    var strAppMaterno = document.querySelector('#txtApellidoMaEdit').value;
    var strSexo = document.querySelector('#listSexoEdit').value;
    var intEdad = document.querySelector('#txtEdadEdit').value;
    var strEstadoCivil = document.querySelector('#listEstadoCivilEdit').value;
    var strFechaNacimiento = document.querySelector('#txtFechaNacimientoEdit').value;
    var strOcupacion = document.querySelector('#txtOcupacionEdit').value;
    var intTelefonoCel = document.querySelector('#txtTelCelEdit').value;
    var intTelefonofijo = document.querySelector('#txtTelFiEdit').value;
    var strEmail = document.querySelector('#txtEmailEdit').value;
    var intEscolaridad = document.querySelector('#listEscolaridadEdit').value;
    var intEstado = document.querySelector('#listEstadoEdit').value;
    var intMunicipio = document.querySelector('#listMunicipioEdit').value;
    var intLocalidad = document.querySelector('#listLocalidadEdit').value;
    var strColonia = document.querySelector('#txtColoniaEdit').value;
    var intCP = document.querySelector('#txtCPEdit').value;
    var strDireccion = document.querySelector('#txtDireccionEdit').value;
    if(strNombre == '' || strAppPaterno == '' || strAppMaterno == '' || strSexo == '' || intEdad == '' || strEstadoCivil == '' ||
    strFechaNacimiento == '' || strOcupacion == '' || intTelefonoCel == '' || intTelefonofijo == '' || strEmail == '' ||
    intEscolaridad == '' || intEstado == '' || intMunicipio == '' || intLocalidad == '' || strColonia == '' || intCP == '' ||
    strDireccion == ''){
        swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
        return false;
    }
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Estudiantes/setValidacionDatosPersonales';
    var formData = new FormData(formDatosPersonales);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            //console.log(objData);
            formDatosPersonales.reset();
            Swal.fire({
                icon: 'success',
                title: 'Exito...',
                text: 'Validacion guardada',
                }).then((result) =>{
                $('.close').click();
                })
                tableEstudiantes.api().ajax.reload(); 
        }
        return false;
    }
}


function fnNavTab(numTab){
    var x = document.getElementsByClassName("tab");
    for( var i = 0; i<x.length;i++){
        x[i].style.display = "none";
    }
    x[numTab].style.display = "block";
    if (numTab == 0) {
        document.getElementById("btnSiguiente").style.display = "inline";
        document.getElementById("btnAnterior").style.display = "none";
    } else {
        document.getElementById("btnAnterior").style.display = "inline";
    }
    if (numTab == (x.length - 1)) {
        document.getElementById("btnSiguiente").style.display = "none";
    } else {
        document.getElementById("btnSiguiente").style.display = "inline";
    }
    if(numTab == 1){
        document.getElementById("btnConfirmPrestamo").style.display = "inline";
    }else{
        document.getElementById("btnConfirmPrestamo").style.display = "none";
        document.getElementById("btnConfirmDevolucion").style.display = "none";
    }
    estadoIndicadores(numTab);
}
function mostrarTab(tabActual) {
    var tab = document.getElementsByClassName("tab");
    tab[tabActual].style.display = "block";
    if (tabActual == 0) {
        document.getElementById("btnSiguiente").style.display = "inline";
        document.getElementById("btnAnterior").style.display = "none";
    } else {
        document.getElementById("btnAnterior").style.display = "inline";
    }
    if (tabActual == (tab.length - 1)) {
        document.getElementById("btnSiguiente").style.display = "none";
    } else {
        document.getElementById("btnSiguiente").style.display = "inline";
    }
    if(tabActual == 1){
        document.getElementById("btnConfirmPrestamo").style.display = "inline";   
    }else{
        document.getElementById("btnConfirmPrestamo").style.display = "none";
        document.getElementById("btnConfirmDevolucion").style.display = "none";
    }
    estadoIndicadores(tabActual)
}
function pasarTab(n) {
    var x = document.getElementsByClassName("tab");
    x[tabActual].style.display = "none";
    tabActual = tabActual + n;
    if (tabActual >= x.length) {

    }
    mostrarTab(tabActual);
}
function estadoIndicadores(tabActual){
    //console.log(tabActual);
    var posStep, step = document.getElementsByClassName("step");
    var posTab, tab = document.getElementsByClassName("tab-nav");
    for (posStep = 0; posStep < step.length; posStep++) {
        step[posStep].className = step[posStep].className.replace(" active", "");
    }
    step[tabActual].className += " active";
    for (posTab = 0; posTab < tab.length; posTab++) {
        tab[posTab].className = tab[posTab].className.replace(" active", "");
    }
    tab[tabActual].className += " active";
}


formPrestamoDocumentos.onsubmit = function(e){
    e.preventDefault();
    var strComentario = document.querySelector('#txtComentarioPrestamo').value;
    var strFechaDevolucion = document.querySelector('#txtFechaDevolucion').value;
    var idInscripcion = document.querySelector('#idInscripcionPrestamo').value;
    if(strComentario == ''){
        swal.fire("Atención", "Escribe un comentario para hacer el prestamo", "warning");
        return false;
    }
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Estudiantes/setPrestamoDocumentos';
    var formData = new FormData(formPrestamoDocumentos);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
    /*             console.log(objData);
 */            if(objData.status){
                formPrestamoDocumentos.reset();
                swal.fire("Prestamos", objData.msg, "success").then((result) =>{
                    $('#step3-tab').click();
                    fnGetDocumentosEntregados(idInscripcion);
                    gnGetHistorialPrestamoDocumentos(idInscripcion);

                });
            }else{
                swal.fire("Prestamos", objData.msg, "error").then((result) =>{
                    //$('.close').click();
                });
            }
        }
        return false;
    }
}
function gnGetHistorialPrestamoDocumentos(idInscripcion){
    let urlHistorialDoc = base_url+"/Estudiantes/getHistorialPrestamoDocumentos?idIns="+idInscripcion;
    fetch(urlHistorialDoc)
    .then(res => res.json())
    .then((resHistorialDoc) =>{
        document.querySelector('#tbHistorialPrestamoDoc').innerHTML = "";
        var numeracion = 0;
        resHistorialDoc.forEach(element => {
            console.log(element);
            numeracion += 1;
            document.querySelector('#folioDoc').value = element.folio;
            var opcionesDevuelto = '';
            var foliob64 = window.btoa(unescape(encodeURIComponent(element.folio)))
            var opcionesNoDevuelto = '<div class="btn-group"><button type="button" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-layer-group"></i> &nbsp; Acciones</button><div class="dropdown-menu"><a class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal" href="imprimir_comp_doc_prestamo/'+foliob64+'" target="_blank"> &nbsp;&nbsp; <i class="far fa-address-book"></i> &nbsp;Imprimir</a><button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal" f="'+element.folio+'" onclick="fnListadocumentosFolio(this)" data-toggle="modal" data-target="#ModalListaDocFolio" title="Historial Documentacion"> &nbsp;&nbsp; <i class="far fa-file-word"></i> &nbsp;Ver</button><div class="dropdown-divider"></div></div></div></div>';
            if(element.fecha_devolucion == null || element.fecha_devolucion == ''){
                document.querySelector('#tbHistorialPrestamoDoc').innerHTML += "<tr><th scope='row'>"+numeracion+"</th><td>"+element.folio+"</td><td>"+element.fecha_prestamo+"</div></td><td>"+element.fecha_estimada_devolucion+"</td><td>"+element.nombre_usuario+"</td><td>No devuelto</td><td>"+opcionesNoDevuelto+"</td></tr>";
            }else{
                document.querySelector('#tbHistorialPrestamoDoc').innerHTML += "<tr><th scope='row'>"+numeracion+"</th><td>"+element.folio+"</td><td>"+element.fecha_prestamo+"</div></td><td>"+element.fecha_estimada_devolucion+"</td><td>"+element.nombre_usuario+"</td><td>Devuelto</td><td>"+opcionesDevuelto+"</td></tr>";
            }
        });
    })
    .catch(err => {throw err});
}
function fnListadocumentosFolio(value){
    var folio = value.getAttribute('f');
    let urlListaDocFolio = base_url+"/Estudiantes/getListaDocumentosFolio?idFolio="+folio;
    fetch(urlListaDocFolio)
    .then(res => res.json())
    .then((resDocFolio) =>{
        var numeracion = 0;
        document.querySelector('#tbVerHistorialDocumentacion').innerHTML = "";
        resDocFolio.forEach(element => {
            numeracion += 1;
            document.querySelector('#tbVerHistorialDocumentacion').innerHTML += "<tr><th scope='row'>"+numeracion+"</th><td>"+element.folio+"</td><td>"+element.tipo_documento+"</td></tr>";
        });
    })
    .catch(err => {throw err});
}


function fnCheckDevolucionDoc(value){
    if(cantidadDocPrestados != 0){
        if(value.checked == false){
            if(statusConfirmacionDevolucionDoc == false){
                Swal.fire({
                title: 'Devolución?',
                html: "Decea hacer una devolución?<br><span class='badge badge-warning'>Selecciona todos los documentos en la lista que desa devolver</span>",
                icon: 'question',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK!'
              }).then((result) =>{
                  if(result.isConfirmed){
                    statusConfirmacionDevolucionDoc = true;
                    value.checked = true;
                  }
              })
            }else{
                document.querySelector('#btnConfirmDevolucion').style.display = 'inline';
                document.querySelector('#tipo').value = "dev";
            }
        }
    }else{
        comprobarDocumentosEntregados();

    }
}
function btnConfirmDevolucion(value){
    var checks = document.querySelector('#tbDocumentosEntregadosPrestamos');
    var comentario = document.querySelector('#txtComentarioPrestamo').value;
    var folio = document.querySelector('#folioDoc').value;
    var idInsc = document.querySelector('#idInscripcionPrestamo').value;
    var input = checks.getElementsByTagName('INPUT');
    var resultados = new Array();
    var inputs = new Array();
    var folioDoc = {'folio': folio};
    resultados.push(folioDoc);
    input.forEach(element => {
        var valores = {'id_doc': element.getAttribute('name'),'check':element.checked,'comentario':comentario};
        inputs.push(valores);
    });
    resultados.push(inputs);
    var data = JSON.stringify(resultados);
    if(comentario == ''){
        swal.fire("Atención","Atención todos los campos son obligatorios","warning");
        return false;
    }
    let urlDevolucionDoctos = base_url+"/Estudiantes/setDevolucionDocumentos?data="+data;
    fetch(urlDevolucionDoctos)
    .then(res => res.json())
    .then((resDevDoc) =>{
        if(resDevDoc.estatus){
            swal.fire("Devolución",resDevDoc.msg,"success").then((result) =>{
                //fnGetDocumentosEntregados(idInsc);
                //gnGetHistorialPrestamoDocumentos(idInsc);
                $('#step3-tab').click();
            });
            
        }else{
            swal.fire("Error",resDevDoc.msg,"error");
        }
    })  
    .catch(err => {throw err});
}

