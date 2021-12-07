<?php
class Salones extends Controllers{
    public function __construct()
    {
        parent::__construct();
<<<<<<< HEAD

        session_start();
        if(empty($_SESSION['login']))
        {
            header('Location: '.base_url().'/Login');
            die();
=======
        if(empty($_SESSION['login']))
				{
					header('Location: '.base_url().'/login');
					die();
>>>>>>> a1086440155120b9fbaf70840dba93c48a670a23
        }
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
            if($arrData[$i]['estatus'] == 1)
            {
                $arrData[$i]['estatus'] = '<span class="badge badge-primary">Activo</span>';
            }
            else
            {
                $arrData[$i]['estatus'] = '<span class="badge badge-secondary">Inactivo</span>';
            }
            $arrData[$i]['options'] = '<div class="text-center">
            <div class="btn-group">
                <button type="" class="btn btn-outline-secondary btn-xs icono-color-principal dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-layer-group"></i> &nbsp; Acciones
                </button>
                <div class="dropdown-menu">
<<<<<<< HEAD
                        <button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditSalon"  onClick="fnEditSalon('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalEditSalon" title="Editar"> &nbsp;&nbsp; <i class="fas fa-eye icono-azul"></i> &nbsp; Editar</button>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelMateria"  title="Eliminar"> &nbsp;&nbsp; <i class="far fa-trash-alt "></i> &nbsp; Eliminar</button>
=======
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditSalon" onClick="fnEditarSalon('.$arrData[$i]['id'].')" data-toggle="modal" data-target="#ModalEditSalon" title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>
						<div class="dropdown-divider"></div>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelSalon" onClick="fnEliminarSalon('.$arrData[$i]['id'].')" title="Eliminar"> &nbsp;&nbsp; <i class="far fa-trash-alt "></i> &nbsp; Eliminar</button>
>>>>>>> a1086440155120b9fbaf70840dba93c48a670a23
						<!--<a class="dropdown-item" href="#">link</a>-->
				</div>
            </div>

            </div>';
        }
        echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
    }

    public function getSalon(int $idSalon)
<<<<<<< HEAD
    {
        $intIdSalon = intval(strClean($idSalon));
        if($intIdSalon > 0)
        {
            $arrData = $this->model->selectSalon($intIdSalon);
            if(empty($arrData))
            {
                $arrResponse = array('estatus' => false, 'msg' => 'Datos no encontrados');
            }
            else
            {
                $arrResponse = array('estatus' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    //Nuevo salón
    public function setSalon()
=======
>>>>>>> a1086440155120b9fbaf70840dba93c48a670a23
    {
        $intIdSln = intval(strClean($idSalon));
        if($intIdSln > 0)
        {
            $arrData = $this->model->selectSalon($intIdSln);
            if(empty($arrData))
            {
                $arrResponse = array('estatus' => false, 'Datos no encontrados');
            }
            else
            {
                $arrResponse = array('estatus' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
        die();
    }
    //Nuevo salón
    public function setSalon($tipo)
    {
        $tipoAc = $tipo;
        if($tipoAc == "new")
        {   $intIdSalon = intval($_POST['idSalonNuevo']);
            $strNombreSalon = strClean($_POST['txtNombreNuevo']);
            $strCantidadMax = intval($_POST['txtCantidadMax']);
            $requestSalon = $this->model->insertSalon($strNombreSalon, $strCantidadMax);
            if($requestSalon){
                $arrResponse = array('estatus' => true, 'msg' => 'Datos gaurdados correctamente');

            }else{
                $arrResponse = array('estatus' => false, 'msg' => 'No se pudo guardar');
            }
        }
        else
        {
            $intIdSalon = intval($_POST['idSalonEdit']);
            $strNombreSalon = strClean($_POST['txtNombreEdit']);
            $strCantidadMax = intval($_POST['txtCantidadMaxEdit']);
            $intEstatus = intval($_POST['slctEstatus']);
            $requestSalon = $this->model->updateSalon($intIdSalon, $strNombreSalon, $strCantidadMax, $intEstatus);
            if($requestSalon){
                $arrResponse = array('estatus' => true, 'msg' => 'Datos actualizados correctamente');

            }else{
                $arrResponse = array('estatus' => false, 'msg' => 'No se pudo actualizar');
            }

        }
        echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        die();
    }

    public function delSalon()
    {
        $idSln = $_GET['id'];
        $requestDelete = $this->model->deleteSalon($idSln);
        if($requestDelete == 'ok')
        {
            $arrResponse = array('estatus' => true, 'msg' => 'Se ha eliminado el salón');
        }
        else if($requestDelete == 'exist')
        {
            $arrResponse = array('estatus' => false, 'msg' => 'No se puede eliminar el salón');
        }
        else
        {
            $arrResponse = array('estatus' => false, 'msg' => 'Error al eliminar el salón');
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>