<?php
    class Inscripcion extends Controllers{
        public function __construct(){
            parent::__construct();
            session_start();
		    if(empty($_SESSION['login']))
		    {
			    header('Location: '.base_url().'/login');
			    die();
		    }
        }
        //Funcion para mostrar Vista(Admision)
        public function admision(){
            $data['page_id'] = 10;
            $data['page_tag'] = "Inscripcion";
            $data['page_title'] = "Inscripciones";
            $data['page_content'] = "";
            $data['planteles'] = $this->model->selectPlanteles();
            $data['grados'] = $this->model->selectGrados();
            $data['subcampanias'] = $this->model->selectSubcampanias();
            $data['turnos'] = $this->model->selectturnos();
            $data['page_functions_js'] = "functions_inscripciones_admision.js";
            $this->views->getView($this,"inscripcion",$data);
        }
        //Funcion para mostrar Vista(ControlEscolar)
        public function controlescolar(){
            $data['page_id'] = 10;
            $data['page_tag'] = "Inscripcion";
            $data['page_title'] = "Inscripciones";
            $data['page_content'] = "";
            $data['planteles'] = $this->model->selectPlanteles();
            $data['grados'] = $this->model->selectGrados();
            $data['subcampanias'] = $this->model->selectSubcampanias();
            $data['turnos'] = $this->model->selectturnos();
            $data['page_functions_js'] = "functions_inscripciones_controlescolar.js";
            $this->views->getView($this,"inscripcion",$data);
        }
        //Obtener Lista de Inscripciones(Admision)
        public function getInscripcionesAdmision(){
            $idPlantel = $_GET['idplantel'];
            $arrData = $this->model->selectInscripcionesAdmision($idPlantel);
            for ($i=0; $i<count($arrData); $i++){
                $arrData[$i]['numeracion'] = $i+1;
                //$arrData[$i]['nombre_plantel'] = $arrData[$i]['nombre_plantel'].'('.$arrData[$i]['municipio'].')';
                if($arrData[$i]['nombre_grupo'] == null){
                    $arrData[$i]['nombre_grupo'] = "Sin grupo";
                }else{
                    
                }
                $arrData[$i]['total'] = '<h5><span class="badge badge-secondary pr-2 pl-2">'.$arrData[$i]['total'].'</span></h5>';
                $arrData[$i]['options'] = '<button type="button"  id="'.$arrData[$i]['id'].'" gr="'.$arrData[$i]['grado'].'" tr="'.$arrData[$i]['id_turno'].'" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalFormListaInscritos" onclick="fnListaInscritos(this)">Ver</button>';
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        //Obtener Lista de Inscripciones(ControlEscolar)
        public function getInscripcionesControlEscolar(){
            $idPlantel = $_GET['idplantel'];
            $arrData = $this->model->selectInscripcionesControlEscolar($idPlantel);
            for ($i=0; $i<count($arrData); $i++){
                $arrData[$i]['numeracion'] = $i+1;
                /* if($arrData[$i]['validacion'] == 1){
                    $arrData[$i]['validacion'] = '<span class="badge badge-success">Validado</span>';
                }else{
                    $arrData[$i]['validacion'] = '<span class="badge badge-warning">No Validado</span>';
                } */
                if($arrData[$i]['nombre_grupo'] == null){
                    $arrData[$i]['nombre_grupo'] = "Sin grupo";
                }else{
                    
                }
                $arrData[$i]['total'] = '<h5><span class="badge badge-secondary pr-2 pl-2">'.$arrData[$i]['total'].'</span></h5>';
                $arrData[$i]['options'] = '<div class="text-center">
				<div class="btn-group">
					<button type="button" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-layer-group"></i> &nbsp; Acciones
					</button>
					<div class="dropdown-menu">
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditPlan" onClick="fntEditPlan('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalFormEditPlan" title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal documentacionInscripcion" onClick="fntDocumentacionInscripcion('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalFormDocumentacion" title="Documentacion"> &nbsp;&nbsp; <i class="fas fa-copy"></i> &nbsp;Documentacion</button>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal plataformasInscripcion" onClick="fntPlataformasInscripcion('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalFormPlataformasInscripcion" title="Plataformas"> &nbsp;&nbsp; <i class="fas fa-cat"></i> &nbsp;Plataformas</button>
						<div class="dropdown-divider"></div>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelPlan" onClick="fntDelPlan('.$arrData[$i]['id'].')" title="Eliminar"> &nbsp;&nbsp; <i class="far fa-trash-alt "></i> &nbsp; Eliminar</button>
						<!--<a class="dropdown-item" href="#">link</a>-->
					</div>
				</div>
				</div>'; 
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        //Buscar Persona del en el Modal Inscripcion
        public function buscarPersonaModal(){
            $data = $_GET['val'];
            $arrData = $this->model->selectPersonasModal($data);
            for($i = 0; $i <count($arrData); $i++){
                if($arrData[$i]['id_inscripcion'] == null){
                    $arrData[$i]['estatus'] = '<span class="badge badge-warning">No inscrito</span>';
                    $arrData[$i]['options'] = '<button type="button"  id="'.$arrData[$i]['id'].'" class="btn btn-primary btn-sm" rl="'.$arrData[$i]['nombre'].'" onclick="seleccionarPersona(this)">Seleccionar</button>';

                }else{
                    $arrData[$i]['estatus'] = '<span class="badge badge-success">Inscrito</span>';
                    $arrData[$i]['options'] = '<button type="button"  id="'.$arrData[$i]['id'].'" class="btn btn-secondary btn-sm" rl="'.$arrData[$i]['nombre'].'" onclick="seleccionarPersona(this)" disabled>Seleccionar</button>';

                }
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();

        }
        //Guardar Inscripcion
        public function setInscripcion(){
            $data = $_POST;
            $intIdInscripcionNueva = 0;
            $intIdInscripcionEdit = 0;
            if(isset($_POST['idNuevo'])){
                $intIdInscripcionNueva = intval($_POST['idNuevo']);
            }
            if(isset($_POST['idEdit'])){
                $intIdInscripcionEdit = intval($_POST['idEdit']);
            }
            //Nueva
            if($intIdInscripcionNueva == 0){
                $arrData = $this->model->insertInscripcion($data);
                if($arrData){
                    $arrResponse = array('estatus' => true,'data'=> $arrData, 'msg' => 'Inscripcion realizado correctamente!');
                }else{
                    $arrResponse = array('estatus' => false, 'msg' => 'No es posible Guardar los Datos');
                }
            }
            //Editar
            if($intIdInscripcionEdit !=0){
                $arrData = $this->model->updateInscripcion($intIdInscripcionEdit,$data);
                if($arrData){
                    $arrResponse = array('estatus' => true, 'msg' => 'Datos Actualizados Correctamente');
                }else{
                    $arrResponse = array('estatus' => false, 'mgg' => 'No es posible Actualizar los datos');
                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
        //Obtener Lista de Carreras
        public function getCarreras(){
            $idPlantel = $_GET['iplantel'];
            $arrData = $this->model->selectCarreras($idPlantel);
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        //Obtener Datos de Persona
        public function getPersona(){
            $idPersona = $_GET['id'];
            $arrData = $this->model->selectPersona($idPersona);
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        //Obtener Lista de Documentos
        public function getDocumentos(){
            $id = $_GET['id_alumno'];
            $arrData = $this->model->selectDocumentacion($id);
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }

        //Obtener Inscripcion por ID
        public function getInscripcion(int $idInscripcion){
            $arrData = $this->model->selectInscripcion($idInscripcion);
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }

        //Obtener Lista de Inscritos en una Carrera
        public function getInscritos(){
            $idCarrera = $_GET['idCarrera'];
            $grado = $_GET['grado'];
            $turno = $_GET['turno'];
            $arrData = $this->model->selectInscritos($idCarrera,$grado, $turno);
            for ($i=0; $i<count($arrData); $i++){
                $arrData[$i]['numeracion'] = $i+1;
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        //Imprimir solicitud de inscripcion
        public function imprimir_solicitud_inscripcion($idInscripcion){
            $idInscripcion = $idInscripcion;
            $arrDataIns = $this->model->selectDatosImprimirSolInscricpion($idInscripcion);
            $idPlanEstudio = $arrDataIns['id_plan_estudio'];
            $arrDataDoc = $this->model->selectDocumentacionInscripcion($idPlanEstudio);
            $data['datos'] = $arrDataIns;
            $data['doc'] = $arrDataDoc;
            $this->views->getView($this,"viewpdf",$data);
        }
    }
?>