<?php
    class Ingresos extends Controllers{
        public function __construct(){
            parent::__construct();
            session_start();
		    if(empty($_SESSION['login']))
		    {
			    header('Location: '.base_url().'/login');
			    die();
		    }
        }
        //Mostrar vista de ingresos
        public function ingresos(){
            $data['page_id'] = 10;
            $data['page_tag'] = "Ingresos";
            $data['page_title'] = "Caja (ingresos)";
            $data['page_content'] = "";
            $data['page_functions_js'] = "functions_ingresos.js";
            $this->views->getView($this,"ingresos",$data);
        }
        //Funcion obtener lista ingresos
        public function getIngresos(){
            $arrData = $this->model->selectIngresos();
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        //Funcion para buscar persona en el Modal
        public function buscarPersonaModal(){
            $data = $_GET['val'];
            $arrData = $this->model->selectPersonasModal($data);
            for($i = 0; $i <count($arrData); $i++){
                $arrData[$i]['numeracion'] = $i+1;
                $arrData[$i]['options'] = '<button type="button"  id="'.$arrData[$i]['id'].'" class="btn btn-primary btn-sm" rl="'.$arrData[$i]['nombre'].'" onclick="seleccionarPersona(this)">Seleccionar</button>';
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();

        }
        //Funcion para obtener si una persona tiene estado de cuenta
        public function getEstatusEstadoCuenta($idPersonaSeleccionada){
            $arrData = $this->model->selectStatusEstadoCuenta($idPersonaSeleccionada);
            if(count($arrData) == 0){
                $arrRequest = false;
            }else{
                $arrRequest = true;
            }
            echo json_encode($arrRequest,JSON_UNESCAPED_UNICODE);
            die();
        }        
        // Funcion para obtener Servicios por Tipo de pago
        public function getServicios($valor){
            $valor = explode(',',$valor);
            $pago = $valor[0];
            $idPersona = $valor[1];
            if($pago == 1){
                $arrData['tipo'] = "COL";
                $arrData['data'] = $this->model->selectColegiaturas($idPersona);
            }else{
                $arrData['tipo'] = "SERV";
                $arrData['data'] = $this->model->selectServicios($idPersona);
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        //Funcion para obtener promociones por Id del Servicio
        public function getPromociones($idServicio){
            $arrData = $this->model->selecPromociones($idServicio);
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        //Funcion para generar un estado de cuenta
        public function generarEdoCuenta($idPersonaSeleccionada){
            $arrPlantel = $this->model->selectPlantelAlumno($idPersonaSeleccionada);
            $arrCarrera = $this->model->selectCarreraAlumno($idPersonaSeleccionada);
            $arrGrado = $this->model->selectGradoAlumno($idPersonaSeleccionada);
            $arrPeriodo = $this->model->selectPeriodoAlumno($idPersonaSeleccionada);
            $idPlantel = $arrPlantel['id'];
            $idCarrera = $arrCarrera['id_plan_estudios'];
            $idGrado = $arrGrado['grado'];
            $idPeriodo = $arrPeriodo['id_periodo'];
            $arrData = $this->model->generarEdoCuentaAlumno($idPersonaSeleccionada,$idPlantel,$idCarrera,$idGrado,$idPeriodo);
            /* if($arrData){
                $arrResponse = true;
            }else{
                $arrResponse = false;
            } */

            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        //Funcion para enviar ingresos
        public function setIngresos(){
            $idAlumno = $_GET['idP'];
            $tipoPago = $_GET['tipoP'];
            $tipoComprobante = $_GET['tipoCom'];
            $observaciones = $_GET['observacion'];
            $arrayDate = json_decode($_GET['date']);
            $isColegiatura = false;
            $isOtroServicio = false;
            $isEdoCtaOtrosServ = false;
            foreach ($arrayDate as $key => $value) {
                ($value->tipo_servicio =='col')?$isColegiatura = true:$isColegiatura = false;
                ($value->tipo_servicio =='serv')?$isOtroServicio = true:$isOtroServicio = false;
            }
            foreach ($arrayDate as $key => $value) {
                if($value->edo_cta == 1){
                    $isEdoCtaOtrosServ = true;
                    break;
                }else{
                    $isEdoCtaOtrosServ = false;
                }
            }
            if($isColegiatura){
                foreach ($arrayDate as $key => $value) {
                    $idIngreso = $value->id_servicio;
                    $folio = $this->model->selectFolioSig($idAlumno);
                    $total = $value->subtotal;
                    $cantidad = $value->cantidad;
                    $precioUnitario = $value->precio_unitario;
                    $subtotal = $value->subtotal;
                    $arrPromociones = $value->promociones;
                    $reqIngreso = $this->model->updateIngresos($idIngreso,$tipoPago,$tipoComprobante,$observaciones,$folio,$total);
                    if($reqIngreso){
                        $reqIngDetalles = $this->model->updateIngresosDetalles($idIngreso,$cantidad,$precioUnitario,$subtotal,json_encode($arrPromociones));
                        if($reqIngDetalles){
                            $arrResponse = array('estatus' => true,'id'=>$idIngreso,'msg' => 'Datos guardados correctamente!');
                        }else{
                            $arrResponse = array('estatus' => false,'id'=>$idIngreso, 'msg' => 'No es posible guardar los datos');
                        }
                    }

                }
            }
            if($isOtroServicio == true && $isEdoCtaOtrosServ == false){
                $folio = $this->model->selectFolioSig($idAlumno);
                $total = 0;
                foreach ($arrayDate as $key => $value) {
                    $total += $value->subtotal;
                }
                $reqIngreso = $this->model->insertIngresos($folio,$tipoPago,$tipoComprobante,$total,$observaciones,$idAlumno);
                if($reqIngreso){
                    foreach ($arrayDate as $key => $value) {
                        $reqIngDetalles = $this->model->insertIngresosDetalle($value->cantidad,$value->precio_unitario,$value->precio_unitario,$total,$value->subtotal,0,0,json_encode($value->promociones),$value->id_servicio,$reqIngreso);
                        if($reqIngDetalles){
                            $arrResponse = array('estatus' => true,'id'=>$reqIngreso,'msg' => 'Datos guardados correctamente!');
                        }else{
                            $arrResponse = array('estatus' => false,'id'=>$reqIngreso, 'msg' => 'No es posible guardar los datos');
                        }
                    }
                }
            }
            if($isOtroServicio == true && $isEdoCtaOtrosServ == true){
                $folio = $this->model->selectFolioSig($idAlumno);
                $total = 0;
                $redIdIngreso;
                foreach ($arrayDate as $key => $value) {
                    if($value->edo_cta == '1'){
                        $redIdIngreso = $this->model->checkIdIngreso($value->id_servicio,$idAlumno);
                        break;
                    }
                    $total += $value->subtotal;
                }
                if($redIdIngreso){
                    $request = $this->model->updateIngresos($redIdIngreso['id'],$tipoPago,$tipoComprobante,$observaciones,$folio,$total);
                    if($request){
                        foreach ($arrayDate as $key => $value) {
                            if($value->edo_cta == 1){
                                $reqUpDetalles = $this->model->updateIngresosDetalles($request,$value->cantidad,$value->precio_unitario,$value->subtotal,json_encode($value->promociones));
                            }else{
                                $reqInsDetalles = $this->model->insertIngresosDetalle($value->cantidad,$value->precio_unitario,$value->precio_unitario,$total,$value->subtotal,0,0,json_encode($value->promociones),$value->id_servicio,$request);
                            }                               
                        }
                        $arrResponse = array('estatus' => true,'id'=>$request,'msg' => 'Datos guardados correctamente!');   
                    }else{
                        $arrResponse = array('estatus' => false,'msg' => 'No es posible guardar los datos');
                    }
                }else{
                    $arrResponse = array('estatus' => false,'msg' => 'Hay un servicio que no se ha agregado al <b>estado de cuente</b> del Alumno');
                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }
        //Funcion para imprimir comprante de una Venta
        public function imprimir_comprobante_venta(string $idVenta){
            $idIngreso = $this->reverse64($idVenta);
            $data['datosInstitucion'] = $this->model->selectDatosInstitucion($idIngreso); //Datos del plantel
            $data['datos_venta'] = $this->model->selectDatosVenta($idIngreso);//Datos del ingreso/venta
            $data['datos_alumno'] = $this->model->selectDatosAlumno($idIngreso);//Datos del Alumno
            $this->views->getView($this,"viewpdf_comprobante_venta",$data);
        }
        //Funcion para convertir base64 a Array
        private function reverse64($arr){
            return base64_decode($arr);
        }
        
    }
?>