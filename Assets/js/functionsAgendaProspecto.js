let tableAgendaProspecto;
let rowTable;
let divLoading = document.querySelector("#divLoading");

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
      {"data":"nombre_persona"},
      {"data":"ap_paterno"},
      {"data":"ap_materno"},
      {"data":"fecha_programada"},
      {"data":"hora_programada"},
      {"data":"tel_celular"},
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
    "order": [[0,"desc"]]
  });

  let validar = base_url+"/AgendaProspecto/t_agendaIsNull";
  fetch(validar)
    .then(res => res.json())
    .then((resultado) => {
      if(resultado.estatus){

        let insert = base_url+"/AgendaProspecto/setAgendaProspectos";
        fetch(insert)
        .then(res => res.json())
        .then((insertado) => {
          swal.fire("Nuevos datos Insertados", insertado.msg, "success");
          tableAgendaProspecto.api().ajax.reload();
        })
        .catch(err => {throw err});

      }else{

        let nvsRegistros = base_url+"/AgendaProspecto/nuevosRegistros";
        fetch(nvsRegistros)
          .then(res => res.json())
          .then((nvsRs) =>{
            if(nvsRs.estatus){
              console.log(nvsRs.msg);
            }else{
              console.log(nvsRs.estatus);
              // swal.fire("Nuevos datos Insertados", nvsRs.msg, "success");

              let edos = base_url+"/AgendaProspecto/getEstadosUp";
              fetch(edos)
                .then(res => res.json())
                .then((edoUp) =>{
                  console.log(edoUp);
                  tableAgendaProspecto.api().ajax.reload();
                })
                .catch(err => {throw err});
            }
          })
          .catch(err => {throw err});

      }
    })
    .catch(err => {throw err});


    console.log("Ok continuemos");
});
