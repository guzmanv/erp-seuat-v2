<?php

class AgendaProspecto extends Controllers{

  /*
  *   !!
  *     Comentarios para furas referencias durante la codificacion
  *     de esta clase:
  *     !! TEXTO !! Significa que es importante leerlo y que tienes que
  *     al finalizar el trabajo (Cuando la clase ya funcione y no se
  *     tenga que hacer ningun cambio mas)
  *     -- TEXTO -- Signidica que Hay que revisar este metodo por que
  *     algo falla
  *     ** Texto ** Anotaciones de Adulfo para si mismo
  *   !!
  */

  public function __construct(){
    parent::__construct();
    session_start();
    if(empty($_SESSION['login'])){
      header('Location: '.base_url().'/login');
      die();
    }
  }

  public function AgendaProspecto(){
    $data['page_tag'] = "Agenda Prospectos";
    $data['page_title'] = "Agenda Prospecto";
    $data['page_name'] = "agendaprospecto";
    $data['page_functions_js'] = "functionsAgendaProspecto.js";
    $this->views->getView($this,"AgendaProspecto",$data);
  }

  // !! Funcion para llenar la tabla principal de la vista !!
  public function getAgendaProspectos(){

    $arrData = $this->model->selectAgendaProspectos();

    for($i = 0; $i < count($arrData); $i++){

      $arrData[$i]['id_guardado'] = $arrData[$i]['id'];
      $arrData[$i]['id'] = $i+1;

      if($arrData[$i]['lectura'] == 2) {


        $arrData[$i]['lectura'] = '
                                   <a class="cerrarModal btnAgendarProspecto" onClick="ftnAgendarProspecto(this,'.$arrData[$i]['id_guardado'].')" title="'.$arrData[$i]['asunto'].'">
                                     <span class="badge badge-success">
                                       Atendido
                                     </span>
                                   </a>
                                  ';

      }else{

        $arrData[$i]['lectura'] = '
                                   <a class="cerrarModal btnAgendarProspecto"   onClick="ftnAgendarProspecto(this,'.$arrData[$i]['id_guardado'].')" title="'.$arrData[$i]['asunto'].'">
                                     <span class="badge badge-danger">
                                      Pendiente
                                     </span>
                                   </a>
                                  ';
      }
    }

    echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
    die();

  }

  public function getAgendaProspecto($id_guardado){

    $intIdAgenda_guardado = intval(strClean($id_guardado));

    if ($intIdAgenda_guardado > 0) {

      $arrData = $this->model->selectAgendaProspecto($intIdAgenda_guardado);

      if(empty($arrData)){

        $arrResponse = array('estatus' => false, 'msg' => 'Datos no encontrados.');

      }else{

        $arrData['info'] = '<b>HABLAR A: </b>'.$arrData['nombre_persona'].' '.$arrData['ap_paterno'].' '.$arrData['ap_materno'].'<br>
                        <b>EL DÍA: </b>'.$arrData['fecha_programada'].'<br>
                        <b>A LAS: </b>'.$arrData['hora_programada'].'<b> HORAS</b> <br>
                        <b>AL TELEFONO </b>'.$arrData['tel_celular'].'<br>
                        <b>O AL </b>'.$arrData['tel_fijo'];
        $arrResponse = array('estatus' => true, 'data' => $arrData);

      }

      echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

    }

    die();
  }

  public function setLecturaProspecto(){

    if($_POST){
      if(empty($_POST['idAgendaLtrUp']) || empty($_POST['txtLectura'])){
          $arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
      }else{
        $intIdAgenda = intval($_POST['idAgendaLtrUp']);
        $intLectura = intvaL($_POST['txtLectura']);

        if($intIdAgenda <> 0) {

          $request = $this->model->lecturaUpdate($intIdAgenda, $intLectura);
          $option = 1;

        }
        if($request > 0){
          if($option == 1){
            $arrResponse = array('estatus' => true, 'msg' => 'Datos actualizados correctamente.');
          }
        }else{
          $arrResponse = array("estatus" => false, "msg" => 'No es posible actualizar los datos, probablemente existe un registro con el mismo nombre o presenta algún problema con la red.');
        }
      }

      echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

    }

    die();

  }

  public function getNombreUsuarioCreacion($id){

    $intIdUsuarioCreacion = intval(strClean($id));

    if($intIdUsuarioCreacion > 0){

      $arrData = $this->model->selectNombreUsuairoCreacion($intIdUsuarioCreacion);

      if(empty($arrData)){

        $arrResponse = array('estatus' => false, 'msg' => 'Datos no encontrados.');

      }else{

        $arrResponse = array('estatus' => true, 'data' => $arrData);

      }

      echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

    }

    die();

  }


}

?>
