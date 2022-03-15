<?php
	class HistorialCorteCajas extends Controllers{
        private $idUser;
		public function __construct(){
			parent::__construct();
            session_start();
            if(empty($_SESSION['login'])){
                header('Location: '.base_url().'/login');
                die();
            }
            $this->idUser = $_SESSION['idUser'];
		}
		public function historialcortecajas(){
			$data['page_tag'] = "Historial de corte de cajas";
			$data['page_title'] = "Historial de corte de cajas";
			$data['page_name'] = "Historial de corte de cajas";
			$data['page_content'] = "";
			$data['page_functions_js'] = "functions_historial_cortes_caja.js";
			$this->views->getView($this,"historialcortecajas",$data);
		}
		public function getCortesCajas(){
			$arrData = $this->model->selectCortesCajas();
			for($i = 0; $i<count($arrData); $i++){
				$arrData[$i]['numeracion'] = $i+1;
				$arrData[$i]['plantel'] = $arrData[$i]['nombre_plantel'].'/'.$arrData[$i]['municipio'];
				$arrData[$i]['faltante'] = '$'.formatoMoneda($arrData[$i]['dinero_faltante']);
				$arrData[$i]['sobrante'] = '$'.formatoMoneda($arrData[$i]['dinero_sobrante']);
				$arrData[$i]['options'] = '<div class="text-center">
				<div class="btn-group">
					<button type="button" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-layer-group"></i> &nbsp; Acciones
					</button>
					<div class="dropdown-menu">
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal datosPersonalesVerficar" onClick="fnDatosPersonalesVerificacion(this)" data-toggle="modal" data-target="#ModalFormEditPersona" title="Datos Personales"> &nbsp;&nbsp; <i class="far fa-address-book"></i> &nbsp Ver</button>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal data-toggle="modal" data-target="" title="Documentacion"> &nbsp;&nbsp; <i class="far fa-file-word"></i> &nbsp;Ver2</button>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal editDatosFiscales" onclick="fnDatosFiscales(this)"  data-toggle="modal" data-target="#ModalFormDatosFiscales" title="Datos fiscales"> &nbsp;&nbsp; <i class="fas fa-file-invoice-dollar"></i> &nbsp;Datos fiscales</button>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal editTutor" onclick="fnEditTutor(this)" data-toggle="modal" data-target="#ModalFormEditTutor" title="Tutor"> &nbsp;&nbsp; <i class="fas fa-user-friends"></i> &nbsp;Datos tutor</button>
						<div class="dropdown-divider"></div>
					</div>
				</div>
				</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}
    }
?>