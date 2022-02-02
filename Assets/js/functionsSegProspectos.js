let tableProspectos
let tableSegProspectoIndividual
const modalAgendarProspectoSeguimiento = document.querySelector("#ModalAgendarProspectoSeguimiento")

document.addEventListener('DOMContentLoaded', function(){
	tableTurnos = $('#tableSeguimientoProspecto').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Seguimiento/getProspectos",
            "dataSrc":""
        },
        "columns":[
			{"data": "numeracion"},
            {"data": "nombre_completo"},
            {"data": "alias"},
            {"data": "tel_celular"},
            {"data": "nombre_plantel"},
            {"data": "nombre_carrera"},
            {"data": "medio_captacion"},
            {"data": "options"}
        ],
        "responsive": true,
	    "paging": true,
	    "lengthChange": true,
	    "searching": true,
	    "ordering": false,
	    "info": true,
	    "autoWidth": false,
	    "scrollY": '42vh',
	    "scrollCollapse": true,
	    "bDestroy": true,
	    "order": [[ 0, "asc" ]],
	    "iDisplayLength": 10
    });
});

$('#tableSeguimientoProspecto').DataTable();

function ftnAgendar(id){
	var idAgendar = id;
	document.querySelector("#idPersona").value = idAgendar;
}

modalAgendarProspectoSeguimiento.addEventListener('submit', (e) =>{

	e.preventDefault()
	const agendatLlamada = new FormData(document.getElementById('formAgendar'))
	let url = `${base_url}/Seguimiento/setProgramarAgenda`;

	fetch(url, {
		method: 'POST',
		body: agendatLlamada
	})
		.then(res => res.json())
		.then((data) => {


			if(data.estatus){

				$('#cerrarModalAgendaProspectoSeguimiento').click()
				formAgendar.reset()
				swal.fire("Agendado", data.msg, "success")

			}else{

				swal.fire("Error", data.request , "error")

			}

		})
		.catch(err => {throw err})

})

function fnEditarDatosProspecto(idPer){
	let idPersona = idPer
	let = `${base_url}/Seguimiento/getProspecto/${idPersona}`
	let txtNombreEdit = document.querySelector('#txtNombreEdit')
	let txtApellidoPEdit = document.querySelector('#txtApellidoPatEdit')
	let txtApellidoMEdit = document.querySelector('#txtApellidoMatEdit')
	let txtTelCelular = document.querySelector('#txtTelefonoCelEdit')
	let txtCorreo = document.querySelector('#txtEmail')
	let slctNivelInt = document.querySelector('#slctNivelEstudiosEdit')
	let slctPlntInt = document.querySelector('#slctPlantelEdit')
	let slctCarrInt = document.querySelector('#slctCarreraEdit')
}

function fnSeguimientoInvidual(){
	let respuestas = document.querySelector('#respuestasRapidas1')
	let respuestas2 = document.querySelector('#respuestasRapidas2')
	let url = `${base_url}/Seguimiento/getRespuestasRapidas`
	fetch(url)
		.then(response => response.json())
		.then(data => {
			console.log(data)
			for (let i = 0; i < data.length; i++) {
				if(i<10)
				{
					respuestas.innerHTML += data[i]['respuesta_rapida']
				}
				if(i>=10)
				{
					respuestas2.innerHTML += data[i]['respuesta_rapida']
				}
				
			}
		})
}

function fnDarSeguimiento(idPer){
	let idPersona = idPer
	let url = `${base_url}/Seguimiento/getPersonaSeguimiento/${idPersona}`
	let id = document.querySelector('#idPersonaSeg')	
	let lblNombre = document.querySelector('#lblNombre')
	let lblApellidos = document.querySelector('#lblApellidos')
	let lblTelefono = document.querySelector('#lblTel_celular')
	let lblEmail = document.querySelector('#lblEmail')
	let lblEstado = document.querySelector('#lblEstado')
	let lblMunicipio = document.querySelector('#lblMunicipio')
	let lblMedioPublicitario = document.querySelector('#lblMedioPublicitario')
	let lblNombreComisionista = document.querySelector('#lblNombreComisionista')
	let lblFecha = document.querySelector('#lblFecha')
	let lblNivelEducativo = document.querySelector('#lblNivelEducativo')
	let lblCarreraInteres = document.querySelector('#lblCarreraInteres')

	fetch(url)
		.then(response => response.json())
		.then(data => {
			if(data.response.estatus)
			{
			console.log(data)
			id.value = data.datos.id
			lblNombre.textContent = data.datos.nombre_persona
			lblApellidos.textContent = data.datos.apellidos
			lblTelefono.textContent = data.datos.tel_celular
			lblEmail.textContent = data.datos.email 
			lblMunicipio.textContent = data.datos.municipio
			lblEstado.textContent = data.datos.estado 
			lblMedioPublicitario.textContent = data.datos.medio_captacion
			lblNombreComisionista.textContent = data.datos.nombre_usuario_creacion
			lblFecha.textContent = data.datos.fecha_creacion
			lblNivelEducativo.textContent = data.datos.nombre_nivel_educativo
			lblCarreraInteres.textContent = data.datos.nombre_carrera

			tableSegProspectoIndividual = $('#tableSegProspectoIndividual').dataTable( {
				"aProcessing":true,
				"aServerSide":true,
				"language": {
					"url": " "+base_url+"/Assets/plugins/Spanish.json"
				},
				"ajax":{
					"url": " "+base_url+"/Seguimiento/getPersonaSeguimiento/"+idPersona,
					"dataSrc":"seguimiento"
				},
				"columns":[
					{"data": "fecha"},
					{"data": "respuesta_rapida"},
					{"data": "comentario"},
					{"data": "nombre_usuario_atendio"}
				],
				"responsive": true,
				"paging": false,
				"lengthChange": true,
				"searching": false,
				"ordering": false,
				"info": false,
				"autoWidth": false,
				//"scrollY": '42vh',
				"scrollCollapse": false,
				"bDestroy": true,
				"order": [[ 0, "asc" ]],
				"iDisplayLength": 10
			});

			$('#tableSegProspectoIndividual').DataTable();
			}
		})

		.catch(err => console.log(err))
}
