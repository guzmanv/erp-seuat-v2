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
}
?>