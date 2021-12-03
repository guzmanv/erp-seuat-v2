<?php
class Salones extends Controllers{
    public function __construct()
    {
        parent::__construct();
    }

    public function salon(){
        $data['page_tag'] = 'Salones';
        $data['page_title'] = 'Salones';
        $data['data_name'] = 'Salones';
        $data['page_functions_js'] = 'functions_salones.js';
        $this->views->getView($this,'salon',$data);
    }

    public function getSalones()
    {
        $arrData = $this->model->selectSalones();
        for($i=0; $i<count($arrData); $i++)
        {
            $arrData[$i]['options'] = '<div class="text-center">
            <div class="btn-group">
                <button type="" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-layer-group"></i> &nbsp; Acciones
                </button>
                <div class="dropdown-menu">
                        <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnVerMateria"  data-toggle="modal" data-target="#ModalFormVerMateria" title="Ver"> &nbsp;&nbsp; <i class="fas fa-eye icono-azul"></i> &nbsp; Ver</button>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditMateria"  data-toggle="modal" data-target="#ModalFormEditMateria" title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>
						<div class="dropdown-divider"></div>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelMateria"  title="Eliminar"> &nbsp;&nbsp; <i class="far fa-trash-alt "></i> &nbsp; Eliminar</button>
						<!--<a class="dropdown-item" href="#">link</a>-->
				</div>
            </div>

            </div>';
        }
        echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
    }

    //Nuevo salón
    public function setSalon()
    {
        $intIdSalon = intval($_POST['idSalonNuevo']);
        $strNombreSalon = strClean($_POST['txtNombreNuevo']);
        $strCantidadMax = intval($_POST['txtCantidadMax']);

        if($intIdSalon == 0)
        {
            $requestSalon = $this->model->insertSalon($strNombreSalon, $strCantidadMax);
            $option = 1;
        }
        else
        {
            $requestSalon = $this->model->updateSalon($intIdSalon, $strNombreSalon, $strCantidadMax);
            $option = 2;
        }

        if($requestSalon > 0){
            if($option == 1)
            {
                $arrResponse = array('estatus' => true, 'msg' => 'Datos guardados correctamente');
            }
            else
            {
                $arrResponse = array('estatus' => true, 'msg' => 'Datos actualizados correctamente');
            }
        }
        elseif($requestSalon == 'exist')
        {
            $arrResponse = array('estatus' => false, 'msg'=>'El salón existe');
        }
        else
        {
            $arrResponse = array('estatus' => false, 'msg' => 'No se puede almacenar los datos');
        }
        echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>