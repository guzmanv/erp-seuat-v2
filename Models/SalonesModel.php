<?php
    class SalonesModel extends Mysql{
        public function __construct()
        {
            parent::__construct();
        }

        public function selectSalones()
        {
            $sql = "SELECT saln.id, saln.nombre_salon, saln.cantidadmax, saln.estatus, per.nombre_periodo , grad.nombre_grado , grup.nombre_grupo
            FROM t_salones as saln
            INNER JOIN t_periodos as per
            ON saln.id_periodo = per.id 
            INNER JOIN t_grados as grad
            ON saln.id_grado = grad.id
            INNER JOIN t_grupos as grup 
            On saln.id_grupo = grup.id ";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectPeriodo()
        {
            $sql = "SELECT * FROM t_periodos";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectGrado()
        {
            $sql = "SELECT * FROM t_grados";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectGrupo()
        {
            $sql = "SELECT * FROM t_grupos";
            $request = $this->select_all($sql);
            return $request;
        }
    }
?>