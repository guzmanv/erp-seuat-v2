<?php
	class Categoria_servicios extends Controllers
    {
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


			public function Categoria_servicios()
			{
							$data['page_tag'] = "Categoría de servicios";
							$data['page_title'] = "Categoría servicios";
							$data['page_name'] = "categoria_servicios";
							$data['page_functions_js'] = "functions_categoria_servicios.js";
							$this->views->getView($this,"categoria_servicios",$data);
			}


			public function getCategoria_servicios()
			{
				$arrData = $this->model->selectCategoria_servicios();

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
								<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditCategoria_servicios" onClick="fntEditCategoria_servicios(this,'.$arrData[$i]['id'].')" title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>
								<div class="dropdown-divider"></div>
								<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelCategoria_servicios" onClick="fntDelCategoria_servicios('.$arrData[$i]['id'].')" title="Eliminar"> &nbsp;&nbsp; <i class="far fa-trash-alt "></i> &nbsp; Eliminar</button>
							</div>
						</div>
					</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
				die();
			}
			

			public function getCategoria_servicio($id){
				//if($_SESSION['permisosMod']['r']){
					$intIdCategoria_servicios = intval(strClean($id)); //intval(strClean($idrol));
					if($intIdCategoria_servicios > 0)
					{
						$arrData = $this->model->selectCategoria_servicio($intIdCategoria_servicios);
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


			public function setCategoria_servicios(){
				if($_POST){
					if(($_POST['idCategoria_servicios'] == '') || ($_POST['txtClave_categoria'] == '')  || ($_POST['txtNombre_categoria'] == '') || ($_POST['listEstatus'] == '')){
						$arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
					}else{
						$intIdCategoria_servicios = intval($_POST['idCategoria_servicios']);
						$strClave_categoria = strClean($_POST['txtClave_categoria']);
						$strNombre_categoria =  strClean($_POST['txtNombre_categoria']);
						$intAplica_colegiatura = intVal($_POST['chk_aplica_colegiatura']);
						$intEstatus = intval($_POST['listEstatus']);
						if($intIdCategoria_servicios == 0){
							//Crear
							$request_categoria_servicios = $this->model->insertCategoria_servicios($strClave_categoria,$strNombre_categoria,$intAplica_colegiatura,$intEstatus,$_SESSION['idUser']);
							$arrResponse = $request_categoria_servicios;
							
						}

						/* if($request_categoria_servicios > 0 )
						{
							if($option == 1)
							{
								$arrResponse = array('estatus' => true, 'msg' => 'Datos guardados correctamente.');
							}
						}else if($request_categoria_servicios == 'exist'){
							
							$arrResponse = array('estatus' => false, 'msg' => '¡Atención! La categoría ya existe.');
						}else{
							$arrResponse = array("estatus" => false, "msg" => 'No es posible almacenar los datos.');
						} */
						//$arrResponse =  $request_categoria_servicios;
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				 //}
				}
				die();
			}


			public function setCategoria_servicios_up()
			{
				if($_POST)
				{ //dep ($_POST); die();
				//if($_SESSION['permisosMod']['w']){
						if(empty($_POST['txtNombre_categoriaup']) || empty($_POST['listEstatusup']) || empty($_POST['txtId_usuario_actualizacionup']))
						{
							$arrResponse = array("estatus" => false, "msg" => 'Datos incorrectos.');
						}else{
							$intIdCategoria_servicios = intval($_POST['idCategoria_serviciosup']);
							$strNombre_categoria =  strClean($_POST['txtNombre_categoriaup']);
							$intEstatus = intval($_POST['listEstatusup']);
							$strFecha_actualizacion = strClean($_POST['txtFecha_actualizacionup']);
							$intId_usuario_actualizacion = intval($_POST['txtId_usuario_actualizacionup']);
							$request_categoria_servicios = "";

								if($intIdCategoria_servicios <> 0)
								{
									$request_categoria_servicios = $this->model->updateCategoria_servicios($intIdCategoria_servicios, 
																											$strNombre_categoria, 
																											$intEstatus, 
																											$strFecha_actualizacion, 
																											$intId_usuario_actualizacion);
																											$option = 1;
								}

								if($request_categoria_servicios > 0 )
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


			public function delCategoria_servicios()
			{
				if($_POST)
				{
					//if($_SESSION['permisosMod']['d']){ 
						$intIdCategoria_servicios = intval($_POST['idCategoria_servicios']);
						$requestDelete = $this->model->deleteCategoria_servicios($intIdCategoria_servicios);
						if($requestDelete == 'ok')
						{
							$arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado la categoría correctamente.');
						}else if($requestDelete == 'exist'){
							$arrResponse = array('estatus' => false, 'msg' => 'No es posible eliminar una categoría asociado a un servicio activo.');
						}else{
							$arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar la categoría.');
						}
						echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
					//}
				}
				die();
			}	




		}
?>