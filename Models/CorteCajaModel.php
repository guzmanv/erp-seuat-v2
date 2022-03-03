<?php
	class CorteCajaModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}
        public function selectCorteActual(){
            $sql = "SELECT *FROM t_corte_caja
            WHERE fechayhora_cierre_caja != ''";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectCajeros(){
            $sql = "SELECT c.id AS id_caja,p.id AS id_persona,p.nombre_persona,p.ap_paterno,p.ap_materno FROM t_cajas AS c
            INNER JOIN t_usuarios AS u ON c.id_usuario_atiende = u.id
            INNER JOIN t_personas AS p ON u.id_persona = p.id";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectCaja(int $idCaja){
            $sql = "SELECT c.id,c.nombre,ec.estatus_caja,cc.id AS id_corte_caja,cc.fechayhora_apertura_caja,cc.fechayhora_cierre_caja FROM t_cajas AS c 
            INNER JOIN t_estatus_caja AS ec ON ec.id_caja = c.id
            RIGHT JOIN t_corte_caja AS cc ON cc.id_caja = c.id
            WHERE c.id = $idCaja ORDER BY cc.fechayhora_apertura_caja DESC";
            $request = $this->select($sql);
            return $request;
        }
        public function estatusCaja(int $idCaja){
            return $idCaja;
        }
        public function selectTotalesMetodosPago(int $id_usuario){
            $sql = "SELECT i.id AS id_ingreso,i.id_usuario,i.id_metodo_pago,i.total,mp.descripcion,
            i.fecha,i.folio,CONCAT(p.nombre_persona,' ',p.ap_paterno,' ',p.ap_materno)AS nombre_persona FROM t_ingresos AS i
            INNER JOIN t_metodos_pago AS mp ON i.id_metodo_pago = mp.id
            INNER JOIN t_personas AS p ON i.id_persona = p.id
            WHERE i.id_usuario = $id_usuario";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectDetalleIngreso(int $idIngreso){
            $sql = "SELECT s.codigo_servicio AS codigo_servicio,sp.codigo_servicio AS codigo_servicio_precarga,s.nombre_servicio,sp.nombre_servicio AS nombre_servicio_precarga,
            idet.abono,i.folio,i.fecha,CONCAT(per.nombre_persona,' ',per.ap_paterno,' ',per.ap_materno) AS nombre_usuario  FROM t_ingresos_detalles AS idet 
            LEFT JOIN t_servicios AS s ON idet.id_servicio = s.id
            LEFT JOIN t_precarga AS p ON idet.id_precarga = p.id
            LEFT JOIN t_servicios AS sp ON p.id_servicio = sp.id
            LEFT JOIN t_ingresos AS i ON idet.id_ingresos = i.id
            INNER JOIN t_usuarios AS u ON i.id_usuario = u.id
            INNER JOIN t_personas AS per ON u.id_persona = per.id
            WHERE idet.id_ingresos = $idIngreso";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectMetodoPago(int $metodo){
            $sql = "SELECT descripcion FROM t_metodos_pago WHERE id = $metodo";
            $request = $this->select($sql);
            return $request;
        }
        public function updateCorteCaja(int $id_corte_caja){
            $sql = "UPDATE t_corte_caja SET fechayhora_cierre_caja = NOW() WHERE id = $id_corte_caja";
            $request = $this->update($sql,array());
            return $request;
        }
        public function updateStatusCaja(int $id_caja){
            $cantidad = 100;
            $sql = "UPDATE t_estatus_caja SET estatus_caja = ?,monto_caja = ? WHERE id_caja = $id_caja";
            $request = $this->update($sql,array(0,$cantidad));
            return $request;
        }
        public function selectIdUsuario(int $id_caja){
            $sql = "SELECT id_usuario_atiende FROM t_cajas WHERE id = $id_caja";
            $request = $this->select($sql);
            return $request;
        }
	}
?>  