<?php
  class SeguimientoCajas extends Controllers{

    public function __construct(){
      parent::__construct();
      session_start();
      if(empty($_SESSION['login'])){
        header('Location: '.base_url().'/login');
        die();
      }
    }
    public function seguimientocajas(){
        $data['page_tag'] = "Seguimiento cajas";
        $data['page_title'] = "Seguimiento cajas";
        $data['page_name'] = "seguimiento cajas";
        $data['page_functions_js'] = "functions_seguimiento_cajas.js";
        $data['cajeros'] = $this->selectCajeros(null);
        $this->views->getView($this,"seguimientocajas",$data);
    }
    public function selectCajeros($idPlantel){
        $arrData = $this->model->selectCajeros($idPlantel);
        for($i = 0; $i<count($arrData); $i++){
            $arrData[$i]['total_venta'] = 12000;
        }
        return $arrData;
    }
  }
?>
