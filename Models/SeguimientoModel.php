<?php

class SeguimientoModel extends Mysql{

    public $intIdPers;
    public $strNombrePers;
    public $strApePat;
    public $strApeMat;
    public $strTelCel;
    public $strEmail;
    public $intNvlCarrInte;
    public $intCarrInte;
    public $intPltInte;
    public $intCatPer;
    public $intNotificacion;
    public $intLectura;




    public function __construct(){
        parent::__construct();
    }

    public function selectProspectos(){
        $sql = "SELECT per.id, CONCAT(per.nombre_persona,' ',per.ap_paterno,' ',per.ap_materno) as nombre_completo, cat.nombre_categoria, per.alias, per.tel_celular,
        plt.nombre_plantel, crr.nombre_carrera, med.medio_captacion, cat.nombre_categoria
        FROM t_personas AS per
        INNER JOIN t_categoria_personas AS cat ON per.id_categoria_persona = cat.id
        INNER JOIN t_medio_captacion AS med ON per.id_medio_captacion = med.id
        LEFT JOIN t_carrera_interes AS crr ON per.id_carrera_interes = crr.id
        LEFT JOIN t_planteles as plt ON per.id_plantel_interes = plt.id
        WHERE per.estatus !=0 AND per.id_categoria_persona = 1 OR per.id_categoria_persona = 5 ORDER BY per.id DESC";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectNivelInteres(){
        $sql = "SELECT id, nombre_escolaridad FROM t_escolaridad";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectPlantelInteres(){
        $sql = "SELECT id, nombre_plantel FROM t_planteles";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectCarreraInteres(){
        $sql = "SELECT id, nombre_carrera FROM t_carrera_interes";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectProspecto(int $id){
        $this->intIdPers = $id;
        $sql = "SELECT per.id, per.nombre_persona, per.ap_paterno, per.ap_materno, per.tel_celular, per.email,
        nvl.nombre_nivel_educativo, plt.nombre_plantel, crr.nombre_carrera
        FROM t_personas as per
        INNER JOIN t_nivel_educativos as nvl
        ON per.id_nivel_carrera_interes = nvl.id
        INNER JOIN t_planteles as plt
        ON per.id_plantel_interes = plt.id
        INNER JOIN t_carrera_interes as crr
        ON per.id_carrera_interes = crr.id
        WHERE per.id = $this->intIdPers";
        $request = $this->select($sql);
        return $request;
    }

    public function updatePersona(int $id, string $nombre_persona, string $ap_paterno, string $ap_materno, string $telefono_cel, int $id_nvl_carr_int, int $id_carr_int, int $id_plnt_int, string $correo){
        $this->intIdPers = $id;
        $this->strNombrePers = $nombre_persona;
        $this->strApePat = $ap_paterno;
        $this->strAPeMat = $ap_materno;
        $this->strTelCel = $telefono_cel;
        $this->strEmail = $correo;
        $this->intNvlCarrInte = $id_nvl_carr_int;
        $this->intCarrInte = $id_carr_int;
        $this->intPltInte = $id_plnt_int;
        $request;
        $sql = "UPDATE t_personas SET nombre_persona = ?,  ap_paterno = ?, ap_materno = ?, tel_celular = ?, email = ?, id_nivel_carrera_interes = ?, id_carrera_interes = ?, id_plantel_interes = ? WHERE id = $this->intIdPersona";
        $arrData = array($this->strNombrePers, $this->strApePat, $this->strApeMat, $this->strTelCel, $this->strEmail, $this->intNvlCarrInte, $this->intCarrInte, $this->intPltInte, $this->intIdPers);
        $requestUpdate = $this->update($sql,$arrData);
        $request["estatus"] = TRUE;
        return $request;
    }

    public function insertAgendaProspecto(int $idPersona, int $idUsuarioAtendidoAgenda, string $fechaPrograma, string $fechaRegistro, string $horaActualizacion, string $AsuntoLlamada, string $detalleLlamada){
        $request = "";
        $this->intIdPers = $idPersona;
        $this->intIdUsuarioAtendio = $idUsuarioAtendidoAgenda;
        $this->strFechaProgramada = $fechaPrograma;
        $this->strFechaRegistro = $fechaRegistro;
        $this->strHoraProgramada = $horaActualizacion;
        $this->strAsunto = $AsuntoLlamada;
        $this->intNotificacion = 0;
        $this->intLectura = 1;
        $this->strDetalle = $detalleLlamada;
        $sql = "INSERT INTO t_agenda(fecha_registro, fecha_programada, hora_programada, asunto, detalle, notificacion, lectura, id_usuario_atendio, id_persona) VALUES(?,?,?,?,?,?,?,?,?)";
        $arrData = array($this->strFechaRegistro, $this->strFechaProgramada, $this->strHoraProgramada, $this->strAsunto, $this->strDetalle,$this->intNotificacion, $this->intLectura, $this->intIdUsuarioAtendio, $this->intIdPers);
        $request = $this->insert($sql,$arrData);
        return $request;
    }

    public function selectEgresado(int $idCatPer, int $idPers)
    {
        $this->intIdCatPer = $idCatPer;
        $this->intIdPers = $idPers;
        $sql = "SELECT per.id, per.nombre_persona, per.ap_paterno, per.ap_materno, crr.nombre_carrera, per.nombre_empresa,
        avg(ins.promedio), plan.nombre_carrera
        FROM t_personas as per
        INNER JOIN t_carrera_interes as crr
        ON per.id_carrera_interes = crr.id
        INNER JOIN t_inscripciones as ins
        ON per.id = ins.id_personas
        INNER JOIN t_plan_estudios as plan
        ON ins.id_plan_estudios = plan.id
        WHERE id_categoria_persona = $this->intIdCarPer
        AND ins.id_personas = $this->intIdPers
        AND ins.tipo_ingreso = 'Reinscripcion'";
        $request = $this->select($sql);
        return $request;
    }

    public function selectPersonaSeguimiento(int $idPer)
    {
        $this->intIdPers = $idPer;
        $sql = "SELECT per.id, per.nombre_persona, CONCAT(per.ap_paterno,' ', per.ap_materno) as apellidos, per.tel_celular, per.email, 
        munc.nombre as municipio, est.nombre as estado, med.medio_captacion, CONCAT(per2.nombre_persona,' ', per2.ap_paterno, ' ', per2.ap_materno) as nombre_usuario_creacion, 
        per.fecha_creacion, nvl.nombre_nivel_educativo, crr_int.nombre_carrera
        FROM t_personas as per
        INNER JOIN t_localidades as loc
        ON per.id_localidad = loc.id
        INNER JOIN t_municipios as munc 
        ON loc.id_municipio = munc.id 
        INNER JOIN t_estados = est 
        ON munc.id_estados = est.id 
        INNER JOIN t_medio_captacion as med 
        ON per.id_medio_captacion = med.id
        INNER JOIN t_personas as per2 
        ON per.id_usuario_creacion = per2.id
        LEFT JOIN t_nivel_educativos as nvl 
        ON per.id_nivel_carrera_interes = nvl.id
        LEFT JOIN t_carrera_interes as crr_int 
        ON per.id_carrera_interes = crr_int.id
        WHERE per.id = $this->intIdPers";
        $request = $this->select($sql);
        return $request;
    }

    
    public function selectSeguimientoProspecto(int $idPer){
        $this->intIdPers = $idPer;
        $sql = "SELECT seg_pros.fecha, resp.respuesta_rapida, seg_pros.comentario, CONCAT(per.nombre_persona,' ',per.ap_paterno, ' ',per.ap_materno) as nombre_usuario_atendio  
        FROM t_seguimiento_prospecto as seg_pros
        INNER JOIN t_personas as per
        ON seg_pros.id_usuario_atendio = per.id 
        INNER JOIN t_respuesta_rapida as resp 
        ON seg_pros.respuesta_rapida = resp.id
        WHERE seg_pros.id_persona = $this->intIdPers";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectRespuestasRapidas(){
        $sql = "SELECT * FROM t_respuesta_rapida";
        $request = $this->select_all($sql);
        return $request;
    }

}
