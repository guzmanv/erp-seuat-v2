<?php
    class InscripcionModel extends Mysql{
        public function __construct(){
            parent::__construct();
        }
        /* public function selectInscripcionesAdmision(){
            $sql = "SELECT ins.id,CONCAT(nombre_persona,' ',ap_paterno,' ',ap_materno) AS nombre_completo,plant.nombre_plantel,plant.municipio,plan.nombre_carrera,sal.nombre_salon,gra.numero_natural,grup.nombre_grupo,per.validacion FROM t_inscripciones AS ins
            INNER JOIN t_personas AS per ON ins.id_personas = per.id
            INNER JOIN t_plan_estudios AS plan ON ins.id_plan_estudios = plan.id
            INNER JOIN t_salones AS sal ON ins.id_salon = sal.id
            INNER JOIN t_grados AS gra ON sal.id_grado = gra.id
            INNER JOIN t_grupos AS grup ON sal.id_grupo = grup.id
            INNER JOIN t_planteles AS plant ON plan.id_planteles = plant.id";
            $request = $this->select_all($sql);
            return $request;
        } */
        public function selectInscripcionesAdmision($idplantel){
            $idPlantel = $idplantel;
            if($idPlantel == "Todos"){
                $sql = "SELECT plan.id,plan.nombre_carrera,niv.nombre_nivel_educativo,ins.grado,grup.nombre_grupo,orgp.nombre_plan,tur.id AS id_turno,tur.nombre_turno, COUNT(*) AS total FROM t_inscripciones AS ins
                INNER JOIN t_personas AS per ON ins.id_personas = per.id
                INNER JOIN t_plan_estudios AS plan ON ins.id_plan_estudios = plan.id
                INNER JOIN t_nivel_educativos AS niv ON plan.id_nivel_educativo = niv.id
                INNER JOIN t_organizacion_planes AS orgp ON plan.id_plan = orgp.id
                LEFT JOIN t_salonescompletos AS sal ON ins.id_salon = sal.id
                LEFT JOIN t_grados AS gra ON sal.id_grado = gra.id
                LEFT JOIN t_grupos AS grup ON sal.id_grupo = grup.id
                INNER JOIN t_planteles AS plant ON plan.id_planteles = plant.id
                INNER JOIN t_turnos AS tur ON ins.id_horario = tur.id
                GROUP BY plan.nombre_carrera,ins.grado,tur.nombre_turno HAVING COUNT(*)>=1";
                $request = $this->select_all($sql);
            }else{
                $sql = "SELECT plan.id,plan.nombre_carrera,niv.nombre_nivel_educativo,ins.grado,grup.nombre_grupo,orgp.nombre_plan,tur.id AS id_turno,tur.nombre_turno, COUNT(*) AS total FROM t_inscripciones AS ins
                INNER JOIN t_personas AS per ON ins.id_personas = per.id
                INNER JOIN t_plan_estudios AS plan ON ins.id_plan_estudios = plan.id
                INNER JOIN t_nivel_educativos AS niv ON plan.id_nivel_educativo = niv.id
                INNER JOIN t_organizacion_planes AS orgp ON plan.id_plan = orgp.id
                LEFT JOIN t_salonescompletos AS sal ON ins.id_salon = sal.id
                LEFT JOIN t_grados AS gra ON sal.id_grado = gra.id
                LEFT JOIN t_grupos AS grup ON sal.id_grupo = grup.id
                INNER JOIN t_planteles AS plant ON plan.id_planteles = plant.id
                INNER JOIN t_turnos AS tur ON ins.id_horario = tur.id
                WHERE plant.id = $idPlantel
                GROUP BY plan.nombre_carrera,ins.grado,tur.nombre_turno HAVING COUNT(*)>=1";
                $request = $this->select_all($sql);
            }
            return $request;
        }
        public function selectInscripcionesControlEscolar($idplantel){
            $idPlantel = $idplantel;
            if($idPlantel == "Todos"){
                $sql = "SELECT plan.id,plan.nombre_carrera,niv.nombre_nivel_educativo,ins.grado,grup.nombre_grupo,orgp.nombre_plan,tur.id AS id_turno,tur.nombre_turno, COUNT(*) AS total FROM t_inscripciones AS ins
                INNER JOIN t_personas AS per ON ins.id_personas = per.id
                INNER JOIN t_plan_estudios AS plan ON ins.id_plan_estudios = plan.id
                INNER JOIN t_nivel_educativos AS niv ON plan.id_nivel_educativo = niv.id
                INNER JOIN t_organizacion_planes AS orgp ON plan.id_plan = orgp.id
                LEFT JOIN t_salones AS sal ON ins.id_salon = sal.id
                LEFT JOIN t_grados AS gra ON sal.id_grado = gra.id
                LEFT JOIN t_grupos AS grup ON sal.id_grupo = grup.id
                INNER JOIN t_planteles AS plant ON plan.id_planteles = plant.id
                INNER JOIN t_turnos AS tur ON ins.id_horario = tur.id
                GROUP BY plan.nombre_carrera,ins.grado,tur.nombre_turno HAVING COUNT(*)>=1";
                $request = $this->select_all($sql);
            }else{
                $sql = "SELECT plan.id,plan.nombre_carrera,niv.nombre_nivel_educativo,ins.grado,grup.nombre_grupo,orgp.nombre_plan,tur.id AS id_turno,tur.nombre_turno, COUNT(*) AS total FROM t_inscripciones AS ins
                INNER JOIN t_personas AS per ON ins.id_personas = per.id
                INNER JOIN t_plan_estudios AS plan ON ins.id_plan_estudios = plan.id
                INNER JOIN t_nivel_educativos AS niv ON plan.id_nivel_educativo = niv.id
                INNER JOIN t_organizacion_planes AS orgp ON plan.id_plan = orgp.id
                LEFT JOIN t_salones AS sal ON ins.id_salon = sal.id
                LEFT JOIN t_grados AS gra ON sal.id_grado = gra.id
                LEFT JOIN t_grupos AS grup ON sal.id_grupo = grup.id
                INNER JOIN t_planteles AS plant ON plan.id_planteles = plant.id
                INNER JOIN t_turnos AS tur ON ins.id_horario = tur.id
                WHERE plant.id = $idPlantel
                GROUP BY plan.nombre_carrera,ins.grado,tur.nombre_turno HAVING COUNT(*)>=1";
                $request = $this->select_all($sql);
            }
            return $request;
        }
        public function selectPersona($id){
            $sql = "SELECT *FROM t_personas WHERE id = $id";
            $request = $this->select($sql);
            return $request;
        }
        public function selectPersonasModal($data){
            $sql = "SELECT per.id,CONCAT(per.nombre_persona,' ',per.ap_paterno,' ',per.ap_materno) AS nombre,
            ins.id AS id_inscripcion FROM t_personas AS per
            LEFT JOIN t_inscripciones AS ins ON ins.id_personas = per.id
            LEFT JOIN t_historiales AS his ON ins.id_historial = his.id
            WHERE CONCAT(per.nombre_persona,' ',per.ap_paterno,' ',per.ap_materno) LIKE '%$data%'";
            $request = $this->select_all($sql);
            return $request;
        }

        public function insertInscripcion($data){
            $idPersona = $data['idPersonaSeleccionada'];
            $idPlantel = $data['listPlantelNuevo'];
            $idCarrera = $data['listCarreraNuevo'];
            $grado = $data['listGradoNuevo'];
            $turno = $data['listTurnoNuevo'];
            $nombreTutor = $data['txtNombreTutorAgregar'];
            $appPatTutor = $data['txtAppPaternoTutorAgregar'];
            $appMatTutor = $data['txtAppMaternoTutorAgregar'];
            $direccion = "";
            $telCelularTutor = $data['txtTelCelularTutorAgregar'];
            $telFijoTutor = $data['txtTelFijoTutorAgregar'];
            $emailTutor = $data['txtEmailTutorAgregar'];

            $anioActual = date('Y');
            $siglaPlantel = "TGZ";

            $tipoIngreso = "Inscripcion";
            if($grado != 1){
                $idSalon = null;
            }else{
                $idSalon = 1;
            }
            $idSubcampania = $data['idSubcampaniaNuevo'];
            $sql = "INSERT INTO t_tutores(nombre_tutor,appat_tutor,apmat_tutor,direccion,tel_celular,tel_fijo,email) VALUES(?,?,?,?,?,?,?)";
            $request = $this->insert($sql,array($nombreTutor,$appPatTutor,$appMatTutor,$direccion,$telCelularTutor,$telFijoTutor,$emailTutor));
            if($request){
                $sql_documentos = "SELECT doc.id FROM t_plan_estudios AS plan
                INNER JOIN t_nivel_educativos AS niv ON plan.id_nivel_educativo = niv.id 
                INNER JOIN t_documentos AS doc ON doc.id_nivel_educativo = niv.id WHERE plan.id = $idCarrera LIMIT 1";
                $request_documentos = $this->select($sql_documentos);
                if($request_documentos){
                    $idDocumentos = $request_documentos['id'];
                    $sql_folio_sistema = "SELECT COUNT(*)+1 AS total FROM t_inscripciones WHERE folio_sistema LIKE '%$siglaPlantel%'";
                    $request_folio_sistema = $this->select($sql_folio_sistema);
                    $request_folio_sistema_format = str_pad($request_folio_sistema['total']+1 ,5,"0",STR_PAD_LEFT);
                    $folioSistema = $siglaPlantel.$anioActual.($request_folio_sistema_format);

                    $sql_historial = "INSERT INTO t_historiales(aperturado,inscrito,egreso,pasante,titulado,baja,matricula_interna,matricula_externa,fecha_inscrito,fecha_egreso,fecha_pasante,fecha_titulado,fecha_baja) VALUES(?,?,?,?,?,?,?,?,NOW(),?,?,?,?)";
                    $request_historial = $this->insert($sql_historial,array(0,1,0,0,0,0,null,null,null,null,null,null));
                    if($request_historial){
                        $sql_inscripcion = "INSERT INTO t_inscripciones(folio_impreso,folio_sistema,tipo_ingreso,grado,promedio,id_horario,id_plan_estudios,id_personas,id_tutores,id_documentos,id_subcampania,id_salon,id_historial,id_usuario_creacion,fecha_actualizacion,id_usuario_actualizacion) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW(),?)";
                        $request_inscripcion = $this->insert($sql_inscripcion,array($folioSistema,$folioSistema,$tipoIngreso,$grado,null,$turno,$idCarrera,$idPersona,$idPersona,$idDocumentos,$idSubcampania,$idSalon,$request_historial,1,1));
                    }
                    /* $sql_inscripcion = "INSERT INTO t_inscripciones(folio_impreso,folio_sistema,tipo_ingreso,grado,id_horario,id_plan_estudios,id_personas,id_tutores,id_documentos,id_salon,id_subcampania,id_usuario_creacion,fecha_actualizacion,id_usuario_actualizacion) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,NOW(),?)";
                    $request_inscripcion = $this->insert($sql_inscripcion,array($folioSistema,$folioSistema,$tipoIngreso,$grado,$turno,$idCarrera,$idPersona,$idPersona,$idDocumentos,$idSalon,$idSubcampania,1,1));
                    if($request_inscripcion){
                        $idInscripcion = $request_inscripcion;
                       $sql_historial = "INSERT INTO t_historiales(aperturado,inscrito,egreso,pasante,titulado,baja,matricula_interna,matricula_externa,fecha_inscrito,fecha_egreso,fecha_pasante,fecha_titulado,fecha_baja,id_inscripcion) VALUES(?,?,?,?,?,?,?,?,NOW(),?,?,?,?,?)";
                        $request_historial = $this->insert($sql_historial,array(0,1,0,0,0,0,null,null,null,null,null,null,$idInscripcion));
                    } */
                }
            }
            return $request_inscripcion;
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
        public function selectGrados(){
            $sql = "SELECT *FROM t_grados";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectSubcampanias(){
            $sql = "SELECT camp.id AS id_campania, subc.id AS id_subcampania, subc.nombre_sub_campania FROM t_subcampania AS subc
            INNER JOIN t_campanias AS camp ON subc.id_campania = camp.id 
            WHERE subc.estatus = 1";
            $request = $this->select($sql);
            return $request;
        }
        public function selectPlanes(){
            $sql = "SELECT *FROM t_organizacion_planes";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectturnos(){
            $sql = "SELECT *FROM t_turnos WHERE id_categoria_persona = 2";
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

        //Lista de Inscritos en una Carrera
        public function selectInscritos(int $idCarrera, int $grado, int $turno){
            $sql = "SELECT ins.id,per.nombre_persona,CONCAT(per.ap_paterno,' ',per.ap_materno) AS apellidos FROM t_inscripciones AS ins
            INNER JOIN t_personas AS per ON ins.id_personas = per.id
            WHERE ins.id_plan_estudios = $idCarrera AND ins.grado = $grado AND ins.id_horario = $turno";
            $request = $this->select_all($sql);
            return $request;
        }

        //Obtener datos para la impresion de solicitud de inscripcion
        public function selectDatosImprimirSolInscricpion(int $idInscripcion){
            $idInscripcion = $idInscripcion;
            $sql = "SELECT ins.folio_impreso,plnes.nombre_carrera,plnes.id AS id_plan_estudio,orgpl.nombre_plan,plnes.duracion_carrera,peralum.nombre_persona,peralum.ap_paterno,peralum.ap_materno,peralum.direccion,peralum.colonia,peralum.tel_celular AS tel_celular_alumno,peralum.tel_fijo AS tel_fijo_alumno,peralum.email AS email_alumno,
            loc.nombre AS localidad,mun.nombre AS municipio,est.nombre AS estado,tut.nombre_tutor,tut.appat_tutor,tut.apmat_tutor,tut.tel_celular AS tel_celular_tutor,tut.tel_fijo AS tel_fijo_tutor,tut.email AS email_tutor,plntel.nombre_sistema,plntel.nombre_plantel,plntel.categoria,plntel.cve_centro_trabajo,CONCAT(plntel.domicilio,',',plntel.localidad,',',plntel.municipio,',',plntel.estado) AS ubicacion,ins.grado,esc.nombre_escolaridad
            FROM t_inscripciones AS ins 
            INNER JOIN t_plan_estudios AS plnes ON ins.id_plan_estudios = plnes.id
            INNER JOIN t_planteles AS plntel ON plnes.id_planteles = plntel.id
            INNER JOIN t_organizacion_planes AS orgpl ON plnes.id_plan = orgpl.id
            INNER JOIN t_personas AS peralum ON ins.id_personas = peralum.id
            INNER JOIN t_tutores AS tut ON ins.id_tutores = tut.id
            INNER JOIN t_localidades AS loc ON peralum.id_localidad = loc.id
            INNER JOIN t_municipios AS mun ON loc.id_municipio = mun.id
            INNER JOIN t_estados AS est ON mun.id_estados = est.id
            INNER JOIN t_escolaridad AS esc ON ins.grado = esc.id
            WHERE ins.id = $idInscripcion LIMIT 1";
            $request = $this->select($sql);
            return $request;
        }
        //Obtener lista de documentacion por el Plan de Estudios
        public function selectDocumentacionInscripcion(int $idPlanEstudios){
            $idPlanEstudios = $idPlanEstudios;
            $sql = "SELECT dest.tipo_documento FROM t_plan_estudios AS plnest 
            INNER JOIN t_nivel_educativos AS nivel ON plnest.id_nivel_educativo = nivel.id 
            INNER JOIN t_documentos AS doc ON doc.id_nivel_educativo = nivel.id
            INNER JOIN t_detalle_documentos AS dest ON dest.id_documentos = doc.id
            WHERE plnest.id = $idPlanEstudios";
            $request = $this->select_all($sql);
            return $request;
        }
    }
?>