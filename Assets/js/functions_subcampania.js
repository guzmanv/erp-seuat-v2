let tableSubcampania;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");

document.addEventListener('DOMContentLoaded', function(){
	tableSubcampania = $('#tableSubcampania').dataTable({
		"aProcessing":true,
		"aServerSide":true,
		"language":{
			"url": " "+base_url+"/Assets/plugins/Spanish.json"
		},
		"ajax":{
			"url": " "+base_url+"/Subcampania/getSubcampania",
      "dataSrc": ""
		},
		"columns":[
      {"data":"id"},
      {"data":"nombre_sub_campania"},
      {"data":"fecha_inicio"},
      {"data":"fecha_fin"},
      {"data":"nombre_campania"},
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
    "order": [[0,"asc"]]
	});


	//Crear
  if(document.querySelector("#formSubcampania")){
    let formSubcampania = document.querySelector("#formSubcampania");
    formSubcampania.onsubmit = function(e){
      e.preventDefault();

      let intIdSubcampania = document.querySelector("#idSubcampania").value;
			let strNombreSubcampania = document.querySelector('#txtNombreSubcampania').value;
			let strFechaInicio = document.querySelector('#txtFechaInicio').value;
			let strFechaFin = document.querySelector('#txtFechaFin').value;
			let intEstatus = document.querySelector('#listaEstatus').value;
			let strFechaCreacion = document.querySelector('#txtFechaCreacion').value;
			let strFechaActualizacion = document.querySelector('#txtFechaActualizacion').value;
			let intIdUsuarioCreacion = document.querySelector('#txtIdUsuarioCreacion').value;
			let intIdUsuarioActualizacion = document.querySelector('#txtIdUsuarioActualizacion').value;
			let intIdCampania = document.querySelector('#selectIdCampania').value;

      if(strNombreSubcampania == '' || strFechaInicio == '' || strFechaFin == '' || intEstatus == '' || strFechaCreacion == '' || intIdUsuarioCreacion == '' || intIdCampania == ''){

        swal.fire("Atencion", "Todos los campos son obligatorios.", "warning");
        return false;
      }

      divLoading.style.display = "flex";
      let request = (window.XMLHttpRequest) ? new XMLHttpRequest(): new ActiveXObject('Microsoft.XMLHTTP');
      let ajaxUrl = base_url+'/Subcampania/setSubcampania';
      let formData = new FormData(formSubcampania);
			request.open("POST",ajaxUrl,true);
			request.send(formData);
      request.onreadystatechange = function(){
				if(request.readyState == 4 && request.status == 200) {
					let objData = JSON.parse(request.responseText);
          if(objData.estatus){
            $('#modalformSubcampania').modal("hide");
            formSubcampania.reset();
            swal.fire("SubCampañas", objData.msg, "success");
            tableSubcampania.api().ajax.reload();
          }else{
            swal.fire("Error", objData.msg, "error");
          }
        }
        divLoading.style.display = "none";
        return false;
      }//Final de  function onreadystatechange
    }
  }

	//Actualizar
	if(document.querySelector("#formSubcampaniaUp")){
		//Esto es ingnorado
		let formSubcampaniaup = document.querySelector("#formSubcampaniaUp");
		formSubcampaniaup.onsubmit = function(e) {
			e.preventDefault();

			let intIdSubcampania = document.querySelector('#idSubcampaniaUp').value;
			let strNombreSubcampania = document.querySelector('#txtNombreSubcampaniaUp').value;
			let intEstatus = document.querySelector('#listaEstatusUp').value;
			let strFechaActualizacion = document.querySelector('#txtFechaActualizacionUp').value;
			let intIdUsuarioActualizacion = document.querySelector('#txtIdUsuarioActualizacionUp').value;

			if(strNombreSubcampania == '' || intEstatus == '' || intIdUsuarioActualizacion == ''){
				swal.fire("Atencion", "Todos los campos son obligatorios", "warning");
        return false;
			}
			divLoading.style.display = "flex";
	    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	    let ajaxUrl = base_url+'/Subcampania/setSubcampaniaUP';
	    let formData = new FormData(formSubcampaniaup);
	    request.open("POST",ajaxUrl,true);
	    request.send(formData);

			request.onreadystatechange = function(){
				if(request.readyState == 4 && request.status == 200){
					let objData = JSON.parse(request.responseText);
					if(objData.estatus){
						if(rowTable == ""){
							tableSubcampania.api().ajax.reload();
						}else{
							htmlEstatus = intEstatus == 1 ?
	            '<span class="badge badge-dark">Activo</span>' :
	            '<span class="badge badge-secondary">Inactivo</span>'
	            rowTable.cells[1].textContent = strNombreSubcampania;
	            rowTable.cells[5].innerHTML = htmlEstatus;
	            rowTable = "";
						}

						$('#modalformSubcampaniaEdit').modal('hide');
	          formSubcampaniaup.reset();
	          swal.fire("SubCampañas", objData.msg, "success");
					}else{
						swal.fire("Error", objData.msg, "error");
					}
				}
				divLoading.style.display = "none";
	      return false;
			}
		}
	}
}, false);

function ftnEditarSubcampania(element,id){
	rowTable = element.parentNode.parentNode.parentNode.parentNode.parentNode;
	let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	let ajaxUrl = base_url+'/Subcampania/getSubcampanias/'+id;
	request.open("GET", ajaxUrl, true);
	request.send();

	request.onreadystatechange = function(){
		if(request.readyState == 4 && request.status == 200){
			let objData = JSON.parse(request.responseText);
			if(objData.estatus){

				document.querySelector("#idSubcampaniaUp").value = objData.data.id;
				document.querySelector("#txtNombreSubcampaniaUp").value = objData.data.nombre_sub_campania;
				document.querySelector("#txtIdUsuarioActualizacionUp").value = 1;

				if(objData.data.estatus == 1){
					var optionSelect = '<option value="1" selected class="notBlock">Activo</option>';
				}else{
					var optionSelect = '<option value="2" selected class="notBlock">Inactivo</option>';
				}
				var htmlSelect = `${optionSelect}
									<option value="1">Activo</option>
									<option value="2">Inactivo</option>
								 `;
				document.querySelector("#listaEstatusUp").innerHTML = htmlSelect;
				$('#modalformSubcampaniaEdit').modal('show');
			}else{
				swal.fire("Error", objData.msg, "error");
			}
		}
	}
}

function sltSelectCampania(){
	//Declaro el valor a recibir opteniendo el valor del select (Id de la campaña)
	let valueFechaFin = document.getElementById("selectIdCampania").value;
	//Pregunto si el valor esta vacio o no
	if(valueFechaFin == ""){
		swal.fire("Atención", "Seleccione una Campaña", "warning");
	}else{
		//Mando a llamar al controlador SubCampania con el metodo que hacer la consulta a la base de datos, con el valor
		let url = base_url+"/Subcampania/getFechaFinCampania/"+valueFechaFin;
			fetch(url)
				.then(res => res.json())
				.then((resultado) => {
					document.querySelector('#txtFechaFin').value = resultado.fecha_fin;
				})
				.catch(err =>{throw err});
	}
}

function openModal(){
	rowTable = "";
	$('#modalformSubcampania').modal({
		backdrop: 'static',
		keyboard: false,
	});

	$('#modalformSubcampania').modal('show');
}

$(".cerrarModal").click(function(){
	$("#modalformSubcampania").modal('hide')
});

$(".cerrarModal").click(function(){
	$("#modalformSubcampaniaEdit").modal('hide')
});

function ftnDelSubcampania(id){
	swal.fire({
		icon: "question",
		title: "Eliminar Subcampaña",
		text: "¿Realmente quiere eliminar la categoría?",
		type: "warning",
		showCancelButton: true,
		confirmButton: '#045FB4',
		cancelButtonColor: '#d33',
		confirmButtonText: "Si eliminar!",
		cancelButtonText: "No, cancelar!"
	}). then((result)=>{

		if(result.isConfirmed){
			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			let ajaxUrl = base_url+'/Subcampania/delSubcampania';
			let strData = "idSubcampania="+id;
			request.open("POST", ajaxUrl, true);
			request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			request.send(strData);
			request.onreadystatechange = function(){
				if(request.readyState == 4 && request.status == 200){
					let objData = JSON.parse(request.responseText);
					if(objData.estatus){
						swal.fire("Eliminar!", objData.msg , "success");
                        tableSubcampania.api().ajax.reload();
                    } else {
                        swal.fire("Atención!", objData.msg , "error");
                    }
				}
			}
		}
	});
}
