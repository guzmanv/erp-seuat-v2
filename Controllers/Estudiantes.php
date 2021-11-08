<?php
	class Estudiantes extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}
		//Funcion para la Vista de Estudiantes
		public function estudiantes()
		{
			$data['page_id'] = 0;
			$data['page_tag'] = "Estudiantes";
			$data['page_title'] = "Estudiantes";
			$data['page_name'] = "Estudiantes";
			$data['page_content'] = "";
			$data['page_functions_js'] = "functions_estudiantes.js";
			$this->views->getView($this,"estudiantes",$data);
		}
        public function getEstudiantes(){
            $arrData = $this->model->selectEstudiantes();
            for ($i=0; $i<count($arrData); $i++){
                $arrData[$i]['numeracion'] = $i+1;
                $arrData[$i]['nombre_plantel'] = $arrData[$i]['nombre_plantel'].' ('.$arrData[$i]['municipio'].')';
                if($arrData[$i]['validacion'] == 0){
                    $arrData[$i]['validacion'] = 'No validado';
                }else{
                    $arrData[$i]['validacion'] = 'Validado';
                }
                $arrData[$i]['options'] = '<div class="text-center">
				<div class="btn-group">
					<button type="button" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-layer-group"></i> &nbsp; Acciones
					</button>
					<div class="dropdown-menu">
						<!--<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditPlan" onClick="fntEditPlan('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalFormEditPlan" title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>-->
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal documentacionInscripcion" onClick="fntDocumentacionInscripcion('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalFormDocumentacion" title="Documentacion"> &nbsp;&nbsp; <i class="fas fa-copy"></i> &nbsp;Documentos</button>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal plataformasInscripcion" onClick="fntPlataformasInscripcion('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalFormPlataformasInscripcion" title="Plataformas"> &nbsp;&nbsp; <i class="fas fa-cat"></i> &nbsp;Tutores</button>
						<div class="dropdown-divider"></div>
						<!--<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelPlan" onClick="fntDelPlan('.$arrData[$i]['id'].')" title="Eliminar"> &nbsp;&nbsp; <i class="far fa-trash-alt "></i> &nbsp; Eliminar</button>-->
						<!--<a class="dropdown-item" href="#">link</a>-->
					</div>
				</div>
				</div>'; 
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function getDocumentacion(){
            $idInscripcion = $_GET['idIns'];
            $arrData = $this->model->selectDocumentacion($idInscripcion);
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
            die();
        }
    }
?>