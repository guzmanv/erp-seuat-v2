<?php
    class InscripcionModel extends Mysql{
        public function __construct(){
            parent::__construct();
        }
        public function selectInscripciones(){
            $sql = "SELECT ins.id,CONCAT(per.nombre_persona,' ',per.ap_paterno,' ',per.ap_materno)AS nombre_persona,
            per.validacion,plant.nombre_plantel,pln.nombre_carrera,sal.id_grado,sal.id_grupo FROM t_inscripciones AS ins
            INNER JOIN t_personas AS per ON ins.id_persona = per.id
            INNER JOIN t_plan_estudios AS pln ON ins.plan_estudios = pln.id
            INNER JOIN t_planteles AS plant ON pln.id_planteles = plant.id 
            INNER JOIN t_historiales AS his ON his.id_inscripcion = ins.id
            INNER JOIN t_salones AS sal ON his.id_salon = sal.id ORDER BY id DESC";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectPersona($id){
            $sql = "SELECT *FROM t_personas WHERE id = $id";
            $request = $this->select($sql);
            return $request;
        }
        public function selectPersonasModal($data){
            $sql = "SELECT id,CONCAT(nombre_persona,' ',ap_paterno,' ',ap_materno) AS nombre FROM t_personas
            WHERE CONCAT(nombre_persona,' ',ap_paterno,' ',ap_materno) LIKE '%$data%'";
            $request = $this->select_all($sql);
            return $request;
        }

        public function insertInscripcion($data){
            $idPersona = $data['idPersonaSeleccionada'];
            $idPlantel = $data['listPlantelNuevo'];
            $idCarrera = $data['listCarreraNuevo'];
            $nombreTutor = $data['txtNombreTutorAgregar'];
            $appPatTutor = $data['txtAppPaternoTutorAgregar'];
            $appMatTutor = $data['txtAppMaternoTutorAgregar'];
            $telCelularTutor = $data['txtTelCelularTutorAgregar'];
            $telFijoTutor = $data['txtTelFijoTutorAgregar'];
            $emailTutor = $data['txtEmailTutorAgregar'];
 
            $sql = "INSERT INTO t_tutores(nombre_tutor,appat_tutor,apmat_tutor,tel_celular,tel_fijo,email) VALUES(?,?,?,?,?,?)";
            $request = $this->insert($sql,array($nombreTutor,$appPatTutor,$appMatTutor,$telCelularTutor,$telFijoTutor,$emailTutor));
            if($request){
                $sql_documentos = "SELECT doc.id FROM t_plan_estudios AS plan
                INNER JOIN t_nivel_educativos AS niv ON plan.id_nivel_educativo = niv.id 
                INNER JOIN t_documentos AS doc ON doc.id_nivel_educativo = niv.id WHERE plan.id = $idCarrera";
                $request_documentos = $this->select($sql_documentos);
                if($request_documentos){
                    $idDocumentos = $request_documentos['id'];
                    $sql_inscripcion = "INSERT INTO t_inscripciones(folio,fecha_inscripcion,tipo_ingreso,grado,horario_entrada_horario_salida,fecha_inicio,id_plan_estudios,id_persona,id_usuario_creacion,id_usuario_actualizacion,id_tutores,id_documentos,id_campania,id_salon,fecha_actualizacion) VALUES(?,NOW(),?,?,?,?,NOW(),?,?,?,?,?,?,?,?,NOW())";
                    $request_inscripcion = $this->insert($sql_inscripcion,array('L','L',1',$idDocumentos,$idPersona,$idCarrera,$request,1,1));
                    if($request_inscripcion){
                        $idInscripcion = $request_inscripcion;
                        $sql_historial = "INSERT INTO t_historiales(inscrito,id_inscripcion,id_salon) VALUES(?,?,?)";
                        $request_historial = $this->insert($sql_historial,array(1,$idInscripcion,1));
                    }
                }
            }
            return $request_historial;
        }
        public function selectPlanteles(){
            $sql = "SELECT *FROM t_planteles";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectCarreras($data){
            $idPlantel = $data;
            $sql = "SELECT *FROM t_plan_estudios WHERE id_planteles = $idPlantel AND estatus !=0";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectDocumentacion($idAlumno){
            $idAlumno = $idAlumno;
            $sql = "SELECT insc.id_personas,insc.id_documentos,det.tipo_documento FROM t_inscripciones AS insc
            INNER JOIN t_documentos AS doc ON insc.id_documentos = doc.id
            INNER JOIN t_detalle_documentos AS det ON det.id_documentos = doc.id
            WHERE insc.id = $idAlumno";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectInscripcion(int $idInscripcion){
            $sql = "SELECT per.nombre_persona,per.ap_paterno,per.ap_materno,plnt.id AS id_plantel,ins.id_plan_estudios,plan.nombre_carrera FROM t_inscripciones AS ins
            INNER JOIN t_personas AS per ON ins.id_personas = per.id
            INNER JOIN t_plan_estudios AS plan ON ins.id_plan_estudios = plan.id
            INNER JOIN t_planteles AS plnt ON plan.id_planteles = plnt.id
            WHERE ins.id = $idInscripcion";
            $request = $this->select_all($sql);
            return $request;
        }
    }
?>