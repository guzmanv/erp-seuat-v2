<?php
    class DashboardAdmisionModel extends Mysql{
        public function __construct(){
            parent::__construct();
        }
        public function selectTotalesCard($plantel){
            if($plantel == "all"){
                $sqlPlanteles = "SELECT COUNT(*) AS total FROM t_inscripciones AS ins
                INNER JOIN t_plan_estudios AS pe ON ins.id_plan_estudios = pe.id
                WHERE ins.grado = 1";
                $requestPlanteles = $this->select($sqlPlanteles);
                $sqlProspectos = "SELECT COUNT(*) AS total FROM t_personas AS per
                WHERE per.estatus !=0 AND per.id_categoria_persona = 1";
                $requestProspectos = $this->select($sqlProspectos);
                $sqlInscritos = "SELECT COUNT(*) AS total FROM t_inscripciones AS ins
                WHERE ins.tipo_ingreso = 'Inscripcion' AND ins.grado = 1";
                $requestInscritos = $this->select($sqlInscritos);
                $request['planteles'] = $requestPlanteles['total'];
                $request['prospectos'] = $requestProspectos['total'];
                $request['inscritos'] = $requestInscritos['total'];
                $request['tipo'] = "all";
            }else{
                $sqlPlanteles = "SELECT COUNT(*) AS total FROM t_inscripciones AS ins
                INNER JOIN t_plan_estudios AS pe ON ins.id_plan_estudios = pe.id
                WHERE ins.grado = 1 AND pe.id_plantel  = $plantel";
                $requestPlanteles = $this->select($sqlPlanteles);
                $requestPlanteles = $this->select($sqlPlanteles);
                $sqlProspectos = "SELECT COUNT(*) AS total FROM t_personas AS per
                WHERE per.estatus !=0 AND per.id_plantel_interes = $plantel AND per.id_categoria_persona = 1";
                $requestProspectos = $this->select($sqlProspectos);
                $sqlInscritos = "SELECT COUNT(*) AS total FROM t_inscripciones AS ins
                INNER JOIN t_plan_estudios AS pe ON ins.id_plan_estudios = pe.id
                WHERE ins.tipo_ingreso = 'Inscripcion' AND ins.grado = 1 AND pe.id_plantel = $plantel";
                $requestInscritos = $this->select($sqlInscritos);
                $request['prospectos'] = $requestProspectos['total'];
                $request['inscritos'] = $requestInscritos['total'];
                $request['tipo'] = "";
            }   
            return $request;
        }
        /* public function selectRvoesExpirar($plantel){
            if($plantel == "all"){
                $sqlRVOES = "SELECT pl.id,pl.nombre_carrera,pl.nombre_carrera_corto,plnt.abreviacion_sistema,plnt.abreviacion_plantel,plnt.municipio,pl.rvoe,pl.fecha_actualizacion_rvoe FROM t_plan_estudios AS pl 
                INNER JOIN t_planteles AS plnt ON pl.id_plantel = plnt.id WHERE DATEDIFF(pl.fecha_actualizacion_rvoe,CURRENT_DATE) <= 365 AND pl.estatus = 1";
                $requestRVOES = $this->select_all($sqlRVOES);
            }else{
                $sqlRVOES = "SELECT pl.id,pl.nombre_carrera,pl.nombre_carrera_corto,plnt.abreviacion_sistema,plnt.abreviacion_plantel,plnt.municipio,pl.rvoe,pl.fecha_actualizacion_rvoe FROM t_plan_estudios AS pl INNER JOIN t_planteles AS plnt ON pl.id_plantel = plnt.id WHERE DATEDIFF(fecha_actualizacion_rvoe,CURRENT_DATE) <= 365 AND pl.id_plantel = $plantel AND pl.estatus = 1";
                $requestRVOES = $this->select_all($sqlRVOES);
            }
            return $requestRVOES;
        } */
        public function selectPlanteles(){
            $sql = "SELECT id,abreviacion_plantel,nombre_plantel,municipio FROM t_planteles WHERE estatus = 1";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectPlantelesInscripcion(){
            $sql = "SELECT p.id, p.abreviacion_plantel,p.abreviacion_sistema,p.municipio FROM t_inscripciones AS ins
            INNER JOIN t_plan_estudios AS pe ON ins.id_plan_estudios = pe.id
            INNER JOIN t_planteles AS p ON pe.id_plantel = p.id
            WHERE ins.grado = 1";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectProspectosbyPlantel(int $idPlantel){
            $sql = "SELECT COUNT(*) AS total FROM t_personas AS per
            WHERE per.estatus !=0 AND per.id_plantel_interes = $idPlantel AND per.id_categoria_persona = 1";
            $request = $this->select($sql);
            return $request;
        }
        public function selectInscritosbyPlantel(int $idPlantel){
            $sql = "SELECT COUNT(*) AS total FROM t_inscripciones AS ins
            INNER JOIN t_plan_estudios AS pe ON ins.id_plan_estudios = pe.id
            WHERE ins.tipo_ingreso = 'Inscripcion' AND ins.grado = 1 AND pe.id_plantel = $idPlantel";
            $request = $this->select($sql);
            return $request;
        }
    }
?>    