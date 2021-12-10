let tableTurnos
const formNuevoTurno = document.querySelector('#formTurnoNuevo')

document.addEventListener('DOMContentLoaded', function(){
	tableTurnos = $('#tableTurnos').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Turnos/getTurnos",
            "dataSrc":""
        },
        "columns":[
			{"data": "id"},
			{"data": "nombre_turno"},
			{"data": "abreviatura"},
			{"data": "hora_entrada"},
            {"data": "hora_salida"},
            {"data": "estatus"},
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
$('#tableTurnos').DataTable();