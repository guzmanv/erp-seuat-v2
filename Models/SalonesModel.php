<?php
    class SalonesModel extends Mysql{

        public $intIdSalon;
        public $strNombreSalon;
        public $intCantidadMax;

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

        public function getSalon(int $idSalon)
        {
            $sql = "SELECT * FROM t_salones WHERE id=$idSalon LIMIT 1";
            $request = $this->select($sql);
            return $request;
        }

        public function insertSalon(string $nombreSalon, string $cantidadMax)
        {
            $return = "";
            $this->strNombreSalon = $nombreSalon;
            $this->intCantidadMax = $cantidadMax;

            $sql = "SELECT * FROM t_salones WHERE nombre_salon = '{$this->strNombreSalon}'";
            $request = $this->select($sql);
            if(empty($request))
            {
                $query_insert = "INSERT INTO t_salones (nombre_salon, cantidad_max_estudiantes, estatus, fecha_creacion,id_usuario_creacion)
                VALUES(?,?,1,NOW(),1)";
                $arrData = array($this->strNombreSalon, $this->intCantidadMax);
                $request_insert = $this->insert($query_insert,$arrData);
                $return = $request_insert;
            }
            else
            {
                $return = "exist";
            }
            return $return;
        }

        public function updateSalon(int $idSalon, string $nombreSalon, string $cantidadMax)
        {
            $this->intIdSalon = $idSalon;
            $this->strNombreSalon = $nombreSalon;
            $this->intCantMax = $cantidadMax;
            $sql = "SELECT * FROM t_salones WHERE id=$this->intIdSalon";
            $request = $this->select($sql);
            if($request)
            {
                $sql = "UPDATE t_salones SET nombre_salon = ?, cantidad_max_estudiantes = ?, fecha_actualizacion = NOW() WHERE id = $this->intIdSalon";
                $arrData = array($this->strNombreSalon, $this->intCantMax);
                $request_update = $this->update($sql,$arrData);
            }
            else
            {
                $request_update = "not exist";
            }
            return $request_update;
        }
    }
?>