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
        $planteles = [];
        $arrGrafica = [];
        foreach ($arrData as $key => $value) {
            if(!in_array($value['fecha'],$dias)){
                array_push($dias,$value['fecha']);
            }
        }
        foreach ($arrData as $key => $value) {
            if($planteles[$value['id_plantel']] == ''){
                $planteles[$value['id_plantel']] = null;
            }
            $planteles[$value['id_plantel']] = $value['abreviacion_sistema'].'/'.$value['abreviacion_plantel'].'/'.$value['municipio'];
        }
        foreach ($planteles as $key => $value) {
            $data = ($key == 1)?[8,2,3,4,5,6]:[2,4,3,1,7,6];
            $value1 = array('label'=>$value,'data'=>$data,'borderColor'=>$this->rand_color(),'fill'=>false);
            array_push($arrGrafica,$value1);
        }
        /* foreach ($dias as $keyDia => $valueDia) {
            //$valueDiia = 2022-03-12
            $planteles = [];
            foreach ($arrData as $keyData => $valueData) {
                //$valueData = array
                if($valueData['fecha'] == $valueDia){
                    array_push($planteles,$valueData['id_plantel']);
                }
            }
            $grafica[$valueDia] = $planteles;
        } */
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
        $array['datos'] = $arrGrafica;
        echo json_encode($array,JSON_UNESCAPED_UNICODE);
		die();
    }
    public function rand_color() {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }
  }
?>
