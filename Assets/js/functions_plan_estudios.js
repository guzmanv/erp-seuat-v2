var formPlanEstudiosNuevo = document.querySelector("#formPlanEstudiosNueva");
document.getElementById("btnAnterior").style.display = "none";
document.getElementById("btnAnteriorEdit").style.display = "none";
document.getElementById("btnSiguiente").style.display = "none";
document.getElementById("btnSiguienteEdit").style.display = "none";
document.getElementById("btnActionFormNuevo").style.display = "none";
document.getElementById("btnActionFormEdit").style.display = "none";
var tabActual = 0;
var tabActualEdit = 0;
mostrarTab(tabActual);
mostrarTabEdit(tabActualEdit);
var tablePlanEstudios;

//Datatable
document.addEventListener('DOMContentLoaded', function(){
	tablePlanEstudios = $('#tablePlanEstudios').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/PlanEstudios/getPlanEstudios",
            "dataSrc":""
        },
        "columns":[
            {"data":"numeracion"},
            {"data":"nombre_carrera"},
            {"data":"nombre_categoria_carrera"},
			      {"data":"nombre_plantel"},
			      {"data":"rvoe"},
			      {"data":"vigencia_rvoe"},
			      {"data":"estatus"},
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
$('#tablePlanEstudios').DataTable();


function fnNavTab(numTab){
  var x = document.getElementsByClassName("tab");
  for( var i = 0; i<x.length;i++){
    x[i].style.display = "none";
  }
  x[numTab].style.display = "block";
  estadoIndicadores(numTab);

}
function fnNavTabEdit(numTab){
    var x = document.getElementsByClassName("tabEdit");
    for( var i = 0; i<x.length;i++){
      x[i].style.display = "none";
    }
    x[numTab].style.display = "block";
    estadoIndicadoresEdit(numTab);
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
    document.getElementById("btnActionFormNuevo").style.display = "inline";
  } else {
    document.getElementById("btnSiguiente").style.display = "inline";
    document.getElementById("btnActionFormNuevo").style.display = "none";
  }
  estadoIndicadores(tabActual)
}
function mostrarTabEdit(tabActualEdit) {
    var tab = document.getElementsByClassName("tabEdit");
    tab[tabActualEdit].style.display = "block";
    if (tabActualEdit == 0) {
      document.getElementById("btnSiguienteEdit").style.display = "inline";
      document.getElementById("btnAnteriorEdit").style.display = "none";
    } else {
      document.getElementById("btnAnteriorEdit").style.display = "inline";
    }
    if (tabActualEdit == (tab.length - 1)) {
      document.getElementById("btnSiguienteEdit").style.display = "none";
      document.getElementById("btnActionFormEdit").style.display = "inline";
    } else {
      document.getElementById("btnSiguienteEdit").style.display = "inline";
      document.getElementById("btnActionFormEdit").style.display = "none";
    }
    estadoIndicadoresEdit(tabActualEdit)
  }


function pasarTab(n) {
  var x = document.getElementsByClassName("tab");
  //n = 1 : siguiente; n = -1 : anterior
  x[tabActual].style.display = "none";
  tabActual = tabActual + n;
  if (tabActual >= x.length) {
    //var jos = document.getElementById("formPlanEstudiosNueva").submit();
    //console.log(jos);
  }
  mostrarTab(tabActual);
  
}
function pasarTabEdit(n) {
    var x = document.getElementsByClassName("tabEdit");
    //n = 1 : siguiente; n = -1 : anterior
    x[tabActualEdit].style.display = "none";
    tabActualEdit = tabActualEdit + n;
    if (tabActualEdit >= x.length) {
      //var jos = document.getElementById("formPlanEstudiosNueva").submit();
      //console.log(jos);
    }
    mostrarTabEdit(tabActualEdit);
    
  }


function estadoIndicadores(tabActual) {
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
function estadoIndicadoresEdit(tabActualEdit) {
    var posStep, step = document.getElementsByClassName("stepEdit");
    var posTab, tab = document.getElementsByClassName("tab-navEdit");
    for (posStep = 0; posStep < step.length; posStep++) {
      step[posStep].className = step[posStep].className.replace(" active", "");
  
    }
    step[tabActualEdit].className += " active";
    for (posTab = 0; posTab < tab.length; posTab++) {
      tab[posTab].className = tab[posTab].className.replace(" active", "");
    }
    tab[tabActualEdit].className += " active";
  }


//Nuevo Plan Estudios
formPlanEstudiosNuevo.onsubmit = function(e) {
  e.preventDefault();
  document.querySelector("#idNuevo").value = 1;
  var strNuevo = document.querySelector('#idNuevo').value;
  var strNombre = document.querySelector('#txtNombreNuevo').value;
  var strNombreCorto = document.querySelector('#txtNombrecortoNuevo').value;
  var strPlantel = document.querySelector('#listPlantelNuevo').value;
  var strNivelEd = document.querySelector('#listNivelEdNuevo').value;
  var strCat = document.querySelector('#listCategoriaNuevo').value;
  var strDuracion = document.querySelector('#txtDuracionNuevo').value;
  var strMattotal = document.querySelector('#txtMatTotalesNuevo').value;
  var strTotalHrs = document.querySelector('#txtTotalHrsNuevo').value;
  var strCalMin = document.querySelector('#txtCalMinNuevo').value;
  var strModalidad = document.querySelector('#listModalidadNuevo').value;
  //var strEstatus = document.querySelector('#listEstatusNuevo').value;
  var strTotalCreditos = document.querySelector('#listTotalCreditosNuevo').value;
  var strPlan = document.querySelector('#listPlanNuevo').value;
  //var strEstatusa = document.querySelector('#listEstatusNuevo').value;
  //var strClaveProf = document.querySelector('#txtClaveProfNuevo').value;
  var strTipoRVOE = document.querySelector('#listTipoRvoeNuevo').value;
  var strRVOE = document.querySelector('#txtRvoeNuevo').value;
  var strVigencia = document.querySelector('#txtVigenciaNuevo').value;
  var strFechaOtor = document.querySelector('#txtFechaOtorgamientoNuevo').value;
  var strFechaEstTermino = document.querySelector('#txtFechaTerminacionNuevo').value;
  var strPErfilIng = document.querySelector('#txtPerfilIngresoNuevo').value;
  var strPerfilEgr = document.querySelector('#txtPerfilEgresoNuevo').value;
  var strCampLab = document.querySelector('#txtCampoLaboralNuevo').value;
  if (strNombre == '' || strNombreCorto == '' || strPlantel == '' || strCampLab == '' || strNivelEd == '' || strCat == '' || strDuracion == '' || strMattotal == '' ||
  strTotalHrs == '' || strCalMin == '' || strModalidad == '' || strTotalCreditos == '' || strPlan == '' ||
  strTipoRVOE == '' || strRVOE == '' || strVigencia == '' || strFechaOtor == '' || strFechaEstTermino == '' || strPErfilIng == '' || strPerfilEgr == '')
  {
    swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
    return false;
  }
  var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
  var ajaxUrl = base_url+'/PlanEstudios/setPlanEstudios';
  var formData = new FormData(formPlanEstudiosNuevo);
  request.open("POST",ajaxUrl,true);
  request.send(formData);
  request.onreadystatechange = function() {
    if(request.readyState == 4 && request.status == 200) {
      var objData = JSON.parse(request.responseText);
      if(objData.estatus)
      {
        $('#ModalFormNuevoPlanEstudios').modal("hide");
        formPlanEstudiosNuevo.reset();	
        swal.fire("Plan de estudios", objData.msg, "success").then((result) =>{
                      $('#dimissModalNuevo').click();
                  });
                  tablePlanEstudios.api().ajax.reload()
        
      }else{
        swal.fire("Error", objData.msg, "error");
      }
    }
    return false;
  }
}

//Funcion para Ver Plan Estudios
function fntVerPlanEstudios(idPlanEstudio){
    var idPlanEstudio = idPlanEstudio;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl  = base_url+'/PlanEstudios/getPlanEstudio/'+idPlanEstudio;
    request.open("GET",ajaxUrl ,true);
	request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData)
            {   
                document.querySelector('#txtNombreVer').value = objData.nombre_carrera;
                document.querySelector('#txtNombrecortoVer').value = objData.nombre_carrera_corto;
                document.querySelector('#listPlantelVer').innerHTML = '<option>'+objData.nombre_plantel+' ('+objData.municipio+')'+'</option>';
                document.querySelector('#listNivelEdVer').innerHTML = '<option selected>'+objData.nombre_nivel_educativo+'</option>';
                document.querySelector('#listCategoriaVer').innerHTML = '<option selected>'+objData.nombre_categoria_carrera+'</option>';
                document.querySelector('#txtDuracionVer').value = objData.duracion_carrera;
                document.querySelector('#txtMatTotalesVer').value = objData.materias_totales;
                document.querySelector('#txtTotalHrsVer').value = objData.total_horas;
                document.querySelector('#txtCalMinVer').value = objData.calificacion_minima;
                document.querySelector('#listModalidadVer').innerHTML = '<option selected>'+objData.nombre_modalidad+'</option>';
                document.querySelector('#listEstatusVer').value = objData.nombre_carrera;
                document.querySelector('#listTotalCreditosVer').value = objData.total_creditos;
                document.querySelector('#listPlanVer').innerHTML = '<option selected>'+objData.nombre_plan+'</option>';
                if(objData.estatus == 1){
                    document.querySelector('#listEstatusVer').innerHTML = '<option selected>Activo</option>';
                }else{
                    document.querySelector('#listEstatusVer').innerHTML = '<option selected>Inactivo</option>';
                }
                document.querySelector('#txtClaveProfVer').value = objData.clave_profesiones;
                document.querySelector('#listTipoRvoeVer').innerHTML = '<option selected>'+objData.tipo_rvoe+'</option>';
                document.querySelector('#txtRvoeVer').value = objData.rvoe;
                document.querySelector('#txtVigenciaVer').value = objData.vigencia_rvoe;
                document.querySelector('#txtFechaOtorgamientoVer').value = objData.fecha_otorgamiento;
                document.querySelector('#txtFechaEstimationTerminoVer').value = objData.fecha_estimada_termino;
                document.querySelector('#txtPerfilIngresoVer').value = objData.perfil_ingreso;
                document.querySelector('#txtPerfilEgresoVer').value = objData.perfil_egreso;
                document.querySelector('#txtCampoLaboralVer').value = objData.campo_laboral;

            }else{
                swal.fire("Error", objData.msg , "error");
            }
        }
    }
}

//Funcion para Ver Plan Estudios
function fntEditPlanEstudios(idPlanEstudio){
    var idPlanEstudio = idPlanEstudio;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl  = base_url+'/PlanEstudios/getPlanEstudioEdit/'+idPlanEstudio;
    request.open("GET",ajaxUrl ,true);
	request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData)
            {   
                document.querySelector("#idEdit").value = objData.id;
                document.querySelector('#txtNombreEdit').value = objData.nombre_carrera;
                document.querySelector('#txtNombrecortoEdit').value = objData.nombre_carrera_corto;
                document.querySelector('#listPlantelEdit').querySelector('option[value="'+objData.id_plantel+'"]').selected = true;
                document.querySelector('#listNivelEdEdit').querySelector('option[value="'+objData.id_nivel_educativo+'"]').selected = true;
                document.querySelector('#listCategoriaEdit').querySelector('option[value="'+objData.id_categoria_carrera+'"]').selected = true;
                document.querySelector('#txtDuracionEdit').value = objData.duracion_carrera;
                document.querySelector('#txtMatTotalesEdit').value = objData.materias_totales;
                document.querySelector('#txtTotalHrsEdit').value = objData.total_horas;
                document.querySelector('#txtCalMinEdit').value = objData.calificacion_minima;
                document.querySelector('#listModalidadEdit').querySelector('option[value="'+objData.id_modalidad+'"]').selected = true;
                document.querySelector('#listEstatusEdit').value = objData.nombre_carrera;
                document.querySelector('#listTotalCreditosEdit').value = objData.total_creditos;
                document.querySelector('#listPlanEdit').querySelector('option[value="'+objData.id_plan+'"]').selected = true;
                document.querySelector('#listEstatusEdit').querySelector('option[value="'+objData.estatus+'"]').selected = true;
                document.querySelector('#txtClaveProfEdit').value = objData.clave_profesiones;
                document.querySelector('#listTipoRvoeEdit').querySelector('option[value="'+objData.tipo_rvoe+'"]').selected = true;
                document.querySelector('#txtRvoeEdit').value = objData.rvoe;
                document.querySelector('#txtVigenciaEdit').value = objData.vigencia_rvoe;
                document.querySelector('#txtFechaOtorgamientoEdit').value = objData.fecha_otorgamiento;
                document.querySelector('#txtFechaTerminacionEdit').value = objData.fecha_estimada_termino;
                document.querySelector('#txtPerfilIngresoEdit').value = objData.perfil_ingreso;
                document.querySelector('#txtPerfilEgresoEdit').value = objData.perfil_egreso;
                document.querySelector('#txtCampoLaboralEdit').value = objData.campo_laboral;

            }else{
                swal.fire("Error", objData.msg , "error");
            }
        }
    }
}
var formEditPlanEstudios = document.querySelector("#formPlanEstudiosEdit");
formEditPlanEstudios.onsubmit = function(e){
        e.preventDefault();
        var strNombre = document.querySelector('#txtNombreEdit').value;
        var strNombreCorto = document.querySelector('#txtNombrecortoEdit').value;
        var strPlantel = document.querySelector('#listPlantelEdit').value;
        var strNivelEd = document.querySelector('#listNivelEdEdit').value;
        var strCat = document.querySelector('#listCategoriaEdit').value;
        var strDuracion = document.querySelector('#txtDuracionEdit').value;
        var strMattotal = document.querySelector('#txtMatTotalesEdit').value;
        var strTotalHrs = document.querySelector('#txtTotalHrsEdit').value;
        var strCalMin = document.querySelector('#txtCalMinEdit').value;
        var strModalidad = document.querySelector('#listModalidadEdit').value;
        var strEstatus = document.querySelector('#listEstatusEdit').value;
        var strTotalCreditos = document.querySelector('#listTotalCreditosEdit').value;
        var strPlan = document.querySelector('#listPlanEdit').value;
        //var strClaveProf = document.querySelector('#txtClaveProfEdit').value;
        var strTipoRVOE = document.querySelector('#listTipoRvoeEdit').value;
        var strRVOE = document.querySelector('#txtRvoeEdit').value;
        var strVigencia = document.querySelector('#txtVigenciaEdit').value;
        var strFechaOtor = document.querySelector('#txtFechaOtorgamientoEdit').value;
        var strFechaEstTermino = document.querySelector('#txtFechaTerminacionEdit').value;
        var strPErfilIng = document.querySelector('#txtPerfilIngresoEdit').value;
        var strPerfilEgr = document.querySelector('#txtPerfilEgresoEdit').value;
        var strCampLab = document.querySelector('#txtCampoLaboralEdit').value;
        
        if (strNombre == '' || strNombreCorto == '' || strPlantel == '' || strCampLab == '' || strNivelEd == '' || strCat == '' || strDuracion == '' || strMattotal == '' ||
            strTotalHrs == '' || strCalMin == '' || strModalidad == '' || strEstatus == '' || strTotalCreditos == '' || strPlan == '' ||
            strTipoRVOE == '' || strRVOE == '' || strVigencia == '' || strFechaOtor == '' || strFechaEstTermino == '' || strPErfilIng == '' || strPerfilEgr == ''){
                swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
                return false;
        }
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/PlanEstudios/setPlanEstudios';
        var formData = new FormData(formEditPlanEstudios);
        request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function() {
                if(request.readyState == 4 && request.status == 200) {
                    var objData = JSON.parse(request.responseText);
                    if(objData.estatus){
                        $('#ModalFormEditPlanEstudios').modal("hide");
                        formEditPlanEstudios.reset();
                        swal.fire("Plan de estudios", objData.msg, "success").then((result) =>{
                            $('#dimissModalEdit').click();
                        });
                        tablePlanEstudios.api().ajax.reload();  
                    }else{
                        swal.fire("Error", "error", "error");
                    }
                }
                return false;
            }
    }


//Funcion para Eliminar Plan de Estudios
function fntDelPlanEstudios(id) {
    swal.fire({
        icon: "question",
        title: "Eliminar plan de estudios?",
        text: "¿Realmente quiere eliminar el plan de estudios?",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33', 
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!"
    }). then((result) => {
        if (result.isConfirmed) 
        {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/PlanEstudios/delPlanEstudio'; 
            var strData = "idPlanEstudio="+id;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    var objData = JSON.parse(request.responseText);
                    if(objData.estatus)
                    {
                        swal.fire("Eliminado!", objData.msg , "success");
                        tablePlanEstudios.api().ajax.reload();

                    } else {
                        swal.fire("Atención!", objData.msg , "error");
                    }
                }
            }
        }
    });
}

//Funcion para Aceptar solo Numeros en un Input
function validarNumeroInput(event){
  if(event.charCode >= 48 && event.charCode <= 57){
      return true;
  }
  return false;
}