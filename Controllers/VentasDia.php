<?php
    class VentasDia extends Controllers{
        private $idUser;
        public function __construct(){
            parent::__construct();
            session_start();
		    if(empty($_SESSION['login']))
		    {
			    header('Location: '.base_url().'/login');
			    die();
		    }
            $this->idUser = $_SESSION['idUser'];
        }
        //Mostrar vista de ingresos
        public function ventasdia(){
            $data['page_id'] = 10;
            $data['page_tag'] = "Ventas del dia";
            $data['page_title'] = "Ventas del dia";
            $data['page_content'] = "";
            $data['page_functions_js'] = "functions_venta_dia.js";
            
            $this->views->getView($this,"ventasdia",$data);
        }
        
        //Ventas del Dia
        public function getVentasDia(){
            $fechaActual = date("Y-m-d");
            $arrData = $this->model->selectVentasDia($fechaActual);
            for ($i=0; $i<count($arrData); $i++){
                $arrData[$i]['numeracion'] = $i+1;
                $array = $this->getDatosAlumno($arrData[$i]['id_persona']);
                $arrData[$i]['nombre_completo'] = $array['nombre_completo'];
                $arrData[$i]['plantel'] = $array['plantel'];
                $arrData[$i]['carrera'] = $array['nombre_carrera'];
                $arrData[$i]['grado'] = $array['grado'];
                $arrData[$i]['total_formato'] = '$ '.formatoMoneda($arrData[$i]['total']);
                $arrData[$i]['acciones'] = '<button type="button"  id="'.$arrData[$i]['id'].'" class="btn btn-secondary btn-xs" onclick="detallesIngreso(this)" data-toggle="modal" data-target="#modalVentaDetallesDia">Detalles</button>';
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
        }

        private function getDatosAlumno(int $idAlumno){
            $arrData = $this->model->selectDatosAlumno($idAlumno);
            $arrData['nombre_completo'] = $arrData['nombre_persona'].' '.$arrData['ap_paterno'].' '.$arrData['ap_materno'];
            $arrData['plantel'] = $arrData['abreviacion_sistema'].'('.$arrData['abreviacion_plantel'].' / '.$arrData['municipio'].' )';
            return $arrData;
        }
    }
?>