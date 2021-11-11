<?php
    class PersonaModel extends Mysql{
        public function __construct(){
            parent::__construct();
        }
        public function selectPersonas(){
            $sql = "SELECT per.id, per.nombre_persona, per.ap_paterno, per.ap_materno, per.email, per.tel_celular,
            per.direccion,per.estatus,cat.nombre_categoria FROM t_personas AS per
            INNER JOIN t_categoria_personas AS cat ON per.id_categoria_persona = cat.id 
            WHERE per.estatus !=0 ORDER BY per.id DESC";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectPersona($idPersona){
            $sql = "SELECT *FROM t_personas WHERE id = $idPersona";
            $request = $this->select($sql);
            return $request;
        }
        public function selectPersonaEdit($idPersona){
            $sql = "SELECT per.id,per.ap_materno,per.ap_paterno,per.colonia,per.cp,per.direccion,per.edad,per.edo_civil,
            per.email,per.estatus,per.id_categoria_persona,per.id_escolaridad,gra.nombre_escolaridad,per.id_localidad,
            loc.nombre AS nomlocalidad, per.nombre_persona,
            per.ocupacion,per.sexo,per.tel_celular,per.tel_fijo,mun.id AS idmun,mun.nombre AS nommunicipio,
            est.id AS idest,est.nombre AS nomestado,per.fecha_nacimiento,per.curp,nivelin.nombre_escolaridad AS nivel_carrera_interes,nivelin.id AS id_nivel_carrera_interes, carrin.nombre_carrera AS carrera_interes,carrin.id AS id_carrera_interes 
            FROM t_personas AS per
            INNER JOIN t_localidades AS loc ON per.id_localidad = loc.id
            INNER JOIN t_municipios AS mun ON loc.id_municipio = mun.id
            INNER JOIN t_estados AS est ON mun.id_estados =  est.id
            INNER JOIN t_escolaridad AS gra ON per.id_escolaridad = gra.id
            INNER JOIN t_escolaridad AS nivelin ON per.id_nivel_carrera_interes = nivelin.id
            INNER JOIN t_carrera_interes AS carrin ON per.id_carrera_interes = carrin.id
            WHERE per.id = $idPersona";
            $request = $this->select($sql);
            return $request;
        }
        public function selectCategoriasPersona(){
            $sql = "SELECT *FROM t_categoria_personas";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectGradosEstudios(){
            $sql = "SELECT *FROM t_escolaridad";
            $request = $this->select_all($sql);
            return $request;
        }
        public function insertPersona($data){
            $nombre = $data['txtNombreNuevo'];
            $apellidoP = $data['txtApellidoPaNuevo'];
            $apellidoM = $data['txtApellidoMaNuevo'];
            $direccion = $data['txtDireccionNuevo'];
            $edad = $data['txtEdadNuevo'];
            $sexo = $data['listSexoNuevo'];
            $cp = $data['txtCPNuevo'];
            $colonia = $data['txtColoniaNuevo'];
            $telefonoCelular = $data['txtTelCelNuevo'];
            $telefonoFijo = $data['txtTelFiNuevo'];
            $email = $data['txtEmailNuevo'];
            $estadoCivil = $data['listEstadoCivilNuevo'];
            $ocupacion = $data['txtOcupacionNuevo'];
            $grado = $data['listEscolaridadNuevo'];
            $localidad = $data['listLocalidadNuevo'];
            $categoriaPersona = $data['listCategoriaNuevo'];
            $fechaNacimiento = $data['txtFechaNacimientONuevo'];
            $CURP = $data['txtCURPNuevo'];
            $nivelCarreraInteres = $data['listNivelCarreraInteres'];
            $carreraInteres = $data['listCarreraInteres'];
            //$estatus = $data['listEstatusNuevo'];
            $sql = "INSERT INTO t_personas(nombre_persona,ap_paterno,ap_materno,direccion,edad,sexo,cp,colonia,tel_celular,tel_fijo,email,edo_civil,ocupacion,curp,fecha_nacimiento,validacion_doctos,validacion_datos_personales,id_nivel_carrera_interes,id_carrera_interes,estatus,fecha_creacion,fecha_actualizacion,id_categoria_persona,id_rol,id_localidad,id_escolaridad,id_usuario_creacion,id_usuario_actualizacion,id_usuario_verificacion_datos_personales,id_usuario_verificacion_doctos) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW(),NOW(),?,?,?,?,?,?,?,?)";
            $request = $this->insert($sql,array($nombre,$apellidoP,$apellidoM,$direccion,$edad,$sexo,$cp,$colonia,$telefonoCelular,$telefonoFijo,$email,$estadoCivil,$ocupacion,$CURP,$fechaNacimiento,0,0,$nivelCarreraInteres,$carreraInteres,1,1,1,$localidad,$grado,1,1,1,1));
            return $request;
        }

        public function updatePersona($idPersona,$data){
            $nombre = $data['txtNombreEdit'];
            $apellidoP = $data['txtApellidoPaEdit'];
            $apellidoM = $data['txtApellidoMaEdit'];
            $direccion = $data['txtDireccionEdit'];
            $edad = $data['txtEdadEdit'];
            $sexo = $data['listSexoEdit'];
            $cp = $data['txtCPEdit'];
            $colonia = $data['txtColoniaEdit'];
            $telefonoCelular = $data['txtTelCelEdit'];
            $telefonoFijo = $data['txtTelFiEdit'];
            $email = $data['txtEmailEdit'];
            $estadoCivil = $data['listEstadoCivilEdit'];
            $ocupacion = $data['txtOcupacionEdit'];
            //$validacion = $data['txtValidacionEdit'];
            $grado = $data['listEscolaridadEdit'];
            $localidad = $data['listLocalidadEdit'];
            $categoriaPersona = $data['listCategoriaEdit'];
            $estatus = $data['listEstatusEdit'];
            $curp = $data['txtCURPEdit'];
            $fechaNacimiento = $data['txtFechaNacimientoEdit'];
            $nivelCarreraInteres = $data['listNivelCarreraInteresEdit'];
            $carreraInteres = $data['listCarreraInteresEdit'];
        
            $sql = "UPDATE t_personas SET nombre_persona = ?,ap_paterno = ?,ap_materno = ?,direccion = ?,edad = ?,sexo = ?,cp = ?,colonia = ?,tel_celular = ?,tel_fijo = ?,email = ?,edo_civil = ?,ocupacion = ?,curp = ?,fecha_nacimiento = ?,id_nivel_carrera_interes = ?,id_carrera_interes = ?, estatus = ?, fecha_actualizacion = NOW(),id_categoria_persona = ?,id_rol = ?,id_localidad = ?,id_usuario_actualizacion = ? WHERE id = $idPersona";
            $request = $this->update($sql,array($nombre,$apellidoP,$apellidoM,$direccion,$edad,$sexo,$cp,$colonia,$telefonoCelular,$telefonoFijo,$email,$estadoCivil,$ocupacion,$curp,$fechaNacimiento,$nivelCarreraInteres,$carreraInteres,$estatus,$categoriaPersona,1,$localidad,1));
            return $request;
        }
        public function selectEstados(){
            $sql = "SELECT *FROM t_estados";
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
        public function selectCarrerasInteres($idNivel){
            $idNivel = $idNivel;
            $sql = "SELECT *FROM t_carrera_interes WHERE id_nivel_carrera = $idNivel";
            $request = $this->select_all($sql);
            return $request;
        }
        public function deletePersona($idPersona){
            $sql = "SELECT * FROM t_personas WHERE id = $idPersona";
			$request = $this->select_all($sql);
			if($request){
				$sql = "UPDATE t_personas SET estatus = ? WHERE id = $idPersona";
				$arrData = array(0);
				$request = $this->update($sql,$arrData);
				if($request){
					$request = 'ok';	
				}else{
					$request = 'error';
				}
			}
			return $request;
        }
    }
?>