<?php
	class VentasDiaModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}


		public function selectVentasDia($fecha){
			$sql = "SELECT i.id, i.folio,i.fecha,i.total,i.id_persona FROM t_ingresos AS i
            WHERE i.fecha != '' AND i.fecha LIKE '$fecha%' ORDER BY i.fecha DESC";
			$request = $this->select_all($sql);
			return $request;
		}
        public function selectDatosAlumno(int $idAlumno){
            $sql = "SELECT p.id,p.nombre_persona,p.ap_paterno,p.ap_materno,pe.nombre_carrera,i.grado,
            pl.abreviacion_plantel,pl.abreviacion_sistema,pl.municipio FROM t_personas AS p
            INNER JOIN t_inscripciones AS i ON i.id_personas = p.id
            INNER JOIN t_plan_estudios AS pe ON i.id_plan_estudios = pe.id
            INNER JOIN t_planteles AS pl ON pe.id_plantel = pl.id
            WHERE p.id = $idAlumno AND i.tipo_ingreso = 'Inscripcion' LIMIT 1";
            $request = $this->select($sql);
            return $request;
        }
	}
?>