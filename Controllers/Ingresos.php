<?php
    class Ingresos extends Controllers{
        public function __construct(){
            parent::__construct();
            session_start();
		    if(empty($_SESSION['login']))
		    {
			    header('Location: '.base_url().'/login');
			    die();
		    }
        }
        public function ingresos(){
            $data['page_id'] = 10;
            $data['page_tag'] = "Ingresos";
            $data['page_title'] = "Caja (ingresos)";
            $data['page_content'] = "";
            $data['page_functions_js'] = "functions_ingresos.js";
            $this->views->getView($this,"ingresos",$data);
        }
        public function getIngresos(){
            $arrData = $this->model->selectIngresos();
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
       /*  public function getAlumnos(){
            $arrData = $this->model->selectEstudiantes();
            for ($i=0; $i<count($arrData); $i++){
                $arrData[$i]['numeracion'] = $i+1;
                $arrData[$i]['options'] = '<div class="text-center">
				<div class="btn-group">
					<button type="button" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-layer-group"></i> &nbsp; Acciones
					</button>
					<div class="dropdown-menu">
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal pagosServicios" onClick="fnPagosServicios(this)" idper = '.$arrData[$i]['id_persona'].' nomper = '.$arrData[$i]['nombre_persona']."&nbsp".$arrData[$i]['apellidos'].' data-toggle="modal" data-target="#ModalFormPagosServicios" title="Pagos Servicios"> &nbsp;&nbsp; <i class="fas fa-dollar-sign"></i> &nbsp;Pagos Servicios</button>
                        <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal generarEstadoCuenta onclick="gnGenerarEstadoCuenta(this)" data-toggle="modal" data-target="#ModalFormGenerarEstadoCuenta" title="Generar estado de cuenta"> &nbsp;&nbsp; <i class="fas fa-file-invoice-dollar"></i> &nbsp;Generar estado de cuenta</button>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal reembolsos" onclick="fnReembolsos(this)" idPer = '.$arrData[$i]['id_persona'].' data-toggle="modal" data-target="#ModalFormReembolsos" title="Reembolsos"> &nbsp;&nbsp; <i class="fas fa-hand-holding-usd"></i> &nbsp;Reembolsos</button>
						<div class="dropdown-divider"></div>
					</div>
				</div>
				</div>';
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        } */
        public function buscarPersonaModal(){
            $data = $_GET['val'];
            $arrData = $this->model->selectPersonasModal($data);
            for($i = 0; $i <count($arrData); $i++){
                $arrData[$i]['numeracion'] = $i+1;
                $arrData[$i]['options'] = '<button type="button"  id="'.$arrData[$i]['id'].'" class="btn btn-primary btn-sm" rl="'.$arrData[$i]['nombre'].'" onclick="seleccionarPersona(this)">Seleccionar</button>';
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();

        }
        public function getEstatusEstadoCuenta($idPersonaSeleccionada){
            $arrData = $this->model->selectStatusEstadoCuenta($idPersonaSeleccionada);
            if(count($arrData) == 0){
                $arrRequest = false;
            }else{
                $arrRequest = true;
            }
            echo json_encode($arrRequest,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function getServicios($valor){
            $valor = explode(',',$valor);
            $pago = $valor[0];
            $idPersona = $valor[1];
            if($pago == 1){
                $arrData['tipo'] = "COL";
                $arrData['data'] = $this->model->selectColegiaturas($idPersona);
            }else{
                $arrData['tipo'] = "SERV";
                $arrData['data'] = $this->model->selectServicios($idPersona);
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function getPromociones($idServicio){
            $arrData = $this->model->selecPromociones($idServicio);
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function generarEdoCuenta($idPersonaSeleccionada){
            $arrPlantel = $this->model->selectPlantelAlumno($idPersonaSeleccionada);
            $arrCarrera = $this->model->selectCarreraAlumno($idPersonaSeleccionada);
            $arrGrado = $this->model->selectGradoAlumno($idPersonaSeleccionada);
            $arrPeriodo = $this->model->selectPeriodoAlumno($idPersonaSeleccionada);
            $idPlantel = $arrPlantel['id'];
            $idCarrera = $arrCarrera['id_plan_estudios'];
            $idGrado = $arrGrado['grado'];
            $idPeriodo = $arrPeriodo['id_periodo'];
            $arrData = $this->model->generarEdoCuentaAlumno($idPersonaSeleccionada,$idPlantel,$idCarrera,$idGrado,$idPeriodo);
            if($arrData){
                $arrResponse = true;
            }else{
                $arrResponse = false;
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }
    }
?>