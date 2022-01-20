<?php
	class ConsultasIngresosEgresosModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}
		public function selectEdoCuenta($str){
			$datosAlumno = $str;
			$sql = "SELECT ing.id,s.codigo_servicio,s.nombre_servicio,ing.folio,p.descripcion,ing.observaciones,ingdet.abono,ingdet.cargo,s.precio_unitario,p.fecha AS fecha_pago,
			ing.fecha AS fecha_pagado,ingdet.cantidad,ing.tipo_comprobante FROM t_ingresos AS ing 
			INNER JOIN t_personas AS per ON ing.id_persona = per.id
			LEFT JOIN t_datos_fiscales AS dfis ON per.id_datos_fiscales = dfis.id
			INNER JOIN t_inscripciones AS ins ON ins.id_personas = per.id
			INNER JOIN t_historiales AS his ON ins.id_historial = his.id
			INNER JOIN t_ingresos_detalles AS ingdet ON ingdet.id_ingresos = ing.id
			LEFT JOIN t_precarga_cuenta AS p ON ingdet.id_precarga_cuenta = p.id
			INNER JOIN t_servicios AS s ON ingdet.id_servicio = s.id
			WHERE dfis.rfc = '$str' OR his.matricula_interna = '$str' AND s.aplica_edo_cuenta = 1";
			$request = $this->select_all($sql);
			return $request;
		}
		public function selectDatosAlumno($str){
			$sql = "SELECT p.id,p.nombre_persona,p.ap_paterno,p.ap_materno,h.matricula_interna,pl.nombre_sistema,
			pl.nombre_plantel,pe.nombre_carrera,pl.categoria,pl.cve_centro_trabajo,pl.domicilio,pl.cod_postal,pl.colonia,
			pl.localidad,pl.municipio,pl.estado,pr.nombre_periodo,p.tel_celular,p.email,sc.nombre_salon FROM t_inscripciones AS i
			INNER JOIN t_historiales AS h ON i.id_historial = h.id
			INNER JOIN t_personas AS p ON i.id_personas = p.id
			INNER JOIN t_plan_estudios AS pe ON i.id_plan_estudios = pe.id
			INNER JOIN t_planteles AS pl ON pe.id_plantel = pl.id
			INNER JOIN t_salones_compuesto AS sc ON i.id_salon_compuesto = sc.id
			INNER JOIN t_periodos AS pr ON sc.id_periodo = pr.id
			WHERE h.matricula_interna = $str";
			$request = $this->select($sql);
			return $request;
		}
		public function selectPersonasModal($data){
            $sql = "SELECT per.id,CONCAT(per.nombre_persona,' ',per.ap_paterno,' ',per.ap_materno) AS nombre,
            ins.id AS id_inscripcion,his.matricula_interna,df.rfc FROM t_personas AS per
            RIGHT JOIN t_inscripciones AS ins ON ins.id_personas = per.id
            LEFT JOIN t_historiales AS his ON ins.id_historial = his.id
            LEFT join t_datos_fiscales AS df ON per.id_datos_fiscales = df.id
            WHERE CONCAT(per.nombre_persona,' ',per.ap_paterno,' ',per.ap_materno) LIKE '%$data%'";
            $request = $this->select_all($sql);
            return $request;
        }
	}
?>