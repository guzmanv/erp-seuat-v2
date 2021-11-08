var tableEstudiantes;
//var formModalidad = document.querySelector("#formModalidad");
//var formModalidadEdit = document.querySelector("#formModalidadEdit");

//Funcion para Datatable de Mostrar todas las Modalidades
document.addEventListener('DOMContentLoaded', function(){
	tableEstudiantes = $('#tableEstudiantes').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Estudiantes/getEstudiantes",
            "dataSrc":""
        },
        "columns":[
            {"data":"numeracion"},
            {"data":"nombre_persona"},
            {"data":"apellidos"},
            {"data":"nombre_plantel"},
            {"data":"nombre_carrera"},
            {"data":"grado"},
            {"data":"nombre_salon"},
            {"data":"validacion"},
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
$('#tableEstudiantes').DataTable();


function fntDocumentacionInscripcion(value){
    var idInscripcion = value;
    let urlDocumentacion = base_url+"/Estudiantes/getDocumentacion?idIns="+idInscripcion;
    fetch(urlDocumentacion)
    .then(res => res.json())
    .then((resultDocumentacion) =>{
        var numeracion = 0;
        document.querySelector('#tbDocumentacionIns').innerHTML="";
        resultDocumentacion.forEach(element => {
            numeracion +=1;
            document.querySelector('#tbDocumentacionIns').innerHTML+="<tr><th scope='row'>"+numeracion+"</th><td>"+element.tipo_documento+"</td><td><div class='custom-control custom-switch custom-switch-off-danger custom-switch-on-success'><input type='checkbox' aria-label='Checkbox for following text input'></div></td><td><div class='custom-control custom-switch custom-switch-off-danger custom-switch-on-success'><input type='checkbox' aria-label='Checkbox for following text input'></div></td><td><div class='custom-control custom-switch custom-switch-off-danger custom-switch-on-success'><input type='checkbox' aria-label='Checkbox for following text input'></div></td></tr>";
        });
    })
    .catch(err => {throw err});
}