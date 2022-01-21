<?php

  class CampaniaModel extends Mysql{

    public $intIdCampanias;
    public $strNombreCampanias;
    public $strFechaInicio;
    public $strFechaFin;
    public $intEstatus;
    public $strFechaCreacion;
    public $strFechaActualizacion;
    public $intIdUsuarioCreacion;
    public $intIdUsuarioModificacion;

    public function __construct(){
  		parent::__construct();
  	}

    public function selectCampanias(){
      //Extraer las campañas
      $sql = "SELECT * FROM t_campanias WHERE estatus !=0";
      $request = $this->select_all($sql);
      return $request;
    }

    public function selectCampania(int $intIdCampanias){
      //Buscar campañas
      $this->intIdCampanias = $intIdCampanias;
      $sql = "SELECT * FROM t_campanias WHERE id = $this->intIdCampanias";
      $request = $this->select($sql);
      return $request;
    }

    public function insertCampania(string $nombreCampanias, string $fechaInicio, string $fechaFin, int $estatus, string $fechaCreacion, string $fechaActualizacion, int $idUsuarioCreacion, int $idUsuarioActualizacion){

      $return = "";
      $this->strNombreCampanias = $nombreCampanias;
      $this->strFechaInicio = $fechaInicio;
      $this->strFechaFin = $fechaFin;
      $this->intEstatus = $estatus;
      $this->strFechaCreacion = $fechaCreacion;
      $this->strFechaActualizacion = $fechaActualizacion;
      $this->intIdUsuarioCreacion = $idUsuarioCreacion;
      $this->intIdUsuarioModificacion = $idUsuarioActualizacion;

      $sql = "SELECT * FROM t_campanias WHERE nombre_campania = '{$this->strNombreCampanias}' ";
      $request = $this->select_all($sql);

      if(empty($request)){
        $query_insert = "INSERT INTO t_campanias(nombre_campania, fecha_inicio, fecha_fin, estatus, fecha_creacion, fecha_actualizacion, id_usuario_creacion, id_usuario_actualizacion) VALUES(?,?,?,?,?,?,?,?)";
        $arrData = array($this->strNombreCampanias, $this->strFechaInicio, $this->strFechaFin, $this->intEstatus, $this->strFechaCreacion, $this->strFechaActualizacion, $this->intIdUsuarioCreacion, $this->intIdUsuarioModificacion);
        $request_insert = $this->insert($query_insert,$arrData);
        $return = $request_insert;
      }else{
        $return = "exit";
      }
      return $return;
    }

    public function updateCampanias(int $id, string $nombreCampanias, int $estatus, string $fechaActualizacion, int $idUsuarioActualizacion){
      $this->intIdCampanias = $id;
      $this->strNombreCampanias = $nombreCampanias;
      $this->intEstatus = $estatus;
      $this->intIdUsuarioModificacion = $idUsuarioActualizacion;

      $sql = "SELECT * FROM t_campanias WHERE nombre_campania = '$this->strNombreCampanias' AND id != '$this->intIdCampanias'";
      $request = $this->select_all($sql);

      if(empty($request)){
        $sql = "UPDATE t_campanias SET nombre_campania = ?, estatus = ?, fecha_actualizacion = NOW(), id_usuario_actualizacion = ? WHERE id = $this->intIdCampanias";
        $arrData = array($this->strNombreCampanias, $this->intEstatus, $this->intIdUsuarioModificacion);
        $request = $this->update($sql,$arrData);
      }else{
        $request = "exist";
      }
      return $request;
    }

    public function deleteCampanias(int $idCampanias) {
      $this->intIdCampanias = $idCampanias;
      $sql = "SELECT * FROM t_subcampania WHERE id_campania = $this->intIdCampanias";
      $request = $this->select_all($sql);
      if(empty($request)){
        $sql = "UPDATE t_campanias SET estatus = ? WHERE id = $this->intIdCampanias";
        $arrData = array(0);
        $request = $this->update($sql,$arrData);
        if($request){
          $request = 'ok';
        }else{
          $request = 'error';
        }
      }else{
        $request = 'exist';
      }
      return $request;
    }
}

?>
