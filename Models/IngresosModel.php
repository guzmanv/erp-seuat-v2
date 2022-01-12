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
            ins.id AS id_inscripcion,pln.nombre_carrera,ins.grado,ins.id_salon_compuesto,gr.nombre_grupo FROM t_personas AS per
            LEFT JOIN t_inscripciones AS ins ON ins.id_personas = per.id
            LEFT JOIN t_historiales AS his ON ins.id_historial = his.id
            INNER JOIN t_plan_estudios AS pln ON ins.id_plan_estudios = pln.id
            INNER JOIN t_salones_compuesto AS sal ON ins.id_salon_compuesto = sal.id
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
            $sql = "SELECT *FROM t_servicios WHERE colegiatura = 0";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectColegiaturas(int $idPersona){
            $sql = "SELECT i.id AS id_ingresos,id.id AS id_ingresos_detalles,id.id_servicio,s.nombre_servicio,s.precio_unitario,pc.descripcion,i.fecha FROM t_ingresos AS i 
            INNER JOIN t_ingresos_detalles AS id ON id.id_ingresos = i.id 
            INNER JOIN t_servicios AS s ON id.id_servicio = s.id
            INNER JOIN t_precarga_cuenta AS pc ON id.id_precarga_cuenta = pc.id
            WHERE i.id_persona = $idPersona AND pc.estatus = 1";
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
        public function selectCarreraAlumno(int $idPersonaSeleccionada){
            $sql = "SELECT id_plan_estudios FROM t_inscripciones WHERE id_personas = $idPersonaSeleccionada LIMIT 1";
            $request = $this->select($sql);
            return $request;    
        }
        public function selectGradoAlumno(int $idPersonaSeleccionada){
            $sql = "SELECT grado FROM t_inscripciones WHERE id_personas = $idPersonaSeleccionada LIMIT 1";
            $request = $this->select($sql);
            return $request; 
        }
        public function selectPeriodoAlumno(int $idPersonaSeleccionada){
            $sql = "SELECT ins.id_salon_compuesto,sc.id_periodo FROM t_inscripciones AS ins 
            INNER JOIN t_salones_compuesto AS sc ON ins.id_salon_compuesto = sc.id 
            WHERE ins.id_personas = $idPersonaSeleccionada LIMIT 1";
            $request = $this->select($sql);
            return $request; 
        }
        public function generarEdoCuentaAlumno(int $idPersonaSeleccionada,int $idPlantel, int $idCarrera, int $idGrado, int $idPeriodo){
            $idUser = $_SESSION['idUser'];
            //setlocale(LC_TIME, "spanish");
            //$strMesActual = strftime("%B");
            /* $listaMeses = array('01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>'Junio','07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre');
            $intAnioActual = strftime("%Y");
            $intMesActual = strftime("%m");
            $fechaF = $intAnioActual+1;
            $fechaInicial = "";
            $fechaFinal = "";
            switch ($intMesActual) {
                case 1:
                case 2:
                case 3:
                case 4:
                case 5:
                case 6:
                    $fechaInicial = new DateTime($intAnioActual.'-01-01');
                    $fechaFinal = new DateTime($intAnioActual.'-12-01');
                    break;
                
                default:
                    $fechaInicial = new DateTime($intAnioActual.'-09-01');
                    $fechaFinal = new DateTime($fechaF.'-08-01');
                    break;
            }
            $fechaFinal = $fechaFinal->modify( '+1 month' );
            $intervalo = DateInterval::createFromDateString('1 month');
            $periodo = new DatePeriod($fechaInicial, $intervalo, $fechaFinal);
            $meses = 0;
            $meses_str = [];
            $soloMeses = [];
            foreach($periodo as $mes) {
                array_push($meses_str,$mes->format("Y/m/d"));
                array_push($soloMeses,$listaMeses[$mes->format("m")]);
                $meses++;
            } */
            $sqlServicios = "SELECT id,codigo_servicio,nombre_servicio FROM t_servicios WHERE aplica_edo_cuenta = 1 AND id_plantel = $idPlantel";
            $requestServicios = $this->select_all($sqlServicios);
            if($requestServicios){
                foreach ($requestServicios as $key => $servicio) {
                    $idServicio = $servicio['id'];
                    if($servicio['codigo_servicio'] == 'CM'){
                        $sqlColegiaturas = "SELECT *FROM t_precarga_cuenta AS prc WHERE prc.id_periodo = $idPeriodo AND prc.id_plan_estudios = $idCarrera AND prc.id_servicio = $idServicio AND prc.id_grado = $idGrado AND prc.estatus = 1 ORDER BY prc.fecha ASC";
                        $requestColegiaturas = $this->select_all($sqlColegiaturas);
                        foreach ($requestColegiaturas as $key => $colegiatura) {
                            //$observacion = 'coleg. '.$mes;
                            $sqlIngresos = "INSERT INTO t_ingresos(estatus,id_plantel,id_persona,id_usuario) VALUES(?,?,?,?)";
                            $requestIngresos = $this->insert($sqlIngresos,array(1,$idPlantel,$idPersonaSeleccionada,$idUser));
                            if($requestIngresos){
                                $sqlIngresosDetalle = "INSERT INTO t_ingresos_detalles(descuento_dinero,descuento_porcentaje,id_servicio,id_ingresos) VALUES(?,?,?,?)";
                                $requestIngresosDetalle = $this->insert($sqlIngresosDetalle,array(0,'0',$idServicio,$requestIngresos));
                            }
                        }
                    }else{
                        $observacion = $servicio['nombre_servicio'];
                        $sqlIngresos = "INSERT INTO t_ingresos(estatus,id_plantel,id_persona,id_usuario) VALUES(?,?,?,?)";
                        $requestIngresos = $this->insert($sqlIngresos,array(1,$idPlantel,$idPersonaSeleccionada,$idUser));
                        if($requestIngresos){
                            $sqlIngresosDetalle = "INSERT INTO t_ingresos_detalles(descuento_dinero,descuento_porcentaje,id_servicio,id_ingresos) VALUES(?,?,?,?)";
                            $requestIngresosDetalle = $this->insert($sqlIngresosDetalle,array(0,'0',$idServicio,$requestIngresos));
                        }

                    }
                }
            }
            //return $requestIngresosDetalle;
            return $requestServicios;
        }
        public function updateIngresos($idIngreso,$tipoPago,$tipoComprobante,$observaciones,$folioNuevo,$total){
            $sql = "UPDATE t_ingresos SET fecha = NOW(),folio = ?,forma_pago = ?,tipo_comprobante = ?,total = ?,observaciones = ?,
            recibo_inscripcion = ? WHERE id= $idIngreso";
            $request = $this->update($sql,array($folioNuevo,$tipoPago,$tipoComprobante,$total,$observaciones,1));
            //$request = $this->update($sql,array($folioNuevo,$tipoPago,$tipoComprobante,$total,$observaciones,1));
           /*  $total = 0;
            foreach ($arrDate as $key => $value) {
                $total += $value->subtotal;
            }
            if($total > 0){
                $sql = "UPDATE t_ingresos SET fecha = NOW(),folio = ?,forma_pago = ?,tipo_comprobante = ?,total = ?,observaciones = ?,
                recibo_inscripcion = ? WHERE id= $idIngreso";
                //$request = $this->update($sql,array($folioNuevo,$tipoPago,$tipoComprobante,$total,$observaciones,1));
            } */
            return $request;
        }
        public function updateIngresosDetalles($idIngreso,$cantidad,$precioUnitario,$subtotal,$arrPromociones){
            $sql = "UPDATE t_ingresos_detalles SET cantidad = ? ,cargo = ?,abono = ?,saldo = ?,precio_subtotal = ?,promociones_aplicadas = ? WHERE id_ingresos = $idIngreso";
            $request = $this->update($sql,array($cantidad,$precioUnitario,$precioUnitario,$precioUnitario,$subtotal,$arrPromociones));
            return $request;
        }
        public function selectFolioSig(int $idAlumno){
            $sqlPlantel = "SELECT pl.id AS id_plantel,pl.abreviacion_plantel,pl.abreviacion_sistema,pl.codigo_plantel  FROM t_personas AS p
            INNER JOIN t_inscripciones AS i ON i.id_personas = p.id
            INNER JOIN t_plan_estudios AS ple ON i.id_plan_estudios = ple.id
            INNER JOIN t_planteles AS pl ON ple.id_plantel = pl.id
            WHERE p.id = $idAlumno LIMIT 1";
            $requestPlantel = $this->select($sqlPlantel);
            $codigoPlantel = $requestPlantel['codigo_plantel'];

            $sqlFolioCosecutivo = "SELECT COUNT(folio) AS num_folios FROM  t_ingresos WHERE folio LIKE '%$codigoPlantel%'";
            $requestFolioConsecutivo = $this->select($sqlFolioCosecutivo);
            $cantidadFolios = $requestFolioConsecutivo['num_folios'];
            $nuevoFolio = $cantidadFolios+1;
            $nuevoFolioConsecutivo = $codigoPlantel.'IN'.date("mY").substr(str_repeat(0,4).$nuevoFolio,-4);

            return $nuevoFolioConsecutivo;
        }

	}
?>  