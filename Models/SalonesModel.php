<?php
    class SalonesModel extends Mysql{
        public function __construct()
        {
            parent::__construct();
        }

        public function selectSalones()
        {
            $sql = "SELECT saln.id, saln.nombre_salon, saln.cantidadmax, saln.estatus, per.nombre_periodo , grad.nombre_grado , grup.nombre_grupo, plant.abreviacion_plantel
            FROM t_salones as saln
            INNER JOIN t_periodos as per
            ON saln.id_periodo = per.id 
            INNER JOIN t_grados as grad
            ON saln.id_grado = grad.id
            INNER JOIN t_grupos as grup 
            ON saln.id_grupo = grup.id
            INNER JOIN t_planteles as plant
            ON saln.id_plantel = plant.id";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectPeriodo()
        {
            $sql = "SELECT * FROM t_periodos";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectGrado()
        {
            $sql = "SELECT * FROM t_grados";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectGrupo()
        {
            $sql = "SELECT * FROM t_grupos";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectTurnos()
        {
            $sql = "SELECT id,nombre_turno, TIME_FORMAT(hora_entrada, '%H:%i') as hora_entrada, TIME_FORMAT(hora_salida, '%H:%i') as hora_salida FROM t_turnos where id_categoria_persona = 2";
            $request = $this->select_all($sql);
            return $request;
        }

        public function selectPlanteles()
        {
            $sql = "SELECT * FROM t_planteles";
            $request = $this->select_all($sql);
            return $request;
        }

        public function insertSalon($data){
            $nombreSalon = $data['txtNombreNuevo'];
            $cantidadMax = $data['txtCantidadMax'];
            $periodo = $data['listPeriodo'];
            $grado = $data['listGrado'];
            $grupo = $data['listGrupo'];
            $plantel = $data['listPlantel'];
            $horario = $data['listHorario'];
            $request;
            $sqlExist = "SELECT * FROM t_salones where nombre_salon = '$nombreSalon' and id_periodo = $periodo and id_plantel=$plantel;";
            $requestExists = $this->select($sqlExist);
            if($requestExists)
            {
                $request['estatus'] = TRUE;
            }
            else{
                $sqlNew = "INSERT INTO t_salones(nombre_salon, cantidadmax, estatus, id_periodo, id_grado, id_grupo, id_plantel, id_horario, fecha_creacion,id_usuario_creacion) VALUES(?,?,1,?,?,?,?,?,NOW(),1)";
                $requestNew = $this->insert($sqlNew, array($nombreSalon, $cantidadMax, $periodo, $grado, $grupo, $plantel, $horario));
                $request['estatus'] = FALSE;
            }

            return $request;
        }
    }
?>