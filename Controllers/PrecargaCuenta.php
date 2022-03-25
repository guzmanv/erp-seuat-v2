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
			$data['page_functions_js'] = "functions_precarga_cuenta.js";
			$this->views->getView($this,"precargaCuenta",$data);
		}
        public function getPlanEstudios($idPlantel){
            if($idPlantel == 'Todos'){
                $arrData = $this->model->selectPlanEstudios();
            }else{
                $idPlantel = intval($idPlantel);
                $arrData = $this->model->selectPlanEstudiosByPlantel($idPlantel);
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
	}
?>