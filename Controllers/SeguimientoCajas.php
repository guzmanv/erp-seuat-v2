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
            if($arrData[$i]['estatus_caja'] == 1){
                $fechaApertura = $this->model->selectCaja($arrData[$i]['id_caja'])['fechayhora_apertura_caja'];
                $totalVenta = $this->model->selectVentaTotal($arrData[$i]['id_caja'],$fechaApertura);
                $total = 0;
                foreach ($totalVenta as $key => $value) {
                    $total += $value['total'];
                }
                $arrData[$i]['total_venta'] = $total;
            }else{
                $arrData[$i]['total_venta'] = 0;
            }
        }
        return $arrData;
    }
    public function selectVentasAll(){
        $arrData = $this->model->selectVentasTotalAll();
        $dias = [];
        $data = [];
        $array = [];
        foreach ($arrData as $key => $value) {
            if(!in_array($value['fecha'],$dias)){
                array_push($dias,$value['fecha']);
            }
        }
        foreach ($arrData as $key => $value) {
            if(!in_array($value['id_plantel'],$data)){
                array_push($data,$value['id_plantel']);
            }
        }
        /* $arrValores = [];
        foreach ($arrResponde as $key1 => $value1) {
            $arr = [];
            foreach ($arrData as $key2 => $value2) {
                $valores = array('plantel'=>$value2['abreviacion_plantel'],'total'=>$value2['total']);
                if($value2['fecha'] == $key1){
                    array_push($arr,$valores);
                }
            }
            $arrValores[$key1] = $arr;
        } */
        $array['dias'] = $dias;
        $array['datos'] = $data;
        echo json_encode($array,JSON_UNESCAPED_UNICODE);
		die();
    }
  }
?>
