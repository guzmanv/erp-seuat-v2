let tableSalon;
const formNuevoSalon = document.querySelector('#formSalonNuevo');
let formSalonEdit = document.querySelector('#formSalonEdit');

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
			{"data":"cantidad_max_estudiantes"},
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
formNuevoSalon.addEventListener('submit', (e) => {
	e.preventDefault();
	const datos = new FormData(document.getElementById('formSalonNuevo'))
	let url = `${base_url}/Salones/setSalon`;
	
	fetch(url, {
		method: 'POST',
		body: datos
	})
	.then(response => response.json())
	.then(data => {
		if(data.estatus)
		{
			$('#cancelarModal').click();
			formNuevoSalon.reset();
			swal.fire('Salones', data.msg, 'success');
			tableSalon.api().ajax.reload();
		}
		else
		{
			swal.fire('Error', data.msg, 'error');
		}
	})

	.catch(function (err){
		console.log('Error: ',err);
	})
})


//Modificar salón
// function fntEditSalon(idSalon){
// 	var idSln = idSalon;
// }


//Eliminar salón
// function fntDelSalon(idSalon){
// 	swal.fire({
// 		icon: "question",
// 		title: "¿Eliminar salón?",
// 		text: "¿Realmente desea eliminar el salón?",
// 		showCancelButton: true,
// 		confirmButtonColor: '#3085d6',
// 		cancelButtonColor: '#d33',
// 		confirmButtonText: '¡Sí, eliminar!',
// 		cancelButtonText: "No, cancelar"
// 	}). then((result) =>{
// 		if(result.isConfirmed)
// 		{
// 			var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
// 			var ajaxUrl = base_url+'/Salones/delSalon';
// 			var strData = "idSalon="+idSalon;
// 			request.open("POST",ajaxUrl,true);
// 			request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
// 			request.send(strData);
// 			request.onreadystatechange = function(){
// 				if(request.readyState == 4 && request.status == 200)
// 				{
// 					var objData = JSON.parse(request.responseText);
// 					if(objData.estatus)
// 					{
// 						swal.fire("¡Eliminado!", objData.msg, "success");
// 						tableSalon.api().ajax.reload();
// 					}
// 					else
// 					{
// 						swal.fire("¡Atención!", objData.msg, "error");
// 					}
// 				}
// 			}
// 		}
// 	})
// }