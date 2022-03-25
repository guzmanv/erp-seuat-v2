<?php

class PrecargaCuentaModel extends Mysql
{
   
    public $intIdPers;
    public function __construct()
    {
        parent::__construct();
    }
    public function selectPlanteles(){
        $sql = "SELECT *FROM t_planteles WHERE estatus = 1";
        $request = $this->select_all($sql);
        return $request;
    }
    public function selectPlanEstudios(){
        $sql = "SELECT pe.id,pl.nombre_plantel,pe.nombre_carrera,pl.id AS id_plantel FROM t_plan_estudios AS pe 
        INNER JOIN t_planteles AS pl ON pe.id_plantel = pl.id
        WHERE  pe.estatus = 1";
        $request = $this->select_all($sql);
        return $request;
    }
    public function selectPlanEstudiosByPlantel(int $idPlantel){
        $sql = "SELECT pe.id,pl.nombre_plantel,pe.nombre_carrera,pl.id AS id_plantel FROM t_plan_estudios AS pe 
        INNER JOIN t_planteles AS pl ON pe.id_plantel = pl.id
        WHERE  pe.estatus = 1 AND pe.id_plantel = $idPlantel";
        $request = $this->select_all($sql);
        return $request;
    }
    public function selectServicios(int $idPlantel){
        $sql = "SELECT s.id,s.nombre_servicio,s.codigo_servicio,s.precio_unitario,cs.nombre_categoria FROM t_servicios AS s
        INNER JOIN t_categoria_servicios AS cs ON s.id_categoria_servicio = cs.id WHERE s.aplica_edo_cuenta = 1 AND s.id_plantel = $idPlantel";
        $request = $this->select_all($sql);
        return $request;
    }

}
