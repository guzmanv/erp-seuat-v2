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
    }
?>