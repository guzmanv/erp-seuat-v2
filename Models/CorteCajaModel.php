<?php
	class CorteCajaModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}
        public function selectCorteActual(){
            $sql = "SELECT *FROM t_corte_caja
            WHERE fechayhora_cierre_caja != NULL";
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
            $sql = "SELECT c.id,c.nombre,ec.estatus_caja,cc.fechayhora_apertura_caja,cc.fechayhora_cierre_caja FROM t_cajas AS c 
            INNER JOIN t_estatus_caja AS ec ON ec.id_caja = c.id
            RIGHT JOIN t_corte_caja AS cc ON cc.id_caja = c.id
            WHERE c.id = $idCaja ORDER BY cc.fechayhora_apertura_caja DESC";
            $request = $this->select($sql);
            return $request;
        }
        public function estatusCaja(int $idCaja){
            return $idCaja;
        }
        public function selectTotalesMetodosPago(){
            $sql = "SELECT i.id AS id_ingreso,i.id_usuario,i.id_metodo_pago,i.total,mp.descripcion,
            i.fecha FROM t_ingresos AS i
            INNER JOIN t_metodos_pago AS mp ON i.id_metodo_pago = mp.id";
            $request = $this->select_all($sql);
            return $request;
        }
	}
?>  