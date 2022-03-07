<?php
    class SeguimientoCajasModel extends Mysql{
        public function __construct(){
            parent::__construct();
        }
        public function selectCajeros(){
            $sql = "SELECT ca.id AS id_caja, us.id AS id_usuario, per.id AS id_persona,ca.nombre AS nombre_caja,
            pl.nombre_plantel, pl.nombre_sistema,per.nombre_persona,per.ap_paterno,per.ap_materno,ec.estatus_caja FROM t_cajas AS ca 
            INNER JOIN t_usuarios AS us ON ca.id_usuario_atiende = us.id
            INNER JOIN t_planteles AS pl ON ca.id_plantel = pl.id
            INNER JOIN t_personas AS per ON us.id_persona = per.id
            INNER JOIN t_estatus_caja AS ec ON ec.id_caja = ca.id";
            $request = $this->select_all($sql);
            return $request;
        }
    }

?>