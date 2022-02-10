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
			$data['datos'] = $this->model->selectAlumnos();
			$this->views->getView($this,"cortecaja",$data);
		}
	}
?>