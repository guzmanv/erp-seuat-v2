<?php
	class Unidad_medida extends Controllers{
		public function __construct()
			{
				parent::__construct();
				session_start();
				if(empty($_SESSION['login']))
				{
					header('Location: '.base_url().'/login');
					die();
				}
			}

		public function Unidad_medida()
		{
			$data['page_tag'] = "Unidad de medida";
			$data['page_title'] = "Unidad de medida";
			$data['page_name'] = "unidad de medida";
			$data['page_functions_js'] = "functions_unidad_medida.js";
			$this->views->getView($this,"unidad_medida",$data);
		}
		
			public function getUnidad_medidas()
			{
				$arrData = $this->model->selectUnidad_medidas();

				for ($i=0; $i < count($arrData); $i++) {

					if($arrData[$i]['estatus'] == 1)
					{
						$arrData[$i]['estatus'] = '<span class="badge badge-dark">Activo</span>';
					}else{
						$arrData[$i]['estatus'] = '<span class="badge badge-secondary">Inactivo</span>';
					}

				
					$arrData[$i]['options'] = '
					<div class="text-center">
						<div class="btn-group">
							<button type="button" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-layer-group"></i> &nbsp; Acciones
							</button>
							<div class="dropdown-menu">
								<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditUnidadMedida" onClick="fntEditUnidad_medida(this,'.$arrData[$i]['id'].')" title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>
								<div class="dropdown-divider"></div>
								<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelUnidadMedida" onClick="fntDelUnidad_medida('.$arrData[$i]['id'].')" title="Eliminar"> &nbsp;&nbsp; <i class="far fa-trash-alt "></i> &nbsp; Eliminar</button>
							</div>
						</div>
					</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
				die();
			}



			public function setUnidad_medida()
			{
				if($_POST){
					if(empty($_POST['txtNombre_unidad_medida']) || empty($_POST['listEstatus'])){
						$arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
					}else{
						$intIdUnidad_medida = intval($_POST['idUnidad_medida']);
						$strNombre_unidad_medida = strClean($_POST['txtNombre_unidad_medida']);
						$intEstatus = intval($_POST['listEstatus']);
						$strFecha_creacion = date('Y-m-d H:i:s'); // strClean($_POST['txtFecha_creacion']);
						$strFecha_actualizacion = strClean($_POST['txtFecha_actualizacion']);
						$intId_usuario_creacion = intval($_POST['txtId_usuario_creacion']);
						$intId_usuario_actualizacion = intval($_POST['txtId_usuario_actualizacion']);

						if($intIdUnidad_medida == 0){
							$request_unidad_medida = $this->model->insertUnidad_medida( $strNombre_unidad_medida,
																											$intEstatus,
																											$intId_usuario_creacion, 
																											$intId_usuario_actualizacion, 
																											$strFecha_creacion, 
																											$strFecha_actualizacion);
																											$option = 1;
						}
							
						if($request_unidad_medida > 0 ){
							if($option == 1){
								$arrResponse = array('estatus' => true, 'msg' => 'Datos guardados correctamente.');
							}

						}else if($request_unidad_medida == 'exist'){
							
							$arrResponse = array('estatus' => false, 'msg' => '¡Atención! el nombre de la unidad de medida ya existe.');
						}else{
							$arrResponse = array("estatus" => false, "msg" => 'No es posible almacenar los datos.');
						}
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
				die();
			}


			public function getUnidad_medida($id){
			//if($_SESSION['permisosMod']['r']){
				$intIdUnidad_medida = intval(strClean($id));
				if($intIdUnidad_medida > 0)
				{
					$arrData = $this->model->selectUnidad_medida($intIdUnidad_medida);
					if(empty($arrData))
					{
						$arrResponse = array('estatus' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrResponse = array('estatus' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			//}
			die();
		}


		public function setUnidad_medida_up()
		{
			if($_POST)
			{ //dep ($_POST); die();
			//if($_SESSION['permisosMod']['w']){
					if(empty($_POST['txtNombre_unidad_medidaup']) || empty($_POST['listEstatusup']) || empty($_POST['txtId_usuario_actualizacionup']))
					{
						$arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
					}else{
						$intIdUnidad_medida = intval($_POST['idUnidad_medidaup']);
						$strNombre_unidad_medida =  strClean($_POST['txtNombre_unidad_medidaup']);
						$intEstatus = intval($_POST['listEstatusup']);
						$strFecha_actualizacion = strClean($_POST['txtFecha_actualizacionup']);
						$intId_usuario_actualizacion = intval($_POST['txtId_usuario_actualizacionup']);
						$request_unidad_medida = "";

							if($intIdUnidad_medida <> 0)
							{
								$request_unidad_medida = $this->model->updateUnidad_medida($intIdUnidad_medida, 
																												$strNombre_unidad_medida, 
																												$intEstatus, 
																												$strFecha_actualizacion, 
																												$intId_usuario_actualizacion);
																												$option = 1;
							}

							if($request_unidad_medida > 0 )
							{
								if($option == 1)
								{
										$arrResponse = array('estatus' => true, 'msg' => 'Datos actualizados correctamente.');
								}
							}else{
									$arrResponse = array("estatus" => false, "msg" => 'No es posible actualizar los datos, probablemente existe un registro con el mismo nombre o presenta algún problema con la red.');
							}
						}	
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			 //}
			}
			die();
		}


		public function delUnidad_medida()
			{
				if($_POST)
				{
					//if($_SESSION['permisosMod']['d']){ 
						$intIdUnidad_medida = intval($_POST['idUnidad_medida']);
						$requestDelete = $this->model->deleteUnidad_medida($intIdUnidad_medida);
						if($requestDelete == 'ok')
						{
							$arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado la unidad de medida correctamente.');
						}else if($requestDelete == 'exist'){
							$arrResponse = array('estatus' => false, 'msg' => 'No es posible eliminar una unidad de medida asociado a un servicio activo.');
						}else{
							$arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar la unidad de medida.');
						}
						echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
					//}
				}
				die();
			}	

		
	}
?>