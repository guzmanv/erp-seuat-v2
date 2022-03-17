let tablePromocion;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

window.addEventListener('load', function(){
    	fntCampanias();
	fntServicios();
	$('.select2').select2()
}, false);


document.addEventListener('DOMContentLoaded', function(){
	tablePromocion = $('#tablePromocion').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
			"language": {
				"url": " "+base_url+"/Assets/plugins/Spanish.json"
			},
			"ajax":{
					"url": " "+base_url+"/Promocion/getPromociones",
					"dataSrc":""
			},
			"columns":[
					{"data":"IdPromocion"},
					{"data":"NombrePromocion"},
					{"data":"NombreServicio"},
                    {data:null, "render":
                    function ( data, type, row ) {
                        return data.PorcentajeDescuento + " " + "%";
                        }
                    },
					{"data":"EstatusPromocion"},
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
	if(document.querySelector("#formPromocion")){
		let formPromocion = document.querySelector("#formPromocion");
		formPromocion.onsubmit = function(e) {
			e.preventDefault();
			
			let intIdPromocion = document.querySelector('#idPromocion').value;
			let strNombre_promocion = document.querySelector('#txtNombre_promocion').value;
            let strDescripcion = document.querySelector('#txtDescripcion').value;
			let intEstatus = document.querySelector('#listEstatus').value;
            let strPorcentaje_descuento = document.querySelector('#txtPorcentaje_descuento').value;
            let strFecha_inicio = document.querySelector('#txtFecha_inicio').value;
            let strFecha_fin = document.querySelector('#txtFecha_fin').value;
			let strFecha_creacion = document.querySelector('#txtFecha_creacion').value;
			let strFecha_actualizacion = document.querySelector('#txtFecha_actualizacion').value;
			let intId_usuario_creacion = document.querySelector('#txtId_usuario_creacion').value;
			let intId_usuario_actualizacion = document.querySelector('#txtId_usuario_actualizacion').value;
            let intId_subcampania = document.querySelector('#listSubcampania').value;
			let intId_servicio = document.querySelector('#listServicios');
			
			if(strNombre_promocion == '' || intEstatus == '' || strPorcentaje_descuento == '' || strFecha_inicio == '' || strFecha_fin == '' || intId_usuario_creacion == '' || intId_subcampania == '' || intId_servicio == '' )
			{
					swal.fire("Atención", "Todos los campos son obligatorios." , "warning");
					return false;
			}
			
			divLoading.style.display = "flex";
			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url+'/Promocion/setPromocion'; 
			let formData = new FormData(formPromocion);
			request.open("POST",ajaxUrl,true);
			request.send(formData);
			request.onreadystatechange = function() {
					if(request.readyState == 4 && request.status == 200) {
						let objData = JSON.parse(request.responseText);
						if(objData.estatus)
						{
							$('#modalFormPromocion').modal("hide");
							formPromocion.reset();
							swal.fire("Promociones", objData.msg, "success");
							tablePromocion.api().ajax.reload();
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


function fntServicios(){
	if(document.querySelector('#listServicios')){
			let ajaxUrl = base_url+'/Promocion/getSelectServicios';
			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			request.open("GET",ajaxUrl,true);
			request.send();
			request.onreadystatechange = function() {
					if(request.readyState == 4 && request.status == 200) {
							document.querySelector('#listServicios').innerHTML = request.responseText;
							//$('#listServicios').selectpicker('render');
					}
			}
	}
}


function fntCampanias(){
	if(document.querySelector('#listCampania')){
			let ajaxUrl = base_url+'/Promocion/getSelectCampanias';
			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			request.open("GET",ajaxUrl,true);
			request.send();
			request.onreadystatechange = function() {
					if(request.readyState == 4 && request.status == 200) {
							document.querySelector('#listCampania').innerHTML = request.responseText;
					}
			}
	}
}



function fntSelectSubcampanias(idCampania){
	if(document.querySelector('#listSubcampania')){
		let ajaxUrl = base_url+'/Promocion/getSelectSubcampania/'+idCampania;
		let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		request.open("GET",ajaxUrl,true);
		request.send();
		request.onreadystatechange = function() {
				if(request.readyState == 4 && request.status == 200) {
						document.querySelector('#listSubcampania').innerHTML = request.responseText;
				}
		}
	}
}


function openModal(){
	rowTable = "";
	$('#modalFormPromocion').modal({
		backdrop: 'static',
		keyboard: false,
	});

	$('#modalFormPromocion').modal('show');
}


$(".cerrarModal").click(function(){
	$("#modalFormPromocion").modal('hide');
	$("#modalFormPromocion_editar").modal('hide');
});



function fntDelPromocion(id) {
	var idPromocion = id;
    swal.fire({
        icon: "question",
        title: "Eliminar Promoción",
        text: "¿Realmente quiere eliminar la promoción seleccionada?",
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
            let ajaxUrl = base_url+'/Promocion/delPromocion';
            let strData = "idPromocion="+id; 
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.estatus)
                    {
                        swal.fire("Eliminar!", objData.msg , "success");
                        tablePromocion.api().ajax.reload(); 
                    } else {
                        swal.fire("Atención!", objData.msg , "error");
                    }
                }
            }
        }
    });
}




