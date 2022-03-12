let tableCategoria_servicios;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");


document.addEventListener('DOMContentLoaded', function(){
	tableCategoria_servicios = $('#tableCategoria_servicios').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
			"language": {
				"url": " "+base_url+"/Assets/plugins/Spanish.json"
			},
			"ajax":{
					"url": " "+base_url+"/Categoria_servicios/getCategoria_servicios",
					"dataSrc":""
			},
			"columns":[
					{"data":"id"},
					{"data":"nombre_categoria"},
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
			"order": [[0,"desc"]]
	});

	// Crear
	if(document.querySelector("#formCategoria_servicios")){
		let formCategoria_servicios = document.querySelector("#formCategoria_servicios");
		formCategoria_servicios.onsubmit = function(e) {
			e.preventDefault();

			let intIdCategoria_servicios = document.querySelector('#idCategoria_servicios').value;
			let strNombre_categoria = document.querySelector('#txtNombre_categoria').value;
			let intEstatus = document.querySelector('#listEstatus').value;
			let strFecha_creacion = document.querySelector('#txtFecha_creacion').value;
			let strFecha_actualizacion = document.querySelector('#txtFecha_actualizacion').value;
			let intId_usuario_creacion = document.querySelector('#txtId_usuario_creacion').value;
			let intId_usuario_actualizacion = document.querySelector('#txtId_usuario_actualizacion').value;

			if(strNombre_categoria == '' || intEstatus == '' || strFecha_creacion == '' || intId_usuario_creacion == '' )
			{
					swal.fire("Atención", "Todos los campos son obligatorios." , "warning");
					return false;
			}

			divLoading.style.display = "flex";
			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url+'/Categoria_servicios/setCategoria_servicios';
			let formData = new FormData(formCategoria_servicios);
			request.open("POST",ajaxUrl,true);
			request.send(formData);
			request.onreadystatechange = function() {
					if(request.readyState == 4 && request.status == 200) {
						let objData = JSON.parse(request.responseText);
						if(objData.estatus)
						{
							$('#modalFormCategoria_servicios').modal("hide");
							formCategoria_servicios.reset();
							swal.fire("Categoría de servicios", objData.msg, "success");
							tableCategoria_servicios.api().ajax.reload();
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
	if(document.querySelector("#formCategoria_serviciosup")){
		let formCategoria_serviciosup = document.querySelector("#formCategoria_serviciosup");
			formCategoria_serviciosup.onsubmit = function(e) {
					e.preventDefault();

					let intIdCategoria_servicios = document.querySelector('#idCategoria_serviciosup').value;
					let strNombre_categoria = document.querySelector('#txtNombre_categoriaup').value;
					let intEstatus = document.querySelector('#listEstatusup').value;
					let strFecha_actualizacion = document.querySelector('#txtFecha_actualizacionup').value;
					let intId_usuario_actualizacion = document.querySelector('#txtId_usuario_actualizacionup').value;

					if(strNombre_categoria == '' || intEstatus == '' || intId_usuario_actualizacion == '' )
					{
						swal.fire("Atención", "Atención todos los campos son obligatorios", "warning");
						return false;
					}

			divLoading.style.display = "flex";
			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url+'/Categoria_servicios/setCategoria_servicios_up';
			let formData = new FormData(formCategoria_serviciosup);
			request.open("POST",ajaxUrl,true);
			request.send(formData);

			request.onreadystatechange = function(){
					if(request.readyState == 4 && request.status == 200){

						let objData = JSON.parse(request.responseText);
						if(objData.estatus)
						{
							if(rowTable == ""){
									tableCategoria_servicios.api().ajax.reload();
							}else{
									htmlEstatus = intEstatus == 1 ?
									'<span class="badge badge-dark">Activo</span>' :
									'<span class="badge badge-secondary">Inactivo</span>';
									rowTable.cells[1].textContent = strNombre_categoria;
									rowTable.cells[2].innerHTML = htmlEstatus;
									rowTable = "";
							}

							$('#modalFormCategoria_servicios_editar').modal('hide');
							formCategoria_serviciosup.reset();
							swal.fire("Categoría servicios", objData.msg, "success");

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



function fntEditCategoria_servicios(element,id){
	rowTable = element.parentNode.parentNode.parentNode.parentNode.parentNode;
	//console.log(rowTable);
	let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	let ajaxUrl = base_url+'/Categoria_servicios/getCategoria_servicio/'+id;
	request.open("GET",ajaxUrl,true);
	request.send();

	request.onreadystatechange = function(){
		if(request.readyState == 4 && request.status == 200){

			let objData = JSON.parse(request.responseText);

			if(objData.estatus){
				console.log(objData);
					document.querySelector("#idCategoria_serviciosup").value = objData.data.id;
					document.querySelector("#txtNombre_categoriaup").value = objData.data.nombre_categoria;
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
					$('#modalFormCategoria_servicios_editar').modal('show');

			}else{
					swal.fire("Error", objData.msg , "error");
			}
		}
	}
}



function openModal(){
	rowTable = "";
	$('#modalFormCategoria_servicios').modal({
		backdrop: 'static',
		keyboard: false,
	});

	$('#modalFormCategoria_servicios').modal('show');
}


$(".cerrarModal").click(function(){
	$("#modalFormCategoria_servicios").modal('hide')
});


$(".cerrarModal").click(function(){
	$("#modalFormCategoria_servicios_editar").modal('hide')
});


function fntDelCategoria_servicios(id) {
    swal.fire({
        icon: "question",
        title: "Eliminar Categoría",
        text: "¿Realmente quiere eliminar la categoría seleccionada?",
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
            let ajaxUrl = base_url+'/Categoria_servicios/delCategoria_servicios';
            let strData = "idCategoria_servicios="+id;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.estatus)
                    {
                        swal.fire("Eliminar!", objData.msg , "success");
                        tableCategoria_servicios.api().ajax.reload();
                    } else {
                        swal.fire("Atención!", objData.msg , "error");
                    }
                }
            }
        }
    });
}
