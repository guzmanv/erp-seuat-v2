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
                $arrData[$i]['fecha'] = ($arrData[$i]['fecha_pago']== '')?'0000-00-00':$arrData[$i]['fecha_pago'];
                $arrData[$i]['concepto'] = 'LA-C78MS';
                $arrData[$i]['subconcepto'] = $this->getSubConcepto(($arrData[$i]['codigo_servicio'] == 'CM')?$arrData[$i]['descripcion'].'.'.$arrData[$i]['fecha_pago']:$arrData[$i]['codigo_servicio']);
                $arrData[$i]['descripcion'] = ($arrData[$i]['codigo_servicio'] == 'CM')?$arrData[$i]['descripcion']:$arrData[$i]['nombre_servicio'];
                $arrData[$i]['cargo'] = 0;
                $arrData[$i]['abono'] = 0;
                $arrData[$i]['saldo'] = 0;
                $arrData[$i]['fecha_pago'] = null;
                $arrData[$i]['referencia'] = null;
                $arrData[$i]['factura'] = null;
                $arrData[$i]['options'] = '<a href="'.BASE_URL.'/Ingresos" class="badge badge-primary"> cobrar </a>';
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function imprimir_edo_cta(){
            $this->views->getView($this,"viewpdf_edo_cta",'');
        }
        public function getDatosAlumno($str){
            $edoCtaMatricula = $str;
            $arrData = $this->model->selectDatosAlumno($edoCtaMatricula);
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        protected function getSubConcepto($str){
            if(stristr($str,'COL')){
                $array = explode('.',$str);
                $anio = explode('-',$array[2]);
                return $array[1].'/'.$anio[0];
            }else{ return $str;}
        }
    }
?>