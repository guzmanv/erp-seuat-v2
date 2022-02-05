<?php
class HistorialPagosAlumno extends Controllers{
    public function __construct(){
        parent::__construct();
        session_start();
        if(empty($_SESSION['login'])){
            header('Location: '.base_url().'/login');
            die();
        }
    }
    public function historial(){
        $data['page_id'] = 0;
		$data['page_tag'] = "Estudiantes";
		$data['page_title'] = "Historial de pagos";
		$data['page_name'] = "estudiantes";
		$data['page_content'] = "";
		$data['page_functions_js'] = "functions_historial_pagos.js";
		$this->views->getView($this,"historialpahosalumno",$data);
    }
    public function getEstudiantes(){
        $arrData = $this->model->selectEstudiantes();
        for($i = 0; $i <count($arrData); $i++){
            $arrData[$i]['numeracion'] = $i+1;
            $arrData[$i]['options'] = '<button type="button"  id="'.$arrData[$i]['id'].'" class="btn btn-primary btn-sm" onclick="seleccionarPersona('.$arrData[$i]['id'].')">Ver</button>';
        }
        echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
        die();
    }
    public function getDetallesEstudiante($idAlumno){
        $arrData = $this->model->selectDetalleEstudiante($idAlumno);
        echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
        die();
    }
    public function getUltimosMovimientosAlumno($idAlumno){
        $arrData = $this->model->selectUltimosMovimientos($idAlumno);
        echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>
