let tableServicios;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

window.addEventListener('load', function(){
    fntUnidadMedida();
    fntCategoriaServicios();
    fntPlanteles();
}, false);


document.addEventListener('DOMContentLoaded', function(){
	tableServicios = $('#tableServicios').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
			"language": {
				"url": " "+base_url+"/Assets/plugins/Spanish.json"
			},
			"ajax":{
					"url": " "+base_url+"/Servicios/getServicios",
					"dataSrc":""
			},
			"columns":[
					{"data":"IdServicios"},
					{"data":"CodigoServicio"},
					{"data":"NombreServicio"},
                    {data:null, "render":
                    function ( data, type, row ) {
                        return "$ " + data.PrecioUnitario + " ";
                        }
                    },
                    {"data":"AplicaEdoCuenta"},
					{"data":"EstatusServicios"},
                    {"data":"Plantel"},
                    {"data":"Municipio"},
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


            // Casilla de verificación enlazar función al evento OnClick
            document.getElementById('chkAplica_edo_cuenta').onclick = function() {
                if(this.checked) {
                    document.querySelector("#chkAplica_edo_cuenta").value = 1;
                    alert(this.value);
                }else{
                    // Retorna falso si no esta checkeado
                }
            };


	// Crear
	if(document.querySelector("#formServicios")){
		let formServicios = document.querySelector("#formServicios");
		formServicios.onsubmit = function(e) {
			e.preventDefault();
			
			let intIdServicio = document.querySelector('#idServicio').value;
            let strCodigo_servicio = document.querySelector('#txtCodigo_servicio').value;
			let strNombre_servicio = document.querySelector('#txtNombre_servicio').value;
            let intPrecio_unitario = document.querySelector('#txtPrecio_unitario').value;
            let intAplica_edo_cuenta = document.querySelector('#chkAplica_edo_cuenta').value;
            let strAnio_fiscal = document.querySelector('#listAnioFiscal').value;
			let intEstatus = document.querySelector('#listEstatus').value;
            let strFecha_creacion = document.querySelector('#txtFecha_creacion').value;
            let strFecha_actualizacion = document.querySelector('#txtFecha_actualizacion').value;
            let intId_usuario_creacion = document.querySelector('#txtId_usuario_creacion').value;
            let intId_usuario_actualizacion = document.querySelector('#txtId_usuario_actualizacion').value;
            let intIdPlantel = document.querySelector('#listIdPlantel').value;
            let intIdCategoria_servicio = document.querySelector('#listIdCategoria_servicio').value;
            let intIdUnidades_medida = document.querySelector('#listIdUnidades_medida').value;
			
			if(strCodigo_servicio == '' || strNombre_servicio == '' || intPrecio_unitario == '' || strAnio_fiscal == '' || intEstatus == '' || strFecha_creacion == '' || intId_usuario_creacion == '' || intIdPlantel == '' || intIdCategoria_servicio == '' || intIdUnidades_medida == '' )
			{
					swal.fire("Atención", "Todos los campos son obligatorios." , "warning");
					return false;
			}
			/*
			let elementsValid = document.getElementsByClassName("valid");
			for (let i = 0; i < elementsValid.length; i++) { 
					if(elementsValid[i].classList.contains('is-invalid')) { 
						swal.fire("Atención", "Por favor verifique los campos en rojo." , "error");
						return false;
					} 
			} */


			divLoading.style.display = "flex";
			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url+'/Servicios/setServicio'; 
			let formData = new FormData(formServicios);
			request.open("POST",ajaxUrl,true);
			request.send(formData);
			request.onreadystatechange = function() {
					if(request.readyState == 4 && request.status == 200) {
						let objData = JSON.parse(request.responseText);
						if(objData.estatus)
						{
							$('#modalFormServicios').modal("hide");
							formServicios.reset();
							swal.fire("Servicios", objData.msg, "success");
							tableServicios.api().ajax.reload();
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



function fntEditPromocion(element,id){
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
					document.querySelector("#idCategoria_serviciosup").value = objData.data.id;
					document.querySelector("#txtNombre_categoriaup").value = objData.data.nombre_categoria;
					//document.querySelector("#txtFecha_actualizacionup").value = document.querySelector('#txtFecha_actualizacionup').value;
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



function fntUnidadMedida(){
	if(document.querySelector('#listIdUnidades_medida')){
			let ajaxUrl = base_url+'/Servicios/getSelectUnidadMedida';
			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			request.open("GET",ajaxUrl,true);
			request.send();
			request.onreadystatechange = function() {
					if(request.readyState == 4 && request.status == 200) {
							document.querySelector('#listIdUnidades_medida').innerHTML = request.responseText;
							//$('#listUnidadMedida').selectpicker('render');
					}
			}
	}
}


function fntCategoriaServicios(){
	if(document.querySelector('#listIdCategoria_servicio')){
			let ajaxUrl = base_url+'/Servicios/getSelectCategoriaServicios';
			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			request.open("GET",ajaxUrl,true);
			request.send();
			request.onreadystatechange = function() {
					if(request.readyState == 4 && request.status == 200) {
							document.querySelector('#listIdCategoria_servicio').innerHTML = request.responseText;
					}
			}
	}
}


function fntPlanteles(){
	if(document.querySelector('#listIdPlantel')){
			let ajaxUrl = base_url+'/Servicios/getSelectPlanteles';
			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			request.open("GET",ajaxUrl,true);
			request.send();
			request.onreadystatechange = function() {
					if(request.readyState == 4 && request.status == 200) {
							document.querySelector('#listIdPlantel').innerHTML = request.responseText;
					}
			}
	}
}



function openModal(){
	rowTable = "";
	$('#modalFormServicios').modal({
		backdrop: 'static',
		keyboard: false,
	});

	$('#modalFormServicios').modal('show');
}


$(".cerrarModal").click(function(){
	$("#modalFormServicios").modal('hide');

});



function fntDelServicio(id) {
	//var idServicio = id;
    swal.fire({
        icon: "question",
        title: "Eliminar Servicio",
        text: "¿Realmente quiere eliminar el servicio seleccionado?",
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
            let ajaxUrl = base_url+'/Servicios/delServicio';
            let strData = "idServicio="+id; 
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.estatus)
                    {
                        swal.fire("Eliminar!", objData.msg , "success");
                        tableServicios.api().ajax.reload(); 
                    } else {
                        swal.fire("Atención!", objData.msg , "error");
                    }
                }
            }
        }
    });
}





