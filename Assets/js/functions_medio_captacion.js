let tableMedioCaptacion;


document.addEventListener('DOMContentLoaded', function(){
	tableMedioCaptacion = $('#tableMedioCaptacion').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/MedioCaptacion/getMediosCaptacion",
            "dataSrc":""
        },
        "columns":[
			{"data": "numeracion"},
			{"data": "medio_captacion"},
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
$('#tableMedioCaptacion').DataTable();



function fntDelMedioCaptacion(idMed){
	let idMedio = idMed
	
}