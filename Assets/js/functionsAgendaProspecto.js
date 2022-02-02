let tableAgendaProspecto;
let rowTable;
// let divLoading = document.querySelector("#divLoading");

document.addEventListener('DOMContentLoaded', function(){

  tableAgendaProspecto = $('#tableAgendaProspecto').dataTable({
    "aProcessing":true,
    "aServerSide":true,
    "language":{
      "url": " "+base_url+"/Assets/plugins/Spanish.json"
    },
    "ajax":{
      "url": " "+base_url+"/AgendaProspecto/getAgendaProspectos",
      "dataSrc": ""
    },
    "columns":[
      {"data":"id"},
      {"data":"fecha_programada"},
      {"data":"hora_programada"},
      {"data":"asunto"},
      {"data":"lectura"}
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

    if(document.querySelector("#formAgendaProspectoSeguimiento")){

      let formAgendaProspectoSeguimiento = document.querySelector("#formAgendaProspectoSeguimiento");
      formAgendaProspectoSeguimiento.onsubmit = function(e){
        e.preventDefault();

        let intIdLtrUp = document.querySelector('#idAgendaLtrUp').value;
        let intLectura = document.querySelector("#txtLectura").value;

        // divLoading.style.display = "flex";
  			let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'/AgendaProspecto/setLecturaProspecto/';
        let formData = new FormData(formAgendaProspectoSeguimiento);
  			request.open("POST",ajaxUrl,true);
  			request.send(formData);

        request.onreadystatechange = function(){

          if(request.readyState == 4 && request.status == 200){

            let objData = JSON.parse(request.responseText);

						if(objData.estatus){
              swal.fire("Atendido", objData.msg, "success");
              $("#modalTableAgendaProspectoSeguimiento").modal('hide')
              tableAgendaProspecto.api().ajax.reload();
            }else{
              console.log("No");
              swal.fire("Algo Salio mal", objData.msg, "success");
            }

          }

        }

      }


    }

}, false);

function ftnAgendarProspecto(element, id){

  rowTable = element.parentNode.parentNode.parentNode.parentNode.parentNode;
  let ajaxUrl = base_url+'/AgendaProspecto/getAgendaProspecto/'+id;

  fetch(ajaxUrl)
    .then(res => res.json())
    .then((resultado) => {

      let urlPersona = `${base_url}/AgendaProspecto/getNombreUsuarioCreacion/${resultado.data.id_usuario_atendio}`
      fetch(urlPersona)
        .then(res => res.json())
        .then((data) => {

          var lblNombre = data.data.nombre_persona+" "+data.data.ap_paterno+" "+data.data.ap_materno;
          document.querySelector('#nombre').innerHTML = lblNombre;
          
        })
        .catch(err => {throw err})


      document.querySelector('#asunto').innerHTML = resultado.data.asunto;
      document.querySelector('#txtInformacion').innerHTML = resultado.data.info;
      document.querySelector('#lblMsgRecordatorio').innerHTML = resultado.data.detalle;
      document.querySelector('#fechaRegistro').innerHTML = resultado.data.fecha_registro;
      document.querySelector('#idAgendaLtrUp').value = resultado.data.id;
      document.querySelector('#txtLectura').value = 2;

      var spnlectura = ``;

      if(resultado.data.lectura == '1'){
        spnlectura = `<span class="grey-text valign-wrapper">
                        <i class="fas fa-briefcase"></i> Pendiente de Atender:
                        <button id="btnActionForm" type="submit" class="btn btn-primary btn-inline">
                          <i class="fas fa-thumbs-up"></i> Marcar Como Atendido
                        </button>
                      </span>`;
      }else{
        spnlectura = `<span class="green-text valign-wrapper">
                        <i class="far fa-smile icono-verde"></i> Felicidades, Este prospecto se encuetra
                        <span class="badge badge-success">
                          Atendido
                        </span>
                      </span>`;

      }
      document.querySelector('#lectura').innerHTML = spnlectura;
    })
    .catch();


    $('#modalTableAgendaProspectoSeguimiento').modal('show');

}

$(".cerrarModal").click(function(){
	$("#modalTableAgendaProspectoSeguimiento").modal('hide')
});
