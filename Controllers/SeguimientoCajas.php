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
        $listFechas = [];
        foreach ($arrData as $key => $value) {
            if($listFechas[$value['fecha']] == '') {
                $listFechas[$value['fecha']] = 0;
            }
            $listFechas[$value['fecha']] += 1;
        }
        $response['fechas'] = $listFechas;
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
		die();
    }
  }
?>
