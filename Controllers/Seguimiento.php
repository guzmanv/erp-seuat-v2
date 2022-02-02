<?php

class Seguimiento extends Controllers{

    public function __construct()
    {
        parent::__construct();
    }

    public function seguimiento(){
        $data['page_tag'] = "Seguimiento de prospectos";
        $data['page_title'] = "Seguimiento de prospección";
        $data['page_name'] = "Seguimiento de prospectos";
        $this->views->getView($this,'seguimiento',$data);
    }

    public function agenda(){
        $data['page_tag'] = "Agenda de seguimiento";
        $data['page_name'] = "Agenda de seguimiento";
        $this->views->getView($this,'AgendaProspecto',$data);
    }

    public function persona(){
        $data['page_id'] = 9;
        $data['page_tag'] = "Persona";
        $data['page_title'] = "Personas";
        $data['page_content'] = "";
        $data['page_functions_js'] = "functions_persona.js";
        $data['estados'] = $this->model->selectEstados();
        $data['categoria_persona'] = $this->model->selectCategoriasPersona();
        $data['grados_estudios'] = $this->model->selectGradosEstudios();
        $data['planteles'] = $this->model->selectPlanteles();
        $data['medios_captacion'] = $this->model->selectMediosCaptacion();
        $this->views->getView($this,"persona",$data);
    }

    public function seguimiento_prospectos(){
        $data['page_tag'] = "Seguimiento de prospección";
        $data['page_title'] = "Seguimiento de prospección";
        $data['page_functions_js'] = "functionsSegProspectos.js";
        $this->views->getView($this,'seguimiento_prospectos',$data);
    }

    public function getProspectos(){
        $arrData = $this->model->selectProspectos();
        for($i=0; $i<count($arrData); $i++){
            $arrData[$i]['numeracion'] = $i + 1;
            if($arrData[$i]['medio_captacion'] == "Saloneo")
            {
                $arrData[$i]['medio_captacion'] = '<span class="badge badge-primary" style="background-color: pu">Saloneo</span>';
            }
            if($arrData[$i]['nombre_categoria'] == 'Prospecto')
            {
                $arrData[$i]['nombre_completo'] = $arrData[$i]['nombre_completo'].' <span class="badge badge-success">'. $arrData[$i]['nombre_categoria'] .'</span>';
                $arrData[$i]['options'] = '<div class="text-center">
                <div class="btn-group">
                    <button type="" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-layer-group"></i> &nbsp; Acciones
                    </button>
                    <div class="dropdown-menu">
                        <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditSalon" data-toggle="modal" data-target="#ModalAgendarProspectoSeguimiento" onClick="ftnAgendar('. $arrData[$i]['id'] .')" title="Agendar"> &nbsp;&nbsp; <i class="fas fa-calendar-alt"></i> &nbsp; Agendar</button>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelSalon" data-toggle="modal" data-target="#ModalEditDatosProspectoSeguimiento" title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>
                        <!--<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelSalon" data-toggle="modal" data-target="#ModalEgresadoSeguimiento" title="Egresado"> &nbsp;&nbsp; <i class="fas fa-user-graduate"></i> &nbsp; Egresado</button> -->
                        <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelSalon" onClick="fnDarSeguimiento('. $arrData[$i]['id'] .')" data-toggle="modal" data-target="#ModalSeguimiento" title="Seguimiento"> &nbsp;&nbsp; <i class="far fa-arrow-alt-circle-right"></i> &nbsp; Seguimiento</button>
                    </div>
                </div>
            </div>';
            }
            else if($arrData[$i]['nombre_categoria'] == 'Egresado'){
                $arrData[$i]['nombre_completo'] = $arrData[$i]['nombre_completo'].' <span class="badge badge-primary">'. $arrData[$i]['nombre_categoria'] .'</span>';
                $arrData[$i]['options'] =
                '<div class="text-center">
                <div class="btn-group">
                    <button type="" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-layer-group"></i> &nbsp; Acciones
                    </button>
                    <div class="dropdown-menu">
                        <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditSalon" data-toggle="modal" data-target="#ModalAgendarProspectoSeguimiento" onClick="ftnAgendar('. $arrData[$i]['id'] .')" title="Editar"> &nbsp;&nbsp; <i class="fas fa-calendar-alt"></i> &nbsp; Agendar</button>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelSalon" data-toggle="modal" data-target="#ModalEditDatosProspectoSeguimiento" title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>
                        <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelSalon" data-toggle="modal" data-target="#ModalEgresadoSeguimiento" title="Egresado"> &nbsp;&nbsp; <i class="fas fa-user-graduate"></i> &nbsp; Egresado</button>
                        <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelSalon" data-toggle="modal" data-target="#ModalSeguimiento" title="Seguimiento"> &nbsp;&nbsp; <i class="far fa-arrow-alt-circle-right"></i> &nbsp; Seguimiento</button>
                    </div>
                </div>
            </div>';
            }
        }
        echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
    }
    public function setProgramarAgenda(){
        if($_POST){
        if(empty($_POST['txtFechaProg']) || empty($_POST['txtHoraProg']) || empty($_POST['idUsuarioAtendidoAgenda']) || empty($_POST['txtFechaRegistro'])){
            $arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
        }else{
            $intIdPersona = intval($_POST['idPersona']);
            $intIdUsuarioAtendio = intval($_POST['idUsuarioAtendidoAgenda']);
            $strFechaProgramada = strClean($_POST['txtFechaProg']);
            $strFechaRegistro= strClean($_POST['txtFechaRegistro']);
            $strHoraProgramada = strClean($_POST['txtHoraProg']);
            $strAsuntoLlamada = strClean($_POST['txtAsunto']);
            $strDetalleLlamada = strClean($_POST['txtComentario']);
            if($intIdPersona <> 0){
            $requestAgendarProspecto = $this->model->insertAgendaProspecto($intIdPersona,
                                                                            $intIdUsuarioAtendio,
                                                                            $strFechaProgramada,
                                                                            $strFechaRegistro,
                                                                            $strHoraProgramada,
                                                                            $strAsuntoLlamada,
                                                                            $strDetalleLlamada);
                                                                            $option = 1;
            }
            if($requestAgendarProspecto > 0){
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

    public function getPersonaSeguimiento(int $idPersona)
    {
        $intIdPersona = intval($idPersona);
        if($intIdPersona > 0)
        {
            $arrData = $this->model->selectPersonaSeguimiento($intIdPersona);
            if(empty($arrData))
            {
                $arrResponse = array('estatus' => false, 'msg' => 'Datos no encontrados');
            }
            else
            {
                $arrResponse = array('estatus' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
