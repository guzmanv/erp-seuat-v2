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
            $arrData = $this->estadoCuenta($str);
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }

        public function imprimir_edo_cta($str){
            $data = [
                'data'=> $this->datosAlumno($str),
                'edo_cta'=> $this->estadoCuenta($str)
                ];
            $this->views->getView($this,"viewpdf_edo_cta",$data);
        }

        public function getDatosAlumno($str){
            $arrData = $this->datosAlumno($str);
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function buscarPersonaModal(){
            $data = $_GET['val'];
            $arrData = $this->model->selectPersonasModal($data);
            for($i = 0; $i <count($arrData); $i++){
                if($arrData[$i]['rfc'] == null){
                    $arrData[$i]['rfc'] = '<span class="badge badge-warning">Sin datos fiscales</span>';
                    $arrData[$i]['options'] = '<button type="button"  id="'.$arrData[$i]['id'].'" class="btn btn-primary btn-sm" rl="'.$arrData[$i]['nombre'].'" r="" m="'.$arrData[$i]['matricula_interna'].'" onclick="seleccionarPersona(this)">Seleccionar</button>';
                }else{
                    $arrData[$i]['rfc'] = $arrData[$i]['rfc'];
                    $arrData[$i]['options'] = '<button type="button"  id="'.$arrData[$i]['id'].'" class="btn btn-primary btn-sm" rl="'.$arrData[$i]['nombre'].'" r="'.$arrData[$i]['rfc'].'" m="'.$arrData[$i]['matricula_interna'].'" onclick="seleccionarPersona(this)">Seleccionar</button>';
                }
            }
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

        
        protected function datosAlumno($str){
            $edoCtaMatricula = $str;
            $arrData['datos'] = $this->model->selectDatosAlumno($edoCtaMatricula);
            $arrData['totalSaldo'] = $this->model->selectEdoCuenta($str);
            $total = 0;
            $saldoServicios = 0;
            $saldoColegiatura = 0;
            foreach ($arrData['totalSaldo'] as $key => $value) {
                $total += $value['precio_unitario'];
                if($value['codigo_servicio'] == 'CM'){
                    $saldoColegiatura += $value['precio_unitario'];
                }else{
                    $saldoServicios += $value['precio_unitario'];
                }
            }
            $arrData['totalSaldo'] = $total;
            $arrData['saldoServicios'] = $saldoServicios;
            $arrData['saldoColegiaturas'] = $saldoColegiatura;
            return $arrData; 
        }
        protected function estadoCuenta($str){
            $arrData = $this->model->selectEdoCuenta($str);
            for ($i=0; $i<count($arrData); $i++){
                $arrData[$i]['numeracion'] = $i+1;
                $arrData[$i]['fecha'] = ($arrData[$i]['fecha_pago']== '')?'0000-00-00':$arrData[$i]['fecha_pago'];
                $arrData[$i]['concepto'] = 'LA-C78MS';
                $arrData[$i]['subconcepto'] = $this->getSubConcepto(($arrData[$i]['codigo_servicio'] == 'CM')?$arrData[$i]['descripcion'].'.'.$arrData[$i]['fecha_pago']:$arrData[$i]['codigo_servicio']);
                $arrData[$i]['descripcion'] = ($arrData[$i]['codigo_servicio'] == 'CM')?$arrData[$i]['descripcion']:$arrData[$i]['nombre_servicio'];
                $arrData[$i]['cargo'] = ($arrData[$i]['cargo']=='')?'$0.00':$arrData[$i]['cargo']; 
                $arrData[$i]['recargo'] = '$0.00';
                $arrData[$i]['abono'] = $arrData[$i]['abono'];
                $arrData[$i]['cantidad'] = ($arrData[$i]['cantidad']=='')?'0':$arrData[$i]['cantidad']; 
                $arrData[$i]['precio_unitario'] = '$'.$arrData[$i]['precio_unitario'];
                $arrData[$i]['fecha_pago'] = $arrData[$i]['fecha_pagado'];
                $arrData[$i]['referencia'] = $arrData[$i]['folio'];
                $arrData[$i]['options'] = ($arrData[$i]['fecha_pago'] == '')?'<a href="'.BASE_URL.'/Ingresos" class="badge badge-primary">Cobrar</a>':'<a href="'.BASE_URL.'/Ingresos" class="badge badge-primary"></a>';
            }
            return $arrData;
        }
    }
?>