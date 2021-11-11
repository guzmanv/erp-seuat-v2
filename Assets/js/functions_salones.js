var tableSalon;
var formNuevoSalon = document.querySelector('#formSalonNuevo');
var formSalonEdit = document.querySelector('#formSalonEdit');

//DataTable
document.addEventListener('DOMContentLoaded', function(){
	tableSalon = $('#tableSalon').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Salones/getSalones",
            "dataSrc":""
        },
        "columns":[
            {"data":"id"},
            {"data":"nombre_salon"},
			{"data":"cantidadmax"},
			{"data":"nombre_periodo"},
			{"data":"nombre_grado"},
			{"data":"nombre_grupo"},
			{"data":"abreviacion_plantel"},
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
$('#tableSalon').DataTable();

//Nuevo salón
formNuevoSalon.onsubmit = function(e){
	e.preventDefault();
	document.querySelector("#idSalonNuevo").value = 1;
	var strNombre = document.querySelector("#txtNombreNuevo").value;
	var intCantidad = document.querySelector("#txtCantidadMax").value;
	var strPeriodo = document.querySelector("#listPeriodo").value;
	var strGrado = document.querySelector("#listGrado").value;
	var strGrupo = document.querySelector("#listGrupo").value;
	var strHoras = document.querySelector("#listHorario").value;
	var strPlantel = document.querySelector("#listPlantel").value;

	if(strNombre == '' || intCantidad == '' || strPeriodo == '' || strGrado == '' || strGrupo == '' || strHoras == '' || strPlantel == '')
	{
		swal.fire("Atención","Atención todos los campos son obligatorios", "warning");
		return false;
	}

	var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	var ajaxUrl = base_url+'/Salones/setSalon';
	var formData = new FormData(formSalonNuevo);
	request.open("POST",ajaxUrl,true);
	request.send(formData);
	request.onreadystatechange = function(){
		if(request.readyState == 4 && request.responseText){
			var objData = JSON.parse(request.responseText);
			if(objData.estatus)
			{
				formSalonNuevo.reset();
				swal.fire("Salón",objData.msg,"success").then((result) =>{
					$("#dimissModalNuevoSalon").click();
				});
				tableSalon.api().ajax.reload();
			}
			else
			{
				swal.fire("Error",objData.msg,"error");
			}
		}

		return false;
	}
}

//Modificar salón
function fntEditSalon(idSalon){
	var idSln = idSalon;
}


//Eliminar salón
function fntDelSalon(idSalon){
	swal.fire({
		icon: "question",
		title: "¿Eliminar salón?",
		text: "¿Realmente desea eliminar el salón?",
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '¡Sí, eliminar!',
		cancelButtonText: "No, cancelar"
	}). then((result) =>{
		if(result.isConfirmed)
		{
			var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			var ajaxUrl = base_url+'/Salones/delSalon';
			var strData = "idSalon="+idSalon;
			request.open("POST",ajaxUrl,true);
			request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			request.send(strData);
			request.onreadystatechange = function(){
				if(request.readyState == 4 && request.status == 200)
				{
					var objData = JSON.parse(request.responseText);
					if(objData.estatus)
					{
						swal.fire("¡Eliminado!", objData.msg, "success");
						tableSalon.api().ajax.reload();
					}
					else
					{
						swal.fire("¡Atención!", objData.msg, "error");
					}
				}
			}
		}
	})
}