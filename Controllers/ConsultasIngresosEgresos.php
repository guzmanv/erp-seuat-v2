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
        //Vista de consultas
        public function consultas(){
            $data['page_id'] = 10;
            $data['page_tag'] = "Consultas de estado de cuentas";
            $data['page_title'] = "Consultas de estado de cuentas";
            $data['page_content'] = "";
            $data['page_functions_js'] = "functions_consultas_ingresos_egresos.js";
            $this->views->getView($this,"consultas_ingresos_egresos",$data);
        }

        //Obtener estado de cuenta por matricula
        public function getEstadoCuenta($args){
            $arrArgs = explode(',',$args);
            $matriculaRFC = $arrArgs[0];
            $idAlumno = $arrArgs[1];
            if($matriculaRFC != 'null'){
                $arrData = $this->estadoCuenta($matriculaRFC,$idAlumno);
            }else{
                $arrData = $this->estadoCuenta($matriculaRFC,$idAlumno);
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        //Imprimir estado de cuenta
        public function imprimir_edo_cta($args){
            $arrArgs = explode(',',$args);
            $matriculaRFC = base64_decode($arrArgs[0]);
            $idAlumno = base64_decode($arrArgs[1]);
            if($matriculaRFC != 'null'){
                $arrData['datos'] = $this->model->selectDatosAlumnoByMatriculaRFC($matriculaRFC);
                $arrData['totalSaldo'] = $this->model->selectEdoCuentaByMatriculaRFC($matriculaRFC);
                $total = 0;
                $saldoServicios = 0;
                $saldoColegiatura = 0;
                foreach ($arrData['totalSaldo'] as $key => $value) {
                    if($value['fecha_pagado'] == ''){
                        $total += $value['precio_unitario'];
                        if($value['codigo_servicio'] == 'CM'){
                            $saldoColegiatura += $value['precio_unitario'];
                        }else{
                            $saldoServicios += $value['precio_unitario'];
                        }
                    }
                }
                $arrData['totalSaldo'] = $total;
                $arrData['saldoServicios'] = $saldoServicios;
                $arrData['saldoColegiaturas'] = $saldoColegiatura;
            }else{
                $arrData['datos'] = $this->model->selectDatosAlumnoById($idAlumno);
                $arrData['totalSaldo'] = $this->model->selectEdoCuentaById($idAlumno);
                $total = 0;
                $saldoServicios = 0;
                $saldoColegiatura = 0;
                foreach ($arrData['totalSaldo'] as $key => $value) {
                    if($value['fecha_pagado'] == ''){
                        $total += $value['precio_unitario'];
                        if($value['codigo_servicio'] == 'CM'){
                            $saldoColegiatura += $value['precio_unitario'];
                        }else{
                            $saldoServicios += $value['precio_unitario'];
                        }
                    }
                }
                $arrData['totalSaldo'] = $total;
                $arrData['saldoServicios'] = $saldoServicios;
                $arrData['saldoColegiaturas'] = $saldoColegiatura;
            }

            $data = ['data'=> $arrData,'edo_cta'=> $this->estadoCuenta($matriculaRFC,$idAlumno)];
            $this->views->getView($this,"viewpdf_edo_cta",$data);
        }
        //Obtener datos del Alumno y datos del Estado de Cuenta
        public function getDatosAlumno($args){
            $arrArgs = explode(',',$args);
            $matriculaRFC = $arrArgs[0];
            $idAlumno = $arrArgs[1];
            if($matriculaRFC != 'null'){
                $estatus = $this->model->selectStatusEstadoCuentaByMatrRFC($matriculaRFC);
                if(count($estatus) > 0){
                    $arrData['estatus'] = true;
                    $arrData['datos'] = $this->model->selectDatosAlumnoByMatriculaRFC($matriculaRFC);
                    $arrData['totalSaldo'] = $this->model->selectEdoCuentaByMatriculaRFC($matriculaRFC);
                    $total = 0;
                    $saldoServicios = 0;
                    $saldoColegiatura = 0;
                    foreach ($arrData['totalSaldo'] as $key => $value) {
                        if($value['fecha_pagado'] == ''){
                            $total += $value['precio_unitario'];
                            if($value['codigo_servicio'] == 'CM'){
                                $saldoColegiatura += $value['precio_unitario'];
                            }else{
                                $saldoServicios += $value['precio_unitario'];
                            }
                        }
                    }
                    $arrData['totalSaldo'] = $total;
                    $arrData['saldoServicios'] = $saldoServicios;
                    $arrData['saldoColegiaturas'] = $saldoColegiatura;
                }else{
                    $arrData['estatus'] = false;
                    $arrData['datos'] = null;
                }
            }else{
                $estatus = $this->model->selectStatusEstadoCuentaById($idAlumno);
                if(count($estatus) > 0){
                    $arrData['estatus'] = true;
                    $arrData['datos'] = $this->model->selectDatosAlumnoById($idAlumno);
                    $arrData['totalSaldo'] = $this->model->selectEdoCuentaById($idAlumno);
                    $total = 0;
                    $saldoServicios = 0;
                    $saldoColegiatura = 0;
                    foreach ($arrData['totalSaldo'] as $key => $value) {
                        if($value['fecha_pagado'] == ''){
                            $total += $value['precio_unitario'];
                            if($value['codigo_servicio'] == 'CM'){
                                $saldoColegiatura += $value['precio_unitario'];
                            }else{
                                $saldoServicios += $value['precio_unitario'];
                            }
                        }
                    }
                    $arrData['totalSaldo'] = $total;
                    $arrData['saldoServicios'] = $saldoServicios;
                    $arrData['saldoColegiaturas'] = $saldoColegiatura;
                }else{
                    $arrData['estatus'] = false;
                    $arrData['datos'] = null;
                }
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }

        //Buscar persona median el Modal
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
        //Obtener subconcepto
        protected function getSubConcepto($str){
            if(stristr($str,'COL')){
                $array = explode('.',$str);
                $anio = explode('-',$array[2]);
                return $array[1].'/'.$anio[0];
            }else{ return $str;}
        }
        protected function estadoCuenta($matriculaRFC,$idAlumno){
            if($matriculaRFC != 'null'){
                $arrData = $this->model->selectEdoCuentaByMatriculaRFC($matriculaRFC);
                $datosAlumno = $this->model->selectDatosAlumnoByMatriculaRFC($matriculaRFC);
            }else{
                $arrData = $this->model->selectEdoCuentaById($idAlumno);
                $datosAlumno = $this->model->selectDatosAlumnoById($idAlumno);
            }
            for ($i=0; $i<count($arrData); $i++){
                $arrData[$i]['numeracion'] = $i+1;
                $arrData[$i]['fecha'] = ($arrData[$i]['fecha_pago']== '')?'0000:00:00':$arrData[$i]['fecha_pago'];
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
                $params = array('id'=>$arrData[$i]['id'],'id_alumno'=>$datosAlumno['id'],'nombre_completo'=>$datosAlumno['nombre_persona'].' '.$datosAlumno['ap_paterno'].' '.$datosAlumno['ap_materno'],'nombre_servicio'=>$arrData[$i]['descripcion'],'pu'=>$arrData[$i]['precio_unitario'],'tipo'=>($arrData[$i]['codigo_servicio'] == 'CM')?'col':'serv');
                $params = json_encode($params);
                $params64 = base64_encode($params);
                $arrData[$i]['options'] = ($arrData[$i]['fecha_pago'] == '')?'<div class="text-center"><a type="button" class="btn btn-primary btn-xs" href="'.BASE_URL.'/Ingresos/ingresos?d='.$params64.'">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspCobrar&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</a></div>':'<div class="text-center">
				<div class="btn-group">
                    <button type="button" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-layer-group"></i> &nbsp; Acciones
                    </button>
					<div class="dropdown-menu">
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal" id="'.$arrData[$i]['id'].'" onclick="fnReimprimirComprobante(this)"> &nbsp;&nbsp; 
                            <i class="fas fa-print"></i> &nbsp; Reimprimir recibo
                        </button>
                        <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal" id="'.$arrData[$i]['folio'].'"  onClick="fnFacturarVenta(this)"> &nbsp;&nbsp; 
                            <i class="fas fa-file-invoice"></i> &nbsp; Factutrar
                        </button>
						<div class="dropdown-divider">
                        </div>
						    <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal" id="'.$arrData[$i]['folio'].'" onClick="fnCancelarVenta(this)"> &nbsp;&nbsp; <i class="fas fa-ban "></i> &nbsp; Cancelar
                            </button>
					</div>
				</div>
				</div>';
            }
            return $arrData;
        }
    }
?>