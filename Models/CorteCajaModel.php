<?php
	class CorteCajaModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}
        public function selectCorteActual(){
            $sql = "SELECT *FROM t_corte_caja";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectCajeros(){
            $sql = "SELECT c.id AS id_caja,p.id AS id_persona,p.nombre_persona,p.ap_paterno,p.ap_materno FROM t_cajas AS c
            INNER JOIN t_personas AS p ON c.id_usuario_atiende = p.id";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectCaja(int $idCaja){
            $sql = "SELECT *FROM t_cajas WHERE id = $idCaja";
            $request = $this->select($sql);
            return $request;
        }
        public function estatusCaja(int $idCaja){
            return $idCaja;
        }
	}
?>  