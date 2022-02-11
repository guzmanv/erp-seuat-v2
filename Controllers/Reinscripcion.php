<?php
	class Reinscripcion extends Controllers{
		public function __construct(){
			parent::__construct();
			session_start();
			if(empty($_SESSION['login'])){
				header('Location: '.base_url().'/login');
				die();
			}
		}
		public function reinscripcion(){
			$data['page_tag'] = "Reinscripcion";
			$data['page_title'] = "Reinscripcion";
			$data['page_name'] = "Reinscripcion";
			$data['page_functions_js'] = "functions_reinscripcion.js";
			$this->views->getView($this,"reinscripcion",$data);
		}
	}
?>