<?php
	class CorteCaja extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function cortecaja()
		{
			$data['page_id'] = 2;
			$data['page_tag'] = "Corte caja";
			$data['page_title'] = "Corte caja";
			$data['page_name'] = "Corte caja";
			$data['page_functions_js'] = "functions_corte_caja.js";
			$data['corte_actual'] = count($this->model->selectCorteActual())+1;
			$data['cajeros'] = $this->model->selectCajeros();
			$this->views->getView($this,"cortecaja",$data);
		}
		public function getCaja($idCaja){
			$arrData = $this->model->selectCaja($idCaja);
			if($arrData){
				$arrData['estatus'] = true;
				$arrData['fechayhora_apertura_caja'] = date('Y-m-d h:i:s A', strtotime($arrData['fechayhora_apertura_caja']));
				$arrData['fechayhora_actual'] = date('Y-m-d h:i:s A');
			}else{
				$arrData['estatus'] = false;
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}
		public function getTotalesMetodosPago(){
			$arrData = $this->model->selectTotalesMetodosPago();
			$array = [];
			/* for($i = 0; $i<count($arrData); $i++){
				//$array[$i] = $arrData[$i]['id_metodo_pago'];
				if($array[$arrData[$i]['id_metodo_pago']] == ''){
					$array[$arrData[$i]['id_metodo_pago']] = 0;
				}
				$array[$arrData[$i]['id_metodo_pago']] += 1;
			} */
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}
	}
?>