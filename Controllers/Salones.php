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
        $data['periodo'] = $this->model->selectPeriodo();
        $data['grado'] = $this->model->selectGrado();
        $data['grupo'] = $this->model->selectGrupo();
        $data['page_functions_js'] = 'functions_salones.js';
        $this->views->getView($this,'salon',$data);
    }

    public function getSalones()
    {
        $arrData = $this->model->selectSalones();
        for($i=0; $i<count($arrData); $i++)
        {
            if($arrData[$i]['estatus'] ==1)
            {
                $arrData[$i]['estatus'] = '<span class="badge badge-dark">Activo</span>';
            }
            else
            {
                $arrData[$i]['estatus'] = '<span class="badge badge-secondary">Inactivo</span>';
            }
        }
        echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
    }
}
?>