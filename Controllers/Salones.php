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

    public function setSalon()
    {
        // $data = $_POST;
        // $intIdSalonNuevo = 0;
        // $intIdSalonEdit = 0;
        // if(isset($_POST['idSalonNuevo'])){
        //     $intIdSalonNuevo = intval($_POST['idSalonNuevo']);
        // }
        // if(isset($_POST['idEdit'])){
        //     $intIdSalonEdit = intval($_POST['idEdit']);
        // }

        // if($intIdSalonNuevo == 1)
        // {
        //     $arrData = $this->model->insertSalon($data);
        //     if($arrData['estatus'] != TRUE)
        //     {
        //         $arrResponse = array('estatus' => true, 'msg' => 'Datos guardados correctamente');
        //     }
        //     else
        //     {
        //         $arrResponse = array('estatus' => false, 'msg' => '¡Atención! el salón ya existe');
        //     }
        // }
        // if($intIdSalonEdit != 0){
        //     $arrData = $this->model->updateSalon($intIdSalonEdit,$data);
        //     if($arrData)
        //     {
        //         $arrResponse = array('estatus' => true, 'msg' => 'Datos actualizados correctamente');
        //     }
        //     else
        //     {
        //         $arrResponse = array('estatus' => false, 'msg' => 'No es posible actualizar los datos');
        //     }
        // }
        // echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        // die();
    }
}
?>