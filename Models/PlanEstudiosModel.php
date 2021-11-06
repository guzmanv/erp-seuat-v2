<?php
    class PlanEstudiosModel extends Mysql{
        public function __construct(){
            parent::__construct();
        }

        public function selectPlanteles(){
            $sql = "SELECT *FROM t_planteles";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectNivelEducativo(){
            $sql = "SELECT *FROM t_nivel_educativos";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectCategorias(){
            $sql = "SELECT *FROM t_categoria_carreras";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectModalidades(){
            $sql = "SELECT *FROM t_modalidades";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectPlanes(){
            $sql = "SELECT *FROM t_organizacion_planes";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectPlanEstudios(){
            $sql = "SELECT plan.id,plan.nombre_carrera,plan.rvoe,plan.vigencia_rvoe,plan.estatus,plant.nombre_plantel,cat.nombre_categoria_carrera,plant.municipio FROM t_plan_estudios AS plan
            INNER JOIN t_planteles AS plant ON plan.id_planteles = plant.id
            INNER JOIN t_categoria_carreras AS cat ON plan.id_categoria_carrera = cat.id
            WHERE plan.estatus !=0
            ORDER BY id DESC";
            $request = $this->select_all($sql);
            return $request;
        }
        public function insertPlanEstudios($data){
            $nombrePlanEstudios = $data['txtNombreNuevo'];
            $nombreCorto = $data['txtNombrecortoNuevo'];
            $perfilEgreso = $data['txtPerfilEgresoNuevo'];
            $duracionCarrera = $data['txtDuracionNuevo'];
            $materiasTotales = $data['txtMatTotalesNuevo'];
            $totalHoras = $data['txtTotalHrsNuevo'];
            $totalCreditos = $data['listTotalCreditosNuevo'];
            $claveProfesiones = $data['txtClaveProfNuevo'];
            $tipoREVOE = $data['listTipoRvoeNuevo'];
            $REVOE = $data['txtRvoeNuevo'];
            $vigenciaREVOE = $data['txtVigenciaNuevo'];
            $calificacionMinima = $data['txtCalMinNuevo'];
            $fechaOtorgamiento = $data['txtFechaOtorgamientoNuevo'];
            $fechaEstimadaTermino = $data['txtFechaTerminacionNuevo'];
            $perfilIngreso = $data['txtPerfilIngresoNuevo'];
            $campoLaboral = $data['txtCampoLaboralNuevo'];
            //$estatus = $data['listEstatusNuevo'];
            $idPlan = $data['listPlanNuevo'];
            $idPlantel = $data['listPlantelNuevo'];
            $idNiveleducativo = $data['listNivelEdNuevo'];
            $idCategoriaCarrera = $data['listCategoriaNuevo'];
            $idModalidad = $data['listModalidadNuevo'];
            switch ($tipoREVOE) {
                case 0:
                    $tipoREVOE = "Estatal";
                case 1:
                    $tipoREVOE = "Federal";
            }
            $sql = "INSERT INTO t_plan_estudios(nombre_carrera,nombre_carrera_corto,perfil_egreso,duracion_carrera,materias_totales,total_horas,total_creditos,clave_profesiones,
                    tipo_rvoe,rvoe,vigencia_rvoe,calificacion_minima,fecha_otorgamiento,perfil_ingreso,campo_laboral,estatus,fecha_creacion,fecha_actualizacion,id_plan,
                    id_planteles,id_nivel_educativo,id_categoria_carrera,id_modalidad,id_usuario_creacion,id_usuario_actualizacion,fecha_estimada_termino) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW(),NOW(),?,?,?,?,?,?,?,?)";
            $request = $this->insert($sql,array($nombrePlanEstudios,$nombreCorto,$perfilEgreso,$duracionCarrera,$materiasTotales,$totalHoras,$totalCreditos,$claveProfesiones,
                        $tipoREVOE,$REVOE,$vigenciaREVOE,$calificacionMinima,$fechaOtorgamiento,$perfilIngreso,$campoLaboral,1,$idPlan,$idPlantel,$idNiveleducativo,
                    $idCategoriaCarrera,$idModalidad,1,1,$fechaEstimadaTermino));
            
            return $request;
        }

        public function updatePlanEstudios($idPlanEstudiosEdit, $data){
            $nombrePlanEstudios = $data['txtNombreEdit'];
            $nombreCorto = $data['txtNombrecortoEdit'];
            $perfilEgreso = $data['txtPerfilEgresoEdit'];
            $duracionCarrera = $data['txtDuracionEdit'];
            $materiasTotales = $data['txtMatTotalesEdit'];
            $totalHoras = $data['txtTotalHrsEdit'];
            $totalCreditos = $data['listTotalCreditosEdit'];
            $claveProfesiones = $data['txtClaveProfEdit'];
            $tipoREVOE = $data['listTipoRvoeEdit'];
            $REVOE = $data['txtRvoeEdit'];
            $vigenciaREVOE = $data['txtVigenciaEdit'];
            $calificacionMinima = $data['txtCalMinEdit'];
            $fechaOtorgamiento = $data['txtFechaOtorgamientoEdit'];
            $fechaEstimadaTermino = $data['txtFechaTerminacionEdit'];
            $perfilIngreso = $data['txtPerfilIngresoEdit'];
            $campoLaboral = $data['txtCampoLaboralEdit'];
            $estatus = $data['listEstatusEdit'];
            $idPlan = $data['listPlanEdit'];
            $idPlantel = $data['listPlantelEdit'];
            $idNiveleducativo = $data['listNivelEdEdit'];
            $idCategoriaCarrera = $data['listCategoriaEdit'];
            $idModalidad = $data['listModalidadEdit'];

            $sql = "UPDATE t_plan_estudios SET nombre_carrera = ?,nombre_carrera_corto = ?,perfil_egreso = ?,duracion_carrera = ?,materias_totales = ?,
            total_horas = ?,total_creditos = ?,clave_profesiones = ?,tipo_rvoe = ?,rvoe = ?,vigencia_rvoe = ?,calificacion_minima = ?,fecha_otorgamiento = ?,
            perfil_ingreso = ?,campo_laboral = ?,estatus = ?,fecha_actualizacion = NOW(),id_plan = ?,id_planteles = ?,id_nivel_educativo = ?,
            id_categoria_carrera = ?,id_modalidad = ?,id_usuario_creacion = ?,id_usuario_actualizacion = ?,fecha_estimada_termino = ? WHERE id = $idPlanEstudiosEdit";
            $request = $this->update($sql,array($nombrePlanEstudios,$nombreCorto,$perfilEgreso,$duracionCarrera,$materiasTotales,$totalHoras,$totalCreditos,
            $claveProfesiones,$tipoREVOE,$REVOE,$vigenciaREVOE,$calificacionMinima,$fechaOtorgamiento,$perfilIngreso,$campoLaboral,$estatus,$idPlan,$idPlantel,
            $idNiveleducativo,$idCategoriaCarrera,$idModalidad,1,1,$fechaEstimadaTermino));
            return $request;
        }

        public function selectPlanEstudio($idPlanestudio){
            $sql = "SELECT plan.id,plan.nombre_carrera,plan.nombre_carrera_corto,plan.rvoe,plan.vigencia_rvoe,plan.estatus,plan.duracion_carrera,plan.materias_totales,plan.total_horas,
            plan.calificacion_minima,plan.total_creditos,plan.clave_profesiones,plan.tipo_rvoe,plan.fecha_otorgamiento,plan.perfil_ingreso,plan.perfil_egreso,plan.campo_laboral,
            plant.nombre_plantel,niv.nombre_nivel_educativo,cat.nombre_categoria_carrera,moda.nombre_modalidad,pl.nombre_plan,plan.fecha_estimada_termino,plant.municipio
            FROM t_plan_estudios AS plan
            INNER JOIN t_planteles AS plant ON plan.id_planteles = plant.id 
            INNER JOIN t_nivel_educativos AS niv ON plan.id_nivel_educativo = niv.id
            INNER JOIN t_categoria_carreras AS cat ON plan.id_categoria_carrera = cat.id
            INNER JOIN t_modalidades AS moda ON plan.id_modalidad = moda.id
            INNER JOIN t_organizacion_planes AS pl ON plan.id_plan = pl.id
            WHERE plan.id = $idPlanestudio LIMIT 1";
            $request = $this->select($sql);
            return $request;
        }
        public function selectPlanEstudioEdit($idPlanEstudio){
            $sql = "SELECT *FROM t_plan_estudios WHERE id = $idPlanEstudio";
            $request = $this->select($sql);
            return $request;
        }
        public function deletePlanEdtudio($idPlanEstudio){
            $sql = "SELECT * FROM t_plan_estudios WHERE id = $idPlanEstudio";
			$request = $this->select_all($sql);
			if($request){
				$sql = "UPDATE t_plan_estudios SET estatus = ? WHERE id = $idPlanEstudio";
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