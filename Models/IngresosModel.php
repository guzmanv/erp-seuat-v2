<?php
	class IngresosModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}
        //Lista de ingresos
        public function selectIngresos(){
            $sql = "SELECT *FROM t_ingresos";
            $request = $this->select_all($sql);
            return $request;
        }
        //Obtener datos persona
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
        //Obtener estatus del estado de cuenta
        public function selectStatusEstadoCuenta(int $idPersonaSeleccionada){
            $sql = "SELECT *FROM t_ingresos WHERE id_persona = $idPersonaSeleccionada";
            $request = $this->select_all($sql);
            return $request;
        }
        //Obtener lista de Servicios
        public function selectServicios(){
            $sql = "SELECT *FROM t_servicios WHERE colegiatura = 0";
            $request = $this->select_all($sql);
            return $request;
        }
        //Obtener lista de Colegiaturas
        public function selectColegiaturas(int $idPersona){
            $sql = "SELECT i.id AS id_ingresos,id.id AS id_ingresos_detalles,id.id_servicio,s.nombre_servicio,s.precio_unitario,pc.descripcion,i.fecha FROM t_ingresos AS i 
            INNER JOIN t_ingresos_detalles AS id ON id.id_ingresos = i.id 
            INNER JOIN t_servicios AS s ON id.id_servicio = s.id
            INNER JOIN t_precarga_cuenta AS pc ON id.id_precarga_cuenta = pc.id
            WHERE i.id_persona = $idPersona AND pc.estatus = 1";
            $request = $this->select_all($sql);
            return $request;
        }
        //Lista de Promociones por Servicio
        public function selecPromociones(int $idServicio){
            $sql = "SELECT *FROM t_servicios AS ser INNER JOIN t_promociones AS prom ON prom.id_servicio = ser.id WHERE ser.id = $idServicio";
            $request = $this->select_all($sql);
            return $request;
        }
        //Obtener plantel del Alumno
        public function selectPlantelAlumno(int $idPersonaSeleccionada){
            $sql = "SELECT plte.id FROM t_inscripciones AS ins
            INNER JOIN t_plan_estudios AS plnest ON ins.id_plan_estudios = plnest.id
            INNER JOIN t_planteles AS plte ON plnest.id_plantel = plte.id WHERE ins.id_personas = $idPersonaSeleccionada LIMIT 1";
            $request = $this->select($sql);
            return $request;
        }
        //Obtener carrera del Alumno
        public function selectCarreraAlumno(int $idPersonaSeleccionada){
            $sql = "SELECT id_plan_estudios FROM t_inscripciones WHERE id_personas = $idPersonaSeleccionada LIMIT 1";
            $request = $this->select($sql);
            return $request;    
        }
        //Obtener grado del Alumno
        public function selectGradoAlumno(int $idPersonaSeleccionada){
            $sql = "SELECT grado FROM t_inscripciones WHERE id_personas = $idPersonaSeleccionada LIMIT 1";
            $request = $this->select($sql);
            return $request; 
        }
        //Obtener periodo del Alumno
        public function selectPeriodoAlumno(int $idPersonaSeleccionada){
            $sql = "SELECT ins.id_salon_compuesto,sc.id_periodo FROM t_inscripciones AS ins 
            INNER JOIN t_salones_compuesto AS sc ON ins.id_salon_compuesto = sc.id 
            WHERE ins.id_personas = $idPersonaSeleccionada LIMIT 1";
            $request = $this->select($sql);
            return $request; 
        }
        //Obtener datos para generar un estado de cuenta
        public function generarEdoCuentaAlumno(int $idPersonaSeleccionada,int $idPlantel, int $idCarrera, int $idGrado, int $idPeriodo){
            $idUser = $_SESSION['idUser'];
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
            return $requestServicios;
        }
        //Actualizar ingresos
        public function updateIngresos($idIngreso,$tipoPago,$tipoComprobante,$observaciones,$folioNuevo,$total){
            $sql = "UPDATE t_ingresos SET fecha = NOW(),folio = ?,forma_pago = ?,tipo_comprobante = ?,total = ?,observaciones = ?,
            recibo_inscripcion = ? WHERE id= $idIngreso";
            $request = $this->update($sql,array($folioNuevo,$tipoPago,$tipoComprobante,$total,$observaciones,1));
            return $idIngreso;
        }
        //Actualizar ingresos detalles
        public function updateIngresosDetalles($idIngreso,$cantidad,$precioUnitario,$subtotal,$arrPromociones){
            $sql = "UPDATE t_ingresos_detalles SET cantidad = ? ,cargo = ?,abono = ?,saldo = ?,precio_subtotal = ?,promociones_aplicadas = ? WHERE id_ingresos = $idIngreso";
            $request = $this->update($sql,array($cantidad,$precioUnitario,$precioUnitario,$precioUnitario,$subtotal,$arrPromociones));
            return $request;
        }
        //Obtener el siguiente Folio
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
        //Obtener el Id del ingreso de un id Servicio e id Alumno
        public function checkIdIngreso(int $idServicio,int $idAlumno){    
            $sql = "SELECT i.id FROM t_ingresos AS i
            RIGHT JOIN t_ingresos_detalles AS id ON id.id_ingresos = i.id
            WHERE id.id_servicio = $idServicio AND i.id_persona = $idAlumno";
            $request = $this->select($sql);
            return $request;
        }
        //Insertar un nuevo Ingreso
        public function insertIngresos(string $folio,string $formaPago, string $tipoComprobante,int $total,string $observaciones,int $idAlumno){
            $sqlIngresos = "INSERT INTO t_ingresos(fecha,folio,estatus,forma_pago,tipo_comprobante,total,observaciones,recibo_inscripcion,id_plantel,id_persona,id_usuario) VALUES(NOW(),?,?,?,?,?,?,?,?,?,?)";
            $requestIngresos = $this->insert($sqlIngresos,array($folio,1,$formaPago,$tipoComprobante,$total,$observaciones,1,2,$idAlumno,1));
            return $requestIngresos;
        }
        //Insertar un nuevo ingreso detalle
        public function insertIngresosDetalle(int $cantidad,int $cargo,int $abono,int $saldo,int $precioSubtotal,int $descuentoDinero,int $descuentoPorcentaje,string $promocionesAplicadas,int $idServicio,int $idIngreso){
            $sqlIngDetalle = "INSERT INTO t_ingresos_detalles(cantidad,cargo,abono,saldo,precio_subtotal,descuento_dinero,descuento_porcentaje,promociones_aplicadas,id_servicio,id_ingresos) VALUES(?,?,?,?,?,?,?,?,?,?)";
            $requestIngDetalle = $this->insert($sqlIngDetalle,array($cantidad,$cargo,$abono,$saldo,$precioSubtotal,$descuentoDinero,$descuentoPorcentaje,$promocionesAplicadas,$idServicio,$idIngreso));
            return $requestIngDetalle;
        }

	}
?>  