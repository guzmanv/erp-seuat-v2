<?php
	class PrecargaCuenta extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
		}
		//Funcion para la Vista de Planteles
		public function precargacuenta()
		{
			$data['page_tag'] = "Precarga cuenta";
			$data['page_title'] = "Precarga cuenta";
			$data['page_name'] = "Precarga cuenta";
			$data['page_content'] = "";
            $data['planteles'] = $this->model->selectPlanteles();
            $data['periodos'] = $this->model->selectPeriodos();
            $data['grados'] = $this->model->selectGrados();
			$data['page_functions_js'] = "functions_precarga_cuenta.js";
			$this->views->getView($this,"precargaCuenta",$data);
		}
        public function getPlanEstudios($arrgs){
			$args = explode(",",$arrgs);
			$idPlantel = $args[0];
			$idNivel = $args[1];
            if($idPlantel == 'Todos'){
				if($idNivel == 'null'){
					$arrData = $this->model->selectPlanEstudios();
				}else{
					$arrData = $this->model->selectPlanEstudiosByNivel($idNivel);
				}
            }else{
                $idPlantel = intval($idPlantel);
				if($idNivel == 'null' || $idNivel == 'Todos'){
					$arrData = $this->model->selectPlanEstudiosByPlantel($idPlantel);
				}else{
					$arrData = $this->model->selectPlanEstudiosByPlantelNivel($idPlantel,$idNivel);
				}
            }
            for($i = 0; $i<count($arrData); $i++){
                $arrData[$i]['numeracion'] = $i+1;
                $arrData[$i]['options'] = "<button type='button' class='btn btn-primary btn-sm center' onclick='fnServicios(".$arrData[$i]['id_plantel'].")'>Ver</button>";
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }
        public function getServicios(int $idPlantel){
            $idPlantel = intval($idPlantel);
            $arrData = $this->model->selectServicios($idPlantel);
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }
		public function getNivelesByPlantel($idPlantel){
			if($idPlantel == 'Todos'){
				$arrData = $this->model->seletNiveles();
			}else{
				$idPlantel = intval($idPlantel);
				$arrData = $this->model->selectNivelesByPlantel($idPlantel);
			}
			echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
			die();
		}

		public function setPrecarga($args){
			$params = explode(",",$args);
			//let url = `${base_url}/PrecargaCuenta/setPrecarga/${grado}/${periodo}/${datos}/${idPlantel}/${nivel}`;
			$idPlantel = intval($params[3]);
			$idNivel = intval($params[4]);
			$idPeriodo = intval($params[1]);
			$idGrado = intval($params[0]);
			$arrDatos = json_decode(base64_decode($params[2]));
			if($idPlantel == 0 || $idNivel == 0 || $idPeriodo == 0 || $idGrado == 0){
                $arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
			}
			echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			die();
		}
	}
?>