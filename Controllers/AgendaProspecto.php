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

  public function t_agendaIsNull(){
    $arrData = $this->model->selectAgenda();
    if(empty($arrData)){
      $arrResponse = array('estatus' => true, 'msg' => 'la El registro esta vacio');
    }else{
      $arrResponse = array('estatus' => false, 'msg' => 'Se encontraron datos en el registro');
    }
    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
    die();
  }

  public function nuevosRegistros(){
    $arrData = $this->model->selectRegistros();
    if(empty($arrData)){
      $arrResponse = array('estatus' => false, 'msg' => 'El Registro esta vacio');
    }else{
      $arrResponse = array('estatus' => true, 'msg' => 'Se encontraron nuevos datos en el registro');
    }
    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
    die();
  }

  // !! Funcion para llenar la tabla principal de la vista !!
  public function getAgendaProspectos(){

    $arrData = $this->model->selectAgendaProspectos();
    for($i = 0; $i < count($arrData); $i++){
      if($arrData[$i]['estatus'] == 1) {
        $arrData[$i]['estatus'] = '<span class="badge badge-success">Por llamar</span>';
      }else if($arrData[$i]['estatus'] == 2){
        $arrData[$i]['estatus'] = '<span class="badge badge-warning">Llamar Hoy</span>';
      }else{
        $arrData[$i]['estatus'] = '<span class="badge badge-danger">Tarde</span>';
      }
      $arrData[$i]['options'] = '
                                  <div class="text-center">
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-layer-group"></i> &nbsp; Acciones
                                      </button>
                                      <div class="dropdown-menu">
                                        <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal BTN_HEY_ESTO_SE_CAMBIA" onClick="FTN_HEY_ESTO_SE_CAMBIA(this,'.$arrData[$i]['id'].')" title="HEY_ESTO_SE_CAMBIA"> &nbsp;&nbsp;
                                          <i class="fas fa-pencil-alt"></i> &nbsp; Agendar
                                        </button>
                                      <div class="dropdown-divider"></div>
                                      <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal BTN_HEY_ESTO_SE_CAMBIA" onClick="FTN_HEY_ESTO_SE_CAMBIA('.$arrData[$i]['id'].')" title="HEY_ESTO_SE_CAMBIA"> &nbsp;&nbsp;
                                        <i class="far fa-calendar-alt"></i> &nbsp;  Seguimiento
                                      </button>
                                      <div class="dropdown-divider"></div>
                                      <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal BTN_HEY_ESTO_SE_CAMBIA" onClick="FTN_HEY_ESTO_SE_CAMBIA('.$arrData[$i]['id'].')" title="HEY_ESTO_SE_CAMBIA"> &nbsp;&nbsp;
                                        <i class="fas fa-user-times"></i> &nbsp; No Interesado
                                      </button>
                                      </div>
                                    </div>
                                  </div>
                                ';
    }
    echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
    die();

  }

  public function getEstadosUp(){
    $arrResponse =  $this->model->updateEstados();
    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
    die();
  }

  public function setAgendaProspectos(){
    $insertAgendaProspecto = $this->model->insertAgendaProspecto();
    // echo json_encode($insertAgendaProspecto,JSON_UNESCAPED_UNICODE);
    if($insertAgendaProspecto > 0){
      $arrResponse = array('estatus' => true, 'msg' => 'Tabla Actualizada');
    }else{
      $arrResponse = array("estatus" => false, "msg" => 'No es posible la tabla, probablemente existan registros con el mismo nombre o presenta algún problema con la red.');
    }
    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
    die();
  }


}

?>
