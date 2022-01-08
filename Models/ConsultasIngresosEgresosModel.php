<?php
	class ConsultasIngresosEgresosModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}
		public function selectEdoCuenta($str){
			$datosAlumno = $str;
			$sql = "SELECT ing.id,s.codigo_servicio,s.nombre_servicio,ing.folio,p.descripcion,ing.observaciones,ingdet.abono,ingdet.cargo,p.fecha AS fecha_pago
			FROM t_ingresos AS ing 
			INNER JOIN t_personas AS per ON ing.id_persona = per.id
			LEFT JOIN t_datos_fiscales AS dfis ON per.id_datos_fiscales = dfis.id
			INNER JOIN t_inscripciones AS ins ON ins.id_personas = per.id
			INNER JOIN t_historiales AS his ON ins.id_historial = his.id
			INNER JOIN t_ingresos_detalles AS ingdet ON ingdet.id_ingresos = ing.id
			LEFT JOIN t_precarga_cuenta AS p ON ingdet.id_precarga_cuenta = p.id
			INNER JOIN t_servicios AS s ON ingdet.id_servicio = s.id
			WHERE dfis.rfc = '$str' OR his.matricula_interna = '$str'";
			$request = $this->select_all($sql);
			return $request;
		}
		/* public function selectEdoCuenta($str){
			$datosAlumno = $str;
			$sql = "SELECT ing.id,s.codigo_servicio,s.nombre_servicio,ing.folio,p.descripcion,ing.observaciones,ingdet.abono,ingdet.cargo,p.fecha AS fecha_pago
			FROM t_ingresos AS ing 
			INNER JOIN t_personas AS per ON ing.id_persona = per.id
			LEFT JOIN t_datos_fiscales AS dfis ON per.id_datos_fiscales = dfis.id
			INNER JOIN t_inscripciones AS ins ON ins.id_personas = per.id
			INNER JOIN t_historiales AS his ON ins.id_historial = his.id
			INNER JOIN t_ingresos_detalles AS ingdet ON ingdet.id_ingresos = ing.id
			LEFT JOIN t_precarga_cuenta AS p ON ingdet.id_precarga_cuenta = p.id
			INNER JOIN t_servicios AS s ON ingdet.id_servicio = s.id
			WHERE CONCAT(per.nombre_persona,' ',per.ap_paterno,' ',per.ap_materno) LIKE '%$str%' OR dfis.rfc = '$str' OR his.matricula_interna = '$str'";
			$request = $this->select_all($sql);
			return $request;
		} */
		public function selectDatosAlumno($str){
			$sql = "SELECT p.id,p.nombre_persona,p.ap_paterno,p.ap_materno FROM t_inscripciones AS i
			INNER JOIN t_historiales AS h ON i.id_historial = h.id
			INNER JOIN t_personas AS p ON i.id_personas = p.id
			WHERE h.matricula_interna = $str";
			$request = $this->select($sql);
			return $request;
		}
	}
?>