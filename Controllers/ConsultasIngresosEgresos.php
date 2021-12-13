<?php
    class ConsultasIngresosEgresos extends Controllers{
        public function __construct(){
            parent::__construct();
            session_start();
		    if(empty($_SESSION['login']))
		    {
			    header('Location: '.base_url().'/login');
			    die();
		    }
        }
        public function consultas(){
            $data['page_id'] = 10;
            $data['page_tag'] = "Consultas de Ingresos y Egresos";
            $data['page_title'] = "Consultas de ingresos y egresos";
            $data['page_content'] = "";
            $data['page_functions_js'] = "functions_consultas_ingresos_egresos.js";
            $this->views->getView($this,"consultas_ingresos_egresos",$data);
        }
        public function getEstadoCuenta($str){
            $arrData = $this->model->selectEdoCuenta($str);
            for ($i=0; $i<count($arrData); $i++){
                $arrData[$i]['numeracion'] = $i+1;
                $arrData[$i]['concepto'] = null;
                $arrData[$i]['subconcepto'] = null;
                $arrData[$i]['saldo'] = 0;
                $arrData[$i]['fecha_apgo'] = null;
                $arrData[$i]['referencia'] = null;
                $arrData[$i]['factura'] = null;
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
    }
?>