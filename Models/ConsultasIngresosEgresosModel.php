<?php
	class ConsultasIngresosEgresosModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}
		public function selectEdoCuenta($str){
			$datosAlumno = $str;
			$sql = "SELECT ing.id,ing.fecha,ing.folio,ing.observaciones,ingdet.abono,ingdet.cargo FROM t_ingresos AS ing 
			INNER JOIN t_personas AS per ON ing.id_persona = per.id
			INNER JOIN t_datos_fiscales AS dfis ON per.id_datos_fiscales = dfis.id
			INNER JOIN t_inscripciones AS ins ON ins.id_personas = per.id
			INNER JOIN t_historiales AS his ON ins.id_historial = his.id
			INNER JOIN t_ingresos_detalles AS ingdet ON ingdet.id_ingresos = ing.id
			WHERE CONCAT(per.nombre_persona,' ',per.ap_paterno,' ',per.ap_materno) LIKE '%$str%' OR dfis.rfc = '$str' OR his.matricula_interna = '$str'";
			$request = $this->select_all($sql);
			return $request;
		}
	}
?>