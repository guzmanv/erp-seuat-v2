document.addEventListener('DOMContentLoaded', function(){
    let selectPlantel = document.querySelector('#listPlantelDatatable');
    if(selectPlantel){
        fnPlantelSeleccionadoDatatable(selectPlantel.value);
    }
});

function fnPlantelSeleccionadoDatatable(value){
    let idPlantel = value;
    let url = `${base_url}/PrecargaCuenta/getPlanEstudios/${idPlantel}`;
    let tablePlanEstudios = $('#tablePlanEstudios').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": url,
            "dataSrc":""
        },
        "columns":[
            {"data":"numeracion"},
            {"data":"nombre_plantel"},
            {"data":"nombre_carrera"},
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
	    "iDisplayLength": 5
    });
    $('#tablePlanEstudios').DataTable();
}
function fnServicios(value){
    let idPlantel = value;
    let url = `${base_url}/PrecargaCuenta/getServicios/${idPlantel}`;
    window.scrollTo(0,document.body.scrollHeight);
    fetch(url).then((res) => res.json()).then(resultado =>{
        if(resultado.length > 0){
            let contador = 0;
            document.querySelector('#tableServicios').innerHTML = "";
            resultado.forEach(element => {
                contador += 1;
                document.querySelector('#tableServicios').innerHTML += '<tr><th><input type="checkbox" aria-label="Checkbox for following text input"></th><th scope="row">'+contador+'</th><td>'+element.codigo_servicio+'</td><td>'+element.nombre_servicio+'</td><td>'+formatoMoneda(element.precio_unitario)+'</td><td>'+element.nombre_categoria+'</td><td><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></td></tr>';
            });
        }else{
            document.querySelector('#tableServicios').innerHTML = "<tr><td colspan='7'><div class='alert alert-danger text-center' role='alert'>No hay datos.</div></td></tr>";
            
        }
    }).catch(err => {throw err});
}

//Function para dar formato un numero a Moneda
function formatoMoneda(numero){
    let str = numero.toString().split(".");
    str[0] = str[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return "$"+str.join(".");
}
//Function para convertir un string  a  Formato Base64
function convStrToBase64(str){
    return window.btoa(unescape(encodeURIComponent( str ))); 
}