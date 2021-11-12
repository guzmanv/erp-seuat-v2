<?php
	class EstudiantesModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}
		//Funcion para consultar lista de Estudiantes
		public function selectEstudiantes(){
			$sql = "SELECT ins.id,per.id AS id_persona,per.nombre_persona,CONCAT(per.ap_paterno,' ',per.ap_materno) AS apellidos,
            plante.nombre_plantel,plante.municipio,planest.nombre_carrera,ins.grado,sal.nombre_salon,per.validacion_doctos,per.validacion_datos_personales,per.id_usuario_verificacion_doctos,per.id_usuario_verificacion_datos_personales FROM t_inscripciones AS ins
            LEFT JOIN t_historiales AS his ON ins.id_historial = his.id
            INNER JOIN t_personas AS per ON ins.id_personas = per.id
            INNER JOIN t_plan_estudios AS planest ON ins.id_plan_estudios = planest.id
            INNER JOIN t_planteles AS plante ON planest.id_planteles = plante.id
            LEFT JOIN t_salones AS sal ON ins.id_salon = sal.id
            WHERE his.inscrito = 1";
			$request = $this->select_all($sql);
			return $request;
		}
        /* public function selectEstudiantesVerificados(){
			$sql = "SELECT ins.id,per.nombre_persona,CONCAT(per.ap_paterno,' ',per.ap_materno) AS apellidos,
            plante.nombre_plantel,plante.municipio,planest.nombre_carrera,ins.grado,sal.nombre_salon,per.validacion_doctos FROM t_inscripciones AS ins
            LEFT JOIN t_historiales AS his ON ins.id_historial = his.id
            INNER JOIN t_personas AS per ON ins.id_personas = per.id
            INNER JOIN t_plan_estudios AS planest ON ins.id_plan_estudios = planest.id
            INNER JOIN t_planteles AS plante ON planest.id_planteles = plante.id
            LEFT JOIN t_salones AS sal ON ins.id_salon = sal.id
            WHERE his.inscrito = 1 AND per.validacion_doctos = 1 AND per.validacion_datos_personales = 1";
			$request = $this->select_all($sql);
			return $request;
		} */
        /* public function selectEstudiantesVerificarDatosPersonales(){
            $sql = "SELECT ins.id,per.id AS id_persona, per.nombre_persona,CONCAT(per.ap_paterno,' ',per.ap_materno) AS apellidos,
            plante.nombre_plantel,plante.municipio,planest.nombre_carrera,ins.grado,sal.nombre_salon,per.validacion_doctos FROM t_inscripciones AS ins
            LEFT JOIN t_historiales AS his ON ins.id_historial = his.id
            INNER JOIN t_personas AS per ON ins.id_personas = per.id
            INNER JOIN t_plan_estudios AS planest ON ins.id_plan_estudios = planest.id
            INNER JOIN t_planteles AS plante ON planest.id_planteles = plante.id
            LEFT JOIN t_salones AS sal ON ins.id_salon = sal.id
            WHERE his.inscrito = 1 AND per.validacion_datos_personales = 0";
			$request = $this->select_all($sql);
			return $request;
        } */
        /* public function selectEstudiantesVerificarDocumentos(){
            $sql = "SELECT ins.id,per.nombre_persona,CONCAT(per.ap_paterno,' ',per.ap_materno) AS apellidos,
            plante.nombre_plantel,plante.municipio,planest.nombre_carrera,ins.grado,sal.nombre_salon,per.validacion_doctos FROM t_inscripciones AS ins
            LEFT JOIN t_historiales AS his ON ins.id_historial = his.id
            INNER JOIN t_personas AS per ON ins.id_personas = per.id
            INNER JOIN t_plan_estudios AS planest ON ins.id_plan_estudios = planest.id
            INNER JOIN t_planteles AS plante ON planest.id_planteles = plante.id
            LEFT JOIN t_salones AS sal ON ins.id_salon = sal.id
            WHERE his.inscrito = 1 AND per.validacion_doctos = 0";
			$request = $this->select_all($sql);
			return $request;
        } */
        public function selectDocumentacion(int $idInscripcion){
            $idInscripcion = $idInscripcion;
            $sql = "SELECT ins.id AS id_inscripcion, doc.id AS id_documento, detdoc.id AS id_detalle_documento,
            detdoc.tipo_documento FROM t_inscripciones AS ins
            INNER JOIN t_documentos AS doc ON ins.id_documentos = doc.id
            INNER JOIN t_detalle_documentos AS detdoc ON detdoc.id_documentos = doc.id
            WHERE ins.id = $idInscripcion";
            $request = $this->select_all($sql);
            return $request;
        }
        public function insertOriginalDocumentacion($data){
            $idInscripcion = $data['idInscripcion'];
            $idDetalleDocumentacion = $data['idDetalle'];
            $tipoDocumentacion = $data['tipo'];
            $estadoCheckDocumentacion = $data['estado'];
            $cantidadOriginal;
            $estatus;
            if($estadoCheckDocumentacion == 'true'){
                $cantidadOriginal = 1;
                $estatus = 1;
            }else{
                $cantidadOriginal = 0;
                $estatus = 0;
            }
            $sqlHistorial = "SELECT his.id FROM t_historiales AS his INNER JOIN t_inscripciones AS ins ON ins.id_historial = his.id WHERE his.inscrito = 1 AND ins.id = $idInscripcion LIMIT 1";
            $requestHistorial = $this->select($sqlHistorial);
            $idHistorial = $requestHistorial['id'];
            $sqlExist = "SELECT *FROM t_documentos_estudiante WHERE id_historial = $idHistorial AND id_detalle_documentos = $idDetalleDocumentacion";
            $requestExist = $this->select_all($sqlExist);
            if($requestExist){
                $id = $requestExist[0]['id'];
                $sql = "UPDATE t_documentos_estudiante SET entrego_cantidad_original = ?,estatus = ? WHERE id = $id";
                $request = $this->update($sql,array($cantidadOriginal,$estatus));
            }else{
                $sql = "INSERT INTO t_documentos_estudiante(prestamo_original,entrego_cantidad_original,entrego_cantidad_copias,estatus,id_detalle_documentos,id_historial) VALUES(?,?,?,?,?,?)";
                $request = $this->insert($sql,array(0,$cantidadOriginal,0,$estatus,$idDetalleDocumentacion,$idHistorial));
            }
            return $request;
        }
        public function insertCopiaDocumentacion($data){
            $idInscripcion = $data['idInscripcion'];
            $idDetalleDocumentacion = $data['idDetalle'];
            $tipoDocumentacion = $data['tipo'];
            $estadoCheckDocumentacion = $data['estado'];
            $cantidadCopia = $data['cantidad'];
           $sqlHistorial = "SELECT his.id FROM t_historiales AS his INNER JOIN t_inscripciones AS ins ON ins.id_historial = his.id WHERE his.inscrito = 1 AND ins.id = $idInscripcion LIMIT 1";
            $requestHistorial = $this->select($sqlHistorial);
            $idHistorial = $requestHistorial['id'];
            $sqlExist = "SELECT *FROM t_documentos_estudiante WHERE id_historial = $idHistorial AND id_detalle_documentos = $idDetalleDocumentacion";
            $requestExist = $this->select_all($sqlExist);
            if($requestExist){
                $id = $requestExist[0]['id'];
                $sql = "UPDATE t_documentos_estudiante SET entrego_cantidad_copias = ? WHERE id = $id";
                $request = $this->update($sql,array($cantidadCopia));
            }else{
                $sql = "INSERT INTO t_documentos_estudiante(prestamo_original,entrego_cantidad_original,entrego_cantidad_copias,estatus,id_detalle_documentos,id_historial) VALUES(?,?,?,?,?,?)";
                $request = $this->insert($sql,array(0,0,$cantidadCopia,0,$idDetalleDocumentacion,$idHistorial));
            }
            return $cantidadCopia;
        }
        public function insertCantidadCopiaDocumentacion($data){
            $idInscripcion = $data['idInscripcion'];
            $idDetalleDocumentacion = $data['idDetalle'];
            $tipoDocumentacion = $data['tipo'];
            $cantidadCopia = $data['cantidad'];
            $sqlHistorial = "SELECT his.id FROM t_historiales AS his INNER JOIN t_inscripciones AS ins ON ins.id_historial = his.id WHERE his.inscrito = 1 AND ins.id = $idInscripcion LIMIT 1";
            $requestHistorial = $this->select($sqlHistorial);
            $idHistorial = $requestHistorial['id'];
            $sqlExist = "SELECT *FROM t_documentos_estudiante WHERE id_historial = $idHistorial AND id_detalle_documentos = $idDetalleDocumentacion";
            $requestExist = $this->select_all($sqlExist);
            if($requestExist){
                $id = $requestExist[0]['id'];
                $sql = "UPDATE t_documentos_estudiante SET entrego_cantidad_copias = ? WHERE id = $id";
                $request = $this->update($sql,array($cantidadCopia));
            }else{
                $sql = "INSERT INTO t_documentos_estudiante(prestamo_original,entrego_cantidad_original,entrego_cantidad_copias,estatus,id_detalle_documentos,id_historial) VALUES(?,?,?,?,?,?)";
                $request = $this->insert($sql,array(0,0,$cantidadCopia,0,$idDetalleDocumentacion,$idHistorial));
            }
            return $request;
        }
        public function selectEstatusDocumentacion($data){
            $idInscripcion = $data['idInscripcion'];
            $sqlHistorial = "SELECT his.id FROM t_historiales AS his INNER JOIN t_inscripciones AS ins ON ins.id_historial = his.id WHERE his.inscrito = 1 AND ins.id = $idInscripcion LIMIT 1";
            $requestHistorial = $this->select($sqlHistorial);
            $idHistorial = $requestHistorial['id'];
            $sqlEstatus = "SELECT *FROM t_documentos_estudiante WHERE id_historial = $idHistorial";
            $requestEstatus = $this->select_all($sqlEstatus);
            return $requestEstatus;
        }
        public function insertValidacionDocumentacion($data){
            $idInscripcion = $data['idInscripcion'];
            $sqlPersona = "SELECT id_personas FROM t_inscripciones WHERE id = $idInscripcion LIMIT 1";
            $requestPersona = $this->select($sqlPersona);
            $idPersona = $requestPersona['id_personas'];
            $sql = "UPDATE t_personas SET validacion_doctos = ?,id_usuario_verificacion_doctos = ? WHERE id = $idPersona";
            $request = $this->update($sql,array(1,1));
            return $request;
        }
        public function insertValidacionDatosPersonales($data){
            $idPersona = $data['idEdit'];
            $nombre = $data['txtNombreEdit'];
            $appPaterno = $data['txtApellidoPaEdit'];
            $appMaterno = $data['txtApellidoMaEdit'];
            $sexo = $data['listSexoEdit'];
            $edad = $data['txtEdadEdit'];
            $estadoCivil = $data['listEstadoCivilEdit'];
            $fechaNacimiento = $data['txtFechaNacimientoEdit'];
            $ocupacion = $data['txtOcupacionEdit'];
            $telefonoCel = $data['txtTelCelEdit'];
            $telefonofijo = $data['txtTelFiEdit'];
            $email = $data['txtEmailEdit'];
            $escolaridad = $data['listEscolaridadEdit'];
            $estado = $data['listEstadoEdit'];
            $municipio = $data['listMunicipioEdit'];
            $localidad = $data['listLocalidadEdit'];
            $colonia = $data['txtColoniaEdit'];
            $CP = $data['txtCPEdit'];
            $direccion = $data['txtDireccionEdit'];
            $sql = "UPDATE t_personas SET nombre_persona = ?,ap_paterno = ?,ap_materno = ?,direccion = ?,edad = ?,sexo = ?,cp = ?,colonia = ?,tel_celular = ?,tel_fijo = ?,email = ?,edo_civil = ?,ocupacion = ?,fecha_nacimiento = ?,validacion_datos_personales = ?,id_localidad = ? ,id_usuario_verificacion_datos_personales = ? WHERE id = $idPersona";
            $request = $this->update($sql,array($nombre,$appPaterno,$appMaterno,$direccion,$edad,$sexo,$CP,$colonia,$telefonoCel,$telefonofijo,$email,$estadoCivil,$ocupacion,$fechaNacimiento,1,$localidad,1));
            return $request;
        }
        public function selectEstados(){
            $sql = "SELECT *FROM t_estados";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectGradosEstudios(){
            $sql = "SELECT *FROM t_escolaridad";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectMunicipios($idEstado){
            $idEstado = $idEstado;
            $sql = "SELECT *FROM t_municipios WHERE id_estados = $idEstado";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectLocalidades($idMunicipio){
            $idMunicipio = $idMunicipio;
            $sql = "SELECT *FROM t_localidades WHERE id_municipio = $idMunicipio";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectPersonaEdit($idPersona){
            $sql = "SELECT per.id,per.ap_materno,per.ap_paterno,per.colonia,per.cp,per.direccion,per.edad,per.edo_civil,
            per.email,per.estatus,per.id_categoria_persona,per.id_escolaridad,gra.nombre_escolaridad,per.id_localidad,
            loc.nombre AS nomlocalidad, per.nombre_persona,
            per.ocupacion,per.sexo,per.tel_celular,per.tel_fijo,per.validacion_doctos,per.validacion_datos_personales,mun.id AS idmun,mun.nombre AS nommunicipio,
            est.id AS idest,est.nombre AS nomestado,per.fecha_nacimiento 
            FROM t_personas AS per
            INNER JOIN t_localidades AS loc ON per.id_localidad = loc.id
            INNER JOIN t_municipios AS mun ON loc.id_municipio = mun.id
            INNER JOIN t_estados AS est ON mun.id_estados =  est.id
            INNER JOIN t_escolaridad AS gra ON per.id_escolaridad = gra.id
            WHERE per.id = $idPersona";
            $request = $this->select($sql);
            return $request;
        }
        public function selectUsuarioValidacion(int $idPersonaValidacion){
            $idUsuarioVerificado = $idPersonaValidacion;
            $sql = "SELECT CONCAT(per.nombre_persona,'&nbsp;',per.ap_paterno,'&nbsp;',per.ap_materno) AS nombre_persona_validacion FROM t_personas AS per 
            INNER JOIN t_usuarios AS us ON us.id_persona = per.id WHERE us.id = $idUsuarioVerificado";
            $request = $this->select($sql);
            return $request['nombre_persona_validacion'];
        }        
	}
?>