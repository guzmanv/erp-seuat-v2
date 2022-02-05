document.addEventListener('DOMContentLoaded', function(){
    var tableEstudiantes = $('#tableAlumnos').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/HistorialPagosAlumno/getEstudiantes",
            "dataSrc":""
        },
        "columns":[
            {"data":"numeracion"},
            {"data":"nombre_persona"},
            {"data":"apellidos"},
            {"data":"nombre_plantel"},
            {"data":"nombre_carrera"},
            {"data":"grado_grupo"},
            {"data":"options"}
        ],
        "responsive": true,
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        //"scrollY": '42vh',
        "scrollCollapse": true,
        "bDestroy": true,
        "order": [[ 0, "asc" ]],
        "iDisplayLength": 2
    });
});
$('#tableAlumnos').DataTable();

function seleccionarPersona(value){
    let url = `${base_url}/HistorialPagosAlumno/getDetallesEstudiante/${value}`;
    console.log(url);
    fetch(url)
    .then(res => res.json())
    .then((resultado) =>{
        document.querySelector(".name").textContent = `${resultado.nombre_persona} ${resultado.ap_paterno} ${resultado.ap_materno}`;
        document.querySelector('.img_user').src = `${base_url}/Assets/images/img/user.jpg`;
        document.querySelector(".tel").textContent = resultado.tel_celular;
        document.querySelector('.email').textContent = resultado.email;
        document.querySelector('.direccion').textContent = resultado.direccion;
        document.querySelector('.estatus').innerHTML = (resultado.estatus == 1)?'<span class="badge bg-success">Activo</span>':'<span class="badge bg-danger">Innactivo</span>';
        if(resultado){
            fnMostrarUltimosMovimientos(value);
        }
    }).catch(err =>{throw err});
}


function fnMostrarUltimosMovimientos(id){
    let url = `${base_url}/HistorialPagosAlumno/getUltimosMovimientosAlumno/${id}`;
    fetch(url)
    .then(res => res.json())
    .then((resultado) =>{
        document.querySelector('.ultimos_movimientos').innerHTML = "";
        if(resultado){
            resultado.forEach(element => {
                document.querySelector('.ultimos_movimientos').innerHTML += '<li class="timeline-item ml-4"><strong>Pago con el id '+element.id+'</strong><span class="float-end text-muted text-sm"> Hace 5 min</span><p> Descripcion del ingreso</p></li>'
            });
        }
    }).catch(err => {throw err});
}