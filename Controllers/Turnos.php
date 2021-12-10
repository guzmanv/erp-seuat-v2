<?php
class Turnos extends Controllers{
    public function __construct()
    {
        parent::__construct();
    }

    public function turno()
    {
        $data['page_tag'] = 'Turnos';
        $data['page_name'] = 'Turnos';
        $data['page_title'] = 'Turnos';
        $data['page_functions_js'] = 'functions_turnos.js';
        $this->views->getView($this,'turnos',$data);
    }

    public function getTurnos()
    {
        $arrData = $this->model->selectTurnos();
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
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnEditSalon" data-toggle="modal" data-target="#ModalEditSalon" title="Editar"> &nbsp;&nbsp; <i class="fas fa-pencil-alt"></i> &nbsp; Editar</button>
						<div class="dropdown-divider"></div>
						<button class="dropdown-item btn btn-outline-secondary btn-sm btn-flat icono-color-principal btnDelSalon" title="Eliminar"> &nbsp;&nbsp; <i class="far fa-trash-alt "></i> &nbsp; Eliminar</button>
						<!--<a class="dropdown-item" href="#">link</a>-->
				</div>
            </div>

            </div>';
        }
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
    }

    public function setTurnos($acc)
    {
        $tipo = $acc;
        if($tipo == "new")
        {
            $intIdTurno = intval($_POST['idTurnoNuevo']);
            $strNombreTurno = strClean($_POST['txtTurnoNuevo']);
            $strAbreviatura = strClean($_POST['txtAbreviatura']);
            $strHoraEnt = $_POST['txtHoraEnt'];
            $strHoraSal = $_POST['txtHoraSal'];

        }
    }
}
?>