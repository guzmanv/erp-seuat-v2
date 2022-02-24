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
			echo json_encode($arrData['nombre'],JSON_UNESCAPED_UNICODE);
			die();
		}
	}
?>