<?php
	class IngresosModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}
		//Funcion para consultar lista de Estudiantes
		/* public function selectEstudiantes(){
			$sql = "SELECT ins.id,per.id AS id_persona,per.nombre_persona,CONCAT(per.ap_paterno,'&nbsp',per.ap_materno) AS apellidos,
            plante.nombre_plantel,plante.municipio,planest.nombre_carrera,ins.grado,sal.nombre_salon,per.validacion_doctos,per.validacion_datos_personales,per.id_usuario_verificacion_doctos,per.id_usuario_verificacion_datos_personales FROM t_inscripciones AS ins
            LEFT JOIN t_historiales AS his ON ins.id_historial = his.id
            INNER JOIN t_personas AS per ON ins.id_personas = per.id
            INNER JOIN t_plan_estudios AS planest ON ins.id_plan_estudios = planest.id
            INNER JOIN t_planteles AS plante ON planest.id_plantel = plante.id
            LEFT JOIN t_salones AS sal ON ins.id_salon = sal.id
            WHERE his.inscrito = 1";
			$request = $this->select_all($sql);
			return $request;
		} */
        public function selectIngresos(){
            $sql = "SELECT *FROM t_ingresos";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectPersonasModal($data){
            $sql = "SELECT per.id,CONCAT(per.nombre_persona,' ',per.ap_paterno,' ',per.ap_materno) AS nombre,
            ins.id AS id_inscripcion,pln.nombre_carrera,ins.grado,ins.id_salon,gr.nombre_grupo FROM t_personas AS per
            LEFT JOIN t_inscripciones AS ins ON ins.id_personas = per.id
            LEFT JOIN t_historiales AS his ON ins.id_historial = his.id
            INNER JOIN t_plan_estudios AS pln ON ins.id_plan_estudios = pln.id
            INNER JOIN t_salonescompletos AS sal ON ins.id_salon = sal.id
            INNER JOIN t_grupos AS gr ON sal.id_grado = gr.id
            WHERE CONCAT(per.nombre_persona,' ',per.ap_paterno,' ',per.ap_materno) LIKE '%$data%'";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectStatusEstadoCuenta(int $idPersonaSeleccionada){
            $sql = "SELECT *FROM t_ingresos WHERE id_persona = $idPersonaSeleccionada";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectServicios(){
            $sql = "SELECT *FROM t_servicios";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selecPromociones(int $idServicio){
            $sql = "SELECT *FROM t_servicios AS ser INNER JOIN t_promociones AS prom ON prom.id_servicio = ser.id WHERE ser.id = $idServicio";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectPlantelAlumno(int $idPersonaSeleccionada){
            $sql = "SELECT plte.id FROM t_inscripciones AS ins
            INNER JOIN t_plan_estudios AS plnest ON ins.id_plan_estudios = plnest.id
            INNER JOIN t_planteles AS plte ON plnest.id_plantel = plte.id WHERE ins.id_personas = $idPersonaSeleccionada LIMIT 1";
            $request = $this->select($sql);
            return $request;
        }
        public function generarEdoCuentaAlumno(int $idPersonaSeleccionada,int $idPlantel){
            $idUser = $_SESSION['idUser'];
            $sql = "INSERT INTO t_ingresos(estatus,id_plantel,id_persona,id_usuario) VALUES(?,?,?,?)";
            $request = $this->insert($sql,array(1,$idPlantel,$idPersonaSeleccionada,$idUser));
            return $request;
        }
	}
?>  