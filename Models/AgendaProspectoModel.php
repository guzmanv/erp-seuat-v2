<?php

  class AgendaProspectoModel extends Mysql{

    public $intId;
    public $strFechaRegistro;
    public $strFechaProgramada;
    public $strHoraProgramada;
    public $strAsunto;
    public $strDetalle;
    public $intEstatus;
    public $intNotificacion;
    public $intLectura;
    public $intIdUsuarioAtendio;
    public $intIdPersona;
    public $strFechaActualizacion;

    public function __construct(){
      parent::__construct();
    }

    public function selectAgenda(){
      $sql = "SELECT * FROM t_agenda";
      $request = $this->select_all($sql);
      return $request;
    }

    public function selectAgendaProspectos(){
      $sql = "SELECT t_agenda.id, t_personas.nombre_persona, t_personas.ap_paterno, t_personas.ap_materno, t_personas.tel_celular, t_agenda.fecha_programada, t_agenda.hora_programada, t_agenda.estatus FROM t_agenda INNER JOIN t_personas WHERE t_personas.id_categoria_persona = 1";
      $request = $this->select_all($sql);
      return $request;
    }

    public function selectRegistros(){
      $sqlId = "SELECT t_personas.id FROM t_personas INNER JOIN t_agenda WHERE t_personas.id = t_agenda.id_persona ORDER BY id DESC LIMIT 1";
      $id = $this->select($sqlId);
      $this->intIdPersona = $id['id'];

      $sql = "SELECT * FROM t_personas WHERE id > {$this->intIdPersona} AND id_categoria_persona = 1";
      $request = $this->select_all($sql);
      return $request;

    }

    public function insertAgendaProspecto(){
      $return = "";
      $sql = "SELECT id, fecha_creacion, id_usuario_creacion FROM t_personas WHERE id_categoria_persona = 1";
      $consulta = $this->select_all($sql);
      //$return = $consulta;
      for($i = 0; $i < count($consulta); $i++){
        $this->strFechaRegistro = $consulta[$i]['fecha_creacion'];
        $this->strFechaProgramada = date("Y-m-d\TH-i");
        $this->strHoraProgramada = "15:00";
        $this->strAsunto = " ";
        $this->strDetalle = " ";
        $this->intEstatus = 2;
        $this->intNotificacion = 1;
        $this->intLectura = 1;
        $this->intIdUsuarioAtendio = $consulta[$i]['id_usuario_creacion'];
        $this->intIdPersona = $consulta[$i]['id'];
        $this->strFechaActualizacion = "0000-00-00";

        $query_insert = "INSERT INTO t_agenda(fecha_registro, fecha_programada, hora_programada, asunto, detalle, estatus, notificacion, lectura, id_usuario_atendio, id_persona, fecha_actualizacion) VALUES(?,?,?,?,?,?,?,?,?,?,?)";

        $arrData = array($this->strFechaRegistro, $this->strFechaProgramada, $this->strHoraProgramada, $this->strAsunto, $this->strDetalle, $this->intEstatus, $this->intNotificacion, $this->intLectura, $this->intIdUsuarioAtendio, $this->intIdPersona, $this->strFechaActualizacion);

        $request_insert = $this->insert($query_insert,$arrData);
        $return = $request_insert;
      }
      return $return;
    }


    //mayor que" (>), "menor que" (<)
    //&& ($fecha[$i]['hora_programada'] > date('H:i'))
    //&& ($fecha[$i]['hora_programada'] == date('H:i'))
    public function updateEstados(){
      $sqlF = "SELECT id, fecha_programada, hora_programada FROM t_agenda";
      $fecha = $this->select_all($sqlF);

      for($i = 0; $i < count($fecha); $i++){
        if(($fecha[$i]['fecha_programada'] > date("Y-m-d")) || ($fecha[$i]['hora_programada'] > date('H:i:s'))){
          $sqlU = "UPDATE t_agenda SET estatus = ? WHERE id = ?";
          $arrData = array(3, $fecha[$i]['id']);
          $request = $this->update($sqlU,$arrData);
        }else if(($fecha[$i]['fecha_programada'] == date("Y-m-d"))){
          $sqlU = "UPDATE t_agenda SET estatus = ? WHERE id = ?";
          $arrData = array(2, $fecha[$i]['id']);
          $request = $this->update($sqlU,$arrData);
          $request = " ".$fecha[$i]['hora_programada']." - ".date('H:i:s');
        }else{
          $sqlU = "UPDATE t_agenda SET estatus = ? WHERE id = ?";
          $arrData = array(1, $fecha[$i]['id']);
          $request = $this->update($sqlU,$arrData);
        }
      }
      return $request;
    }

  }

?>
