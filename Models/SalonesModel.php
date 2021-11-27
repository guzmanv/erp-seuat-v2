<?php
    class SalonesModel extends Mysql{
        public function __construct()
        {
            parent::__construct();
        }

        public function selectSalones()
        {
            $sql = "SELECT id, nombre_salon, cantidad_max_estudiantes FROM t_salones";
            $request = $this->select_all($sql);
            return $request;
        }


        public function insertSalon($data){
            
        }
    }
?>