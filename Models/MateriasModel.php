<?php
    class MateriasModel extends Mysql{
        public function __construct(){
            parent::__construct();
        }
        public function selectMaterias(){
            $sql = "SELECT mat.id,mat.nombre_materia,pe.nombre_carrera,mat.id_grados,mat.tipo,mat.chk_practica,mat.chk_servicio_social,
            mat.chk_foros,mat.chk_materia,mat.estatus,gr.numero_romano FROM t_materias AS mat
            INNER JOIN t_plan_estudios AS pe ON mat.id_plan_estudios = pe.id
            INNER JOIN t_grados AS gr ON mat.id_grados = gr.id
            WHERE mat.estatus !=0 ORDER BY mat.id DESC";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectGrados(){
            $sql = "SELECT *FROM t_grados";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectPlanEstudios(){
            $sql = "SELECT *FROM t_plan_estudios WHERE estatus = 1 ORDER BY nombre_carrera ASC";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectPlanEstudiosNuevo($id){
            $sql = "SELECT *FROM t_plan_estudios WHERE id_planteles = $id ORDER BY nombre_carrera ASC";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectPlanteles(){
            $sql = "SELECT *FROM t_planteles WHERE estatus = 1";
            $request = $this->select_all($sql);
            return $request;
        }
        public function insertMateria($data){
            $nombreMateria = $data['txtNombreNuevo'];
            $clave = $data['txtClaveNuevo'];
            $horasTeoria = $data['txtHorasTeoriaNuevo'];
            $horasPracticas = $data['txtHorasPracticaNuevo'];
            $creditos = $data['txtCreditosNuevo'];
            $tipo = $data['listTipoNuevo'];
            $grado = $data['listGradoNuevo'];
            $planEstudio = $data['listPlanEstudioNuevo'];
            $clasificacion = $data['listClasificacionNuevo'];
            //$estatus = $data['listEstatusNuevo'];
            $request;
            $chkMateria = 0;
            $chkForos = 0;
            $chkServicioSocial = 0;
            $chkPractica = 0;
            if($clasificacion == '1'){
                $chkMateria = 1;
                $chkForos = 0;
                $chkServicioSocial = 0;
                $chkPractica = 0;
            }if($clasificacion == '2'){
                $chkMateria = 0;
                $chkForos = 1;
                $chkServicioSocial = 0;
                $chkPractica = 0;
            }if($clasificacion == '3'){
                $chkMateria = 0;
                $chkForos = 0;
                $chkServicioSocial = 1;
                $chkPractica = 0;
            }if($clasificacion == '4'){
                $chkMateria = 0;
                $chkForos = 0;
                $chkServicioSocial = 0;
                $chkPractica = 1; 
            }
            if ($tipo == '1') {
                $tipo = "Basica";
            }else{    
                $tipo = "Ordinaria";
            }
            $request;
            $sqlExist = "SELECT *FROM t_materias WHERE nombre_materia = '$nombreMateria' OR clave = '$clave'";
            $requestExist = $this->select($sqlExist);
            if($requestExist){
                $request['estatus'] = TRUE;
            }else{
                $sqlNew = "INSERT INTO t_materias(clave,nombre_materia,hrs_teoria,hrs_practicas,creditos,tipo,id_grados,id_plan_estudios,
                    chk_practica,chk_servicio_social,chk_foros,chk_materia,estatus,fecha_creacion,fecha_actualizacion,id_usuario_creacion,id_usuario_actualizacion) 
                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,NOW(),NOW(),?,?)";
                $requestNew = $this->insert($sqlNew,array($clave,$nombreMateria,$horasTeoria,$horasPracticas,$creditos,$tipo,$grado,$planEstudio,
                        $chkPractica,$chkServicioSocial,$chkForos,$chkMateria,1,1,1));
                $request['estatus'] = FALSE;
            }
            return $request;
        }

        public function selectMateria(int $idMateria){
            $sql = "SELECT mat.id,mat.clave,mat.nombre_materia,mat.hrs_teoria,mat.hrs_practicas,mat.creditos,mat.tipo,pe.id AS id_plan,pe.nombre_carrera,mat.id_grados,mat.tipo,mat.chk_practica,mat.chk_servicio_social,
            mat.chk_foros,mat.chk_materia,mat.estatus,gr.id AS id_grado,gr.nombre_grado,gr.numero_romano,pl.id AS idplantel,pl.nombre_plantel,pl.municipio FROM t_materias AS mat
            INNER JOIN t_plan_estudios AS pe ON mat.id_plan_estudios = pe.id
            INNER JOIN t_planteles AS pl ON pe.id_planteles = pl.id
            INNER JOIN t_grados AS gr ON mat.id_grados = gr.id WHERE mat.id = $idMateria";
            $request = $this->select($sql);
            return $request;
        }

        public function updateMateria(int $intIdMateriaEdit,$data){
            $idMateria = $intIdMateriaEdit;
            $nombreMateria = $data['txtNombreEdit'];
            $clave = $data['txtClaveEdit'];
            $horasTeoria = $data['txtHorasTeoriaEdit'];
            $horasPracticas = $data['txtHorasPracticaEdit'];
            $creditos = $data['txtCreditosEdit'];
            $tipo = $data['listTipoEdit'];
            $grado = $data['listGradoEdit'];
            $planEstudio = $data['listPlanEstudioEdit'];
            $clasificacion = $data['listClasificacionEdit'];
            $estatus = $data['listEstatusEdit'];
            $chkPractica = 0;
            $chkServicioSocial = 0;
            $chkForos = 0;
            $chkMateria = 0;
            if($clasificacion == '1'){
                $chkMateria = 1;
                $chkForos = 0;
                $chkServicioSocial = 0;
                $chkPractica = 0;
            }if($clasificacion == '2'){
                $chkMateria = 0;
                $chkForos = 1;
                $chkServicioSocial = 0;
                $chkPractica = 0;
            }if($clasificacion == '3'){
                $chkMateria = 0;
                $chkForos = 0;
                $chkServicioSocial = 1;
                $chkPractica = 0;
            }if($clasificacion == '4'){
                $chkMateria = 0;
                $chkForos = 0;
                $chkServicioSocial = 0;
                $chkPractica = 1; 
            }
            if ($tipo == '1') {
                $tipo = "Basica";
            }else{    
                $tipo = "Ordinaria";
            }
            $sql = "UPDATE t_materias SET clave = ? ,nombre_materia = ? ,hrs_teoria = ?,hrs_practicas = ?,creditos = ?,tipo = ?,id_grados = ?,
            id_plan_estudios = ? ,chk_practica = ? ,chk_servicio_social = ? ,chk_foros = ? ,chk_materia = ? ,estatus = ?,
            fecha_actualizacion = NOW() ,id_usuario_creacion = ? ,id_usuario_actualizacion = ? WHERE id = $intIdMateriaEdit"; 
            $request = $this->update($sql,array($clave,$nombreMateria,$horasTeoria,$horasPracticas,$creditos,$tipo,$grado,$planEstudio,
                        $chkPractica,$chkServicioSocial,$chkForos,$chkMateria,$estatus,1,1));
            return $request;
        }

        public function deleteMateria(int $intIdMateria){
            $sql = "SELECT * FROM t_materias WHERE id = $intIdMateria";
			$request = $this->select_all($sql);
			if($request){
				$sql = "UPDATE t_materias SET estatus = ? WHERE id = $intIdMateria";
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