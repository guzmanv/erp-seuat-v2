<?php
	class CorteCaja extends Controllers{
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

		public function cortecaja()
		{
			$data['page_id'] = 2;
			$data['page_tag'] = "Corte caja";
			$data['page_title'] = "Corte caja";
			$data['page_name'] = "Corte caja";
			$data['page_functions_js'] = "functions_corte_caja.js";
			$data['corte_actual'] = count($this->model->selectCorteActual())+1;
			$data['cajeros'] = $this->model->selectCajeros();
			$this->views->getView($this,"cortecaja",$data);
		}
		public function getCaja($idCaja){
			$arrData = $this->model->selectCaja($idCaja);
			if($arrData){
				$arrData['estatus'] = true;
				$arrData['fechayhora_apertura_caja'] = date('Y-m-d h:i:s A', strtotime($arrData['fechayhora_apertura_caja']));
				$arrData['fechayhora_actual'] = date('Y-m-d h:i:s A');
			}else{
				$arrData['estatus'] = false;
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}
		public function getTotalesMetodosPago(){
			$arrData = $this->model->selectTotalesMetodosPago();
			$array;
			for($i = 0; $i<count($arrData); $i++){
				$id_metodo_pago = $arrData[$i]['id_metodo_pago'];
				$total = $arrData[$i]['total'];
				if(!isset($array[$id_metodo_pago])){
					$array[$id_metodo_pago] = 0;
				}
				$array[$id_metodo_pago] += $total;
				
			}
			$arrayValue = [];
			foreach ($array as $key => $value) {
				$valores = array('id'=>$key,'metodo'=>$this->model->selectMetodoPago($key)['descripcion'],'total'=>$value);
				array_push($arrayValue,$valores);
			}
			$arrResponse['detalles'] = $arrData;
			$arrResponse['totales'] = $arrayValue;
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}
		public function getDetallesIngreso($idIngreso){
			$arrData = $this->model->selectDetalleIngreso($idIngreso);
			for($i = 0; $i<count($arrData); $i++){
				$arrData[$i]['codigo'] = ($arrData[$i]['codigo_servicio'] == '')?$arrData[$i]['codigo_servicio_precarga']:$arrData[$i]['codigo_servicio'];
				$arrData[$i]['nombre'] = ($arrData[$i]['nombre_servicio'] == '')?$arrData[$i]['nombre_servicio_precarga']:$arrData[$i]['nombre_servicio'];
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}
		public function setCorteCaja($arr){
			$array = explode(',',$arr);
			$id_caja = $array[0];
			$id_corte_caja = $array[1];
			$resCorteCaja = $this->model->updateCorteCaja($id_corte_caja);
			if($resCorteCaja){
				$resStatuscaja = $this->model->updateStatusCaja($id_caja);
			}
			echo json_encode($resStatuscaja,JSON_UNESCAPED_UNICODE);
			die();
		}
	}
?>