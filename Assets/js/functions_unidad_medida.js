let tableUnidadMedida;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

document.addEventListener('DOMContentLoaded', function(){
	tableUnidadMedida = $('#tableUnidadMedida').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
			"language": {
				"url": " "+base_url+"/Assets/plugins/Spanish.json"
			},
			"ajax":{
					"url": " "+base_url+"/Unidad_medida/getUnidad_medidas",
					"dataSrc":""
			},
			"columns":[
					{"data":"id"},
					{"data":"nombre_unidad_medida"},
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
			"iDisplayLength": 25,
			"order": [[ 0,"desc" ]]
	});

	// Crear
	if(document.querySelector("#formUnidad_medida")){
		let formUnidad_medida = document.querySelector("#formUnidad_medida");
		formUnidad_medida.onsubmit = function(e) {
			e.preventDefault();
			
			let intIdUnidad_medida = document.querySelector('#idUnidad_medida').value;
			let strNombre_unidad_medida = document.querySelector('#txtNombre_unidad_medida').value;
			let intEstatus = document.querySelector('#listEstatus').value;
			//let strFecha_creacion = document.querySelector('#txtFecha_creacion').value;
			let strFecha_actualizacion = document.querySelector('#txtFecha_actualizacion').value;
			let intId_usuario_creacion = document.querySelector('#txtId_usuario_creacion').value;
			let intId_usuario_actualizacion = document.querySelector('#txtId_usuario_actualizacion').value;
			
			if(strNombre_unidad_medida == '' || intEstatus == '' || intId_usuario_creacion == '' )
			{
					swal.fire("Atención", "Todos los campos son obligatorios." , "warning");
					return false;
			}

			divLoading.style.display = "flex";
			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url+'/Unidad_medida/setUnidad_medida'; 
			let formData = new FormData(formUnidad_medida);
			request.open("POST",ajaxUrl,true);
			request.send(formData);
			request.onreadystatechange = function() {
					if(request.readyState == 4 && request.status == 200) {
						let objData = JSON.parse(request.responseText);
						if(objData.estatus)
						{
							$('#modalFormUnidad_medida').modal("hide");
							formUnidad_medida.reset();
							swal.fire("Unidad de medida", objData.msg, "success");
							tableUnidadMedida.api().ajax.reload();
						}else{
							swal.fire("Error", objData.msg, "error");
						}
					}
					divLoading.style.display = "none";
					return false;
			}
		}
	}



	// Actualizar
	if(document.querySelector("#formUnidad_medida_editar")){
		let formUnidad_medida_editar = document.querySelector("#formUnidad_medida_editar");
			formUnidad_medida_editar.onsubmit = function(e) {
					e.preventDefault();

					let intIdUnidad_medida = document.querySelector('#idUnidad_medidaup').value;
					let strNombre_unidad_medida = document.querySelector('#txtNombre_unidad_medidaup').value;
					let intEstatus = document.querySelector('#listEstatusup').value;
					let strFecha_actualizacion = document.querySelector('#txtFecha_actualizacionup').value;
					let intId_usuario_actualizacion = document.querySelector('#txtId_usuario_actualizacionup').value;

					if(strNombre_unidad_medida == '' || intEstatus == '' || intId_usuario_actualizacion == '' )
					{
						swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
						return false;
					}      

			divLoading.style.display = "flex";
			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url+'/Unidad_medida/setUnidad_medida_up';
			let formData = new FormData(formUnidad_medida_editar);
			request.open("POST",ajaxUrl,true);
			request.send(formData);

			request.onreadystatechange = function(){
					if(request.readyState == 4 && request.status == 200){

						let objData = JSON.parse(request.responseText);
						if(objData.estatus)
						{
							if(rowTable == ""){
									tableUnidad_medida.api().ajax.reload();
							}else{
									htmlEstatus = intEstatus == 1 ?
									'<span class="badge badge-dark">Activo</span>' :
									'<span class="badge badge-secondary">Inactivo</span>';
									rowTable.cells[1].textContent = strNombre_unidad_medida;
									rowTable.cells[2].innerHTML = htmlEstatus;
									rowTable = "";
							}
													
							$('#modalFormUnidad_medida_editar').modal('hide');
							formUnidad_medida_editar.reset();	
							swal.fire("Unidad de medida", objData.msg, "success");

						}else{
							swal.fire("Error", objData.msg , "error");
						}
					}
					divLoading.style.display = "none";
					return false;
			}
		}
	}

}, false);




function fntEditUnidad_medida(element,id){
	rowTable = element.parentNode.parentNode.parentNode.parentNode.parentNode;
	//console.log(rowTable);
	let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	let ajaxUrl = base_url+'/Unidad_medida/getUnidad_medida/'+id;
	request.open("GET",ajaxUrl,true);
	request.send();

	request.onreadystatechange = function(){
		if(request.readyState == 4 && request.status == 200){

			let objData = JSON.parse(request.responseText);
			if(objData.estatus){
					document.querySelector("#idUnidad_medidaup").value = objData.data.id;
					document.querySelector("#txtNombre_unidad_medidaup").value = objData.data.nombre_unidad_medida;
					document.querySelector("#txtId_usuario_actualizacionup").value = 1;

					if(objData.data.estatus == 1)
					{
						var optionSelect = '<option value="1" selected class="notBlock">Activo</option>';
					}else{
						var optionSelect = '<option value="2" selected class="notBlock">Inactivo</option>';
					}
					var htmlSelect = `${optionSelect}
											<option value="1">Activo</option>
											<option value="2">Inactivo</option>
										`;
					document.querySelector("#listEstatusup").innerHTML = htmlSelect;
					$('#modalFormUnidad_medida_editar').modal('show');

			}else{
					swal.fire("Error", objData.msg , "error");
			}
		}
	}
}


function openModal(){
	rowTable = "";
	$('#modalFormUnidad_medida').modal({
		backdrop: 'static',
		keyboard: false,
	});

	$('#modalFormUnidad_medida').modal('show');
}


$(".cerrarModal").click(function(){
	$("#modalFormUnidad_medida").modal('hide');
    	$("#modalFormUnidad_medida_editar").modal('hide');

});


function fntDelUnidad_medida(id) {
    swal.fire({
        icon: "question",
        title: "Eliminar unidad de medida",
        text: "¿Realmente quiere eliminar la unidad de medida seleccionada?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#045FB4',
		cancelButtonColor: '#d33', 
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!"
    }). then((result) => {

        if (result.isConfirmed) 
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Unidad_medida/delUnidad_medida';
            let strData = "idUnidad_medida="+id; 
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.estatus)
                    {
                        swal.fire("Eliminar!", objData.msg , "success");
                        tableUnidadMedida.api().ajax.reload(); 
                    } else {
                        swal.fire("Atención!", objData.msg , "error");
                    }
                }
            }
        }
    });
}





